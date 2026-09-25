<?php

namespace Tests\Feature;

use App\Models\Submission;
use App\Services\GeminiEvaluationService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GeminiFallbackTest extends TestCase
{
    public function test_it_retries_with_an_alternate_api_key_when_quota_is_exceeded(): void
    {
        config([
            'services.gemini.key' => 'primary-key',
            'services.gemini.model' => 'gemini-2.5-flash',
        ]);

        putenv('GEMINI_API_KEY_1=alt-key-1');
        putenv('GEMINI_API_KEY_2=alt-key-2');

        $keys = [];

        Http::fake(function ($request) use (&$keys) {
            $key = $request->query('key');
            $keys[] = $key;

            if ($key === 'primary-key') {
                return Http::response([
                    'error' => ['message' => 'You exceeded your current quota'],
                ], 429);
            }

            return Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => json_encode([
                                    'total_score' => 88,
                                    'rubric_scores' => [
                                        'content' => ['clarity' => 12, 'evidence' => 13, 'originality' => 8, 'note' => 'Good'],
                                        'strategy' => ['rebuttal' => 12, 'clash' => 8, 'time_management' => 5, 'note' => 'Great'],
                                        'style' => ['body_language' => 8, 'voice_delivery' => 9, 'academic_language' => 9, 'note' => 'Strong'],
                                    ],
                                    'judge_score_note' => 'Strong presentation',
                                    'strengths' => ['Clear structure'],
                                    'improvements' => ['Use more examples'],
                                    'critical_error' => 'None',
                                    'diagnosis' => ['content' => 4, 'strategy' => 4, 'delivery' => 5, 'rebuttal' => 4, 'level' => 'Developing'],
                                    'coaching_plan' => ['week_1_2' => 'Practice', 'week_3' => 'Refine', 'week_4' => 'Review'],
                                ])],
                            ],
                        ],
                    ],
                ],
            ], 200);
        });

        $submission = new Submission([
            'title' => 'Sample YouTube speech',
            'youtube_url' => 'https://www.youtube.com/watch?v=example',
        ]);

        $result = app(GeminiEvaluationService::class)->evaluate($submission);

        $this->assertSame(88, $result['total_score']);
        $this->assertSame(['primary-key', 'alt-key-1'], $keys);
    }
}
