<?php

namespace App\Services;

use App\Models\AiProvider;
use App\Models\Submission;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Throwable;

class GeminiEvaluationService
{
    /**
     * @return array<string, mixed>
     */
    public function evaluate(Submission $submission): array
    {
        $provider = AiProvider::query()
            ->where('provider', 'gemini')
            ->where('is_enabled', true)
            ->first();

        $apiKey = $provider?->api_key ?: config('services.gemini.key');
        $model = $provider?->model ?: config('services.gemini.model', 'gemini-2.5-pro');

        if (! $apiKey) {
            throw new RuntimeException('Chưa cấu hình GEMINI_API_KEY hoặc API key Gemini trong Quản lý AI.');
        }

        $response = $this->request($apiKey, $model, $this->prompt($submission));
        $rawText = data_get($response, 'candidates.0.content.parts.0.text');

        if (! is_string($rawText) || trim($rawText) === '') {
            throw new RuntimeException('Gemini không trả về nội dung chấm điểm.');
        }

        $evaluation = $this->parseJson($rawText);

        return [
            'total_score' => $this->integerValue($evaluation['total_score'] ?? null, 0, 100),
            'rubric_scores' => $this->rubricScores($evaluation['rubric_scores'] ?? []),
            'judge_score_note' => $this->stringValue($evaluation['judge_score_note'] ?? ''),
            'strengths' => $this->stringList($evaluation['strengths'] ?? []),
            'improvements' => $this->stringList($evaluation['improvements'] ?? []),
            'critical_error' => $this->stringValue($evaluation['critical_error'] ?? ''),
            'diagnosis' => $this->diagnosis($evaluation['diagnosis'] ?? []),
            'coaching_plan' => is_array($evaluation['coaching_plan'] ?? null) ? $evaluation['coaching_plan'] : [],
            'raw_ai_response' => $rawText,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function request(string $apiKey, string $model, string $prompt): array
    {
        try {
            $response = Http::acceptJson()
                ->asJson()
                ->withQueryParameters(['key' => $apiKey])
                ->retry([1000, 5000, 15000], 0, function (Throwable $exception): bool {
                    if ($exception instanceof ConnectionException) {
                        return true;
                    }

                    if (! $exception instanceof RequestException) {
                        return false;
                    }

                    return in_array($exception->response->status(), [429, 500, 502, 503, 504], true);
                }, false)
                ->timeout(210)
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent", [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]],
                    ],
                    'generationConfig' => [
                        'temperature' => (float) config('services.gemini.temperature', 0.7),
                        'maxOutputTokens' => (int) config('services.gemini.max_tokens', 2048),
                        'responseMimeType' => 'application/json',
                    ],
                ]);
        } catch (Throwable $exception) {
            throw new RuntimeException('Không thể kết nối đến Gemini.', 0, $exception);
        }

        if ($response->failed()) {
            $message = data_get($response->json(), 'error.message');
            $detail = is_string($message) && $message !== '' ? ': '.$message : '';

            throw new RuntimeException('Gemini trả về lỗi HTTP '.$response->status().$detail);
        }

        return $response->json();
    }

    private function prompt(Submission $submission): string
    {
        return <<<PROMPT
Bạn là giám khảo tranh biện tiếng Anh cho học sinh. Hãy đánh giá bài nói trong video YouTube dưới đây theo rubric.

Tiêu đề: {$submission->title}
Video: {$submission->youtube_url}

Chỉ trả về JSON hợp lệ, không markdown, theo chính xác cấu trúc:
{
  "total_score": 0,
  "rubric_scores": {
    "content": {"clarity": 0, "evidence": 0, "originality": 0, "sub_total": 0, "note": ""},
    "strategy": {"rebuttal": 0, "clash": 0, "time_management": 0, "sub_total": 0, "note": ""},
    "style": {"body_language": 0, "voice_delivery": 0, "academic_language": 0, "sub_total": 0, "note": ""}
  },
  "judge_score_note": "",
  "strengths": [],
  "improvements": [],
  "critical_error": "",
  "diagnosis": {"content": 0, "strategy": 0, "delivery": 0, "rebuttal": 0, "level": "Beginner"},
  "coaching_plan": {"week_1_2": "", "week_3": "", "week_4": ""}
}

Giới hạn điểm: content clarity/evidence/originality lần lượt 15/15/10; strategy rebuttal/clash/time_management lần lượt 15/10/5; style body_language/voice_delivery/academic_language lần lượt 10/10/10; tổng điểm 0-100; diagnosis mỗi mục 0-5; level là Beginner, Developing hoặc Strong.
PROMPT;
    }

    /**
     * @return array<string, mixed>
     */
    private function parseJson(string $text): array
    {
        $text = trim(preg_replace('/^```(?:json)?\s*|\s*```$/i', '', $text) ?? $text);
        $data = json_decode($text, true);

        if (! is_array($data)) {
            throw new RuntimeException('Gemini trả về JSON không hợp lệ.');
        }

        return $data;
    }

    private function integerValue(mixed $value, int $min, int $max): int
    {
        return max($min, min($max, is_numeric($value) ? (int) $value : $min));
    }

    private function stringValue(mixed $value): string
    {
        return is_scalar($value) ? (string) $value : '';
    }

    /** @return array<int, string> */
    private function stringList(mixed $value): array
    {
        return is_array($value)
            ? array_values(array_filter(array_map(fn (mixed $item): string => $this->stringValue($item), $value)))
            : [];
    }

    /** @return array<string, mixed> */
    private function rubricScores(mixed $value): array
    {
        $value = is_array($value) ? $value : [];

        return [
            'content' => $this->rubricGroup($value['content'] ?? [], ['clarity' => 15, 'evidence' => 15, 'originality' => 10]),
            'strategy' => $this->rubricGroup($value['strategy'] ?? [], ['rebuttal' => 15, 'clash' => 10, 'time_management' => 5]),
            'style' => $this->rubricGroup($value['style'] ?? [], ['body_language' => 10, 'voice_delivery' => 10, 'academic_language' => 10]),
        ];
    }

    /** @param array<string, int> $limits */
    private function rubricGroup(mixed $value, array $limits): array
    {
        $value = is_array($value) ? $value : [];
        $group = [];

        foreach ($limits as $key => $max) {
            $group[$key] = $this->integerValue($value[$key] ?? null, 0, $max);
        }

        $group['sub_total'] = array_sum(array_intersect_key($group, $limits));
        $group['note'] = $this->stringValue($value['note'] ?? '');

        return $group;
    }

    /** @return array<string, mixed> */
    private function diagnosis(mixed $value): array
    {
        $value = is_array($value) ? $value : [];

        return [
            'content' => $this->integerValue($value['content'] ?? null, 0, 5),
            'strategy' => $this->integerValue($value['strategy'] ?? null, 0, 5),
            'delivery' => $this->integerValue($value['delivery'] ?? null, 0, 5),
            'rebuttal' => $this->integerValue($value['rebuttal'] ?? null, 0, 5),
            'level' => in_array($value['level'] ?? null, ['Beginner', 'Developing', 'Strong'], true) ? $value['level'] : 'Beginner',
        ];
    }
}
