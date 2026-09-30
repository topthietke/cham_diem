<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\EvaluateSubmissionJob;
use App\Models\Evaluation;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    public function index(Request $request): View
    {
        $submissions = Submission::query()
            ->with(['student.parent', 'evaluation'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = '%'.$request->string('q').'%';
                $q->where('title', 'like', $term)
                    ->orWhereHas('student', fn ($qs) => $qs->where('name', 'like', $term));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.submissions.index', compact('submissions'));
    }

    public function show(Submission $submission): View
    {
        $submission->load(['student.parent', 'evaluation', 'feedbacks']);

        return view('admin.submissions.show', compact('submission'));
    }

    /**
     * Cho phép giám khảo/admin ghi đè thủ công toàn bộ kết quả chấm điểm
     * (dùng khi Gemini chấm sai, hoặc muốn con người review lại).
     */
    public function update(Request $request, Submission $submission)
    {
        $data = $request->validate([
            'total_score' => ['required', 'integer', 'min:0', 'max:100'],
            'judge_score_note' => ['nullable', 'string'],
            'critical_error' => ['nullable', 'string'],
            'strengths' => ['nullable', 'string'],
            'improvements' => ['nullable', 'string'],

            'diagnosis.content' => ['required', 'integer', 'min:0', 'max:5'],
            'diagnosis.strategy' => ['required', 'integer', 'min:0', 'max:5'],
            'diagnosis.delivery' => ['required', 'integer', 'min:0', 'max:5'],
            'diagnosis.rebuttal' => ['required', 'integer', 'min:0', 'max:5'],
            'diagnosis.level' => ['required', Rule::in(['Beginner', 'Developing', 'Strong'])],

            'coaching_plan.week_1_2' => ['nullable', 'string'],
            'coaching_plan.week_3' => ['nullable', 'string'],
            'coaching_plan.week_4' => ['nullable', 'string'],

            'rubric.content.clarity' => ['required', 'integer', 'min:0', 'max:15'],
            'rubric.content.evidence' => ['required', 'integer', 'min:0', 'max:15'],
            'rubric.content.originality' => ['required', 'integer', 'min:0', 'max:10'],
            'rubric.content.note' => ['nullable', 'string'],
            'rubric.strategy.rebuttal' => ['required', 'integer', 'min:0', 'max:15'],
            'rubric.strategy.clash' => ['required', 'integer', 'min:0', 'max:10'],
            'rubric.strategy.time_management' => ['required', 'integer', 'min:0', 'max:5'],
            'rubric.strategy.note' => ['nullable', 'string'],
            'rubric.style.body_language' => ['required', 'integer', 'min:0', 'max:10'],
            'rubric.style.voice_delivery' => ['required', 'integer', 'min:0', 'max:10'],
            'rubric.style.academic_language' => ['required', 'integer', 'min:0', 'max:10'],
            'rubric.style.note' => ['nullable', 'string'],
        ]);

        $rubric = $data['rubric'];
        $rubric['content']['sub_total'] = $rubric['content']['clarity'] + $rubric['content']['evidence'] + $rubric['content']['originality'];
        $rubric['strategy']['sub_total'] = $rubric['strategy']['rebuttal'] + $rubric['strategy']['clash'] + $rubric['strategy']['time_management'];
        $rubric['style']['sub_total'] = $rubric['style']['body_language'] + $rubric['style']['voice_delivery'] + $rubric['style']['academic_language'];

        Evaluation::updateOrCreate(
            ['submission_id' => $submission->id],
            [
                'total_score' => $data['total_score'],
                'rubric_scores' => $rubric,
                'judge_score_note' => $data['judge_score_note'] ?? '',
                'strengths' => $this->linesToArray($data['strengths'] ?? ''),
                'improvements' => $this->linesToArray($data['improvements'] ?? ''),
                'critical_error' => $data['critical_error'] ?? '',
                'diagnosis' => $data['diagnosis'],
                'coaching_plan' => $data['coaching_plan'] ?? [],
                // Giữ nguyên raw_ai_response gốc (nếu có) để vẫn audit được lần chấm AI gần nhất
                'raw_ai_response' => $submission->evaluation?->raw_ai_response,
            ]
        );

        $submission->update(['status' => Submission::STATUS_GRADED]);

        return back()
            ->with('status', 'Đã lưu kết quả chấm điểm thủ công.')
            ->with('grading_saved', true);
    }

    public function download(Submission $submission)
    {
        $submission->load(['student', 'evaluation']);
        $evaluation = $submission->evaluation;
        abort_unless($evaluation, 404);

        $rubric = $evaluation->rubric_scores ?? [];
        $diagnosis = $evaluation->diagnosis ?? [];
        $coachingPlan = $evaluation->coaching_plan ?? [];
        $rubricGroups = [
            'Content' => ['clarity' => 'Clarity', 'evidence' => 'Evidence', 'originality' => 'Originality'],
            'Strategy' => ['rebuttal' => 'Rebuttal', 'clash' => 'Clash', 'time_management' => 'Time Management'],
            'Style' => ['body_language' => 'Body Language', 'voice_delivery' => 'Voice & Delivery', 'academic_language' => 'Academic Language'],
        ];

        $lines = [
            'Bài nộp: '.$submission->title,
            'Học sinh: '.$submission->student->name,
            'Video: '.$submission->youtube_url,
            '',
            'JUDGE SCORE',
            'Tổng điểm: '.$evaluation->total_score,
            'Nhận định tổng quan: '.($evaluation->judge_score_note ?: '—'),
            '',
            'RUBRIC CHI TIẾT',
        ];

        foreach ($rubricGroups as $groupKey => $items) {
            $lines[] = $groupKey.':';
            foreach ($items as $itemKey => $label) {
                $lines[] = '  '.$label.': '.data_get($rubric, strtolower($groupKey).'.'.$itemKey, '—');
            }
            $lines[] = '  Ghi chú: '.(data_get($rubric, strtolower($groupKey).'.note') ?: '—');
        }

        $lines = array_merge($lines, [
            '',
            'Điểm mạnh nhất:',
            $this->formatLines($evaluation->strengths ?? []),
            '',
            'Cần cải thiện:',
            $this->formatLines($evaluation->improvements ?? []),
            '',
            'Lỗi mất điểm nhiều nhất: '.($evaluation->critical_error ?: '—'),
            '',
            'SPEAKER DIAGNOSIS',
            'Content: '.data_get($diagnosis, 'content', '—'),
            'Strategy: '.data_get($diagnosis, 'strategy', '—'),
            'Delivery: '.data_get($diagnosis, 'delivery', '—'),
            'Rebuttal: '.data_get($diagnosis, 'rebuttal', '—'),
            'Level: '.data_get($diagnosis, 'level', '—'),
            '',
            'COACHING PLAN',
            'Tuần 1-2 (CREL): '.(data_get($coachingPlan, 'week_1_2') ?: '—'),
            'Tuần 3 (Đối chiếu): '.(data_get($coachingPlan, 'week_3') ?: '—'),
            'Tuần 4 (Thẻ dàn ý): '.(data_get($coachingPlan, 'week_4') ?: '—'),
        ]);

        $filename = (preg_replace('/[^A-Za-z0-9._-]+/', '_', $submission->title) ?: 'submission').'_grading.txt';

        return response(implode("\n", $lines), 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }

    /** Kích hoạt Gemini chấm lại bài nộp này từ đầu. */
    public function regrade(Submission $submission)
    {
        $submission->update(['status' => Submission::STATUS_PENDING]);
        EvaluateSubmissionJob::dispatch($submission);

        return back()->with('status', 'Đã gửi yêu cầu AI chấm lại. Vui lòng tải lại trang sau ít phút.');
    }

    private function linesToArray(string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function formatLines(array $items): string
    {
        return $items === [] ? '—' : '- '.implode("\n- ", $items);
    }
}
