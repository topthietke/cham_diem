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

        return back()->with('status', 'Đã lưu kết quả chấm điểm thủ công.');
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
}
