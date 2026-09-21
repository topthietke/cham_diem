<?php

namespace App\Jobs;

use App\Models\Evaluation;
use App\Models\Submission;
use App\Services\GeminiEvaluationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class EvaluateSubmissionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** Số lần thử lại tối đa khi gọi Gemini thất bại (timeout, rate limit, lỗi mạng...) */
    public int $tries = 4;

    /** Giãn cách giữa các lần retry (giây): 1p -> 3p -> 10p */
    public array $backoff = [60, 180, 600];

    /** Timeout riêng cho job (giây), cao hơn HTTP timeout của service 1 chút */
    public int $timeout = 240;

    public function __construct(public Submission $submission) {}

    public function handle(GeminiEvaluationService $geminiService): void
    {
        $this->submission->update(['status' => Submission::STATUS_PROCESSING]);

        $result = $geminiService->evaluate($this->submission);

        Evaluation::updateOrCreate(
            ['submission_id' => $this->submission->id],
            $result
        );

        $this->submission->update(['status' => Submission::STATUS_GRADED]);
    }

    /**
     * Được Laravel gọi tự động khi job thất bại sau khi hết số lần $tries,
     * hoặc khi handle() ném exception không bắt được ở lần thử cuối.
     */
    public function failed(?Throwable $exception): void
    {
        $this->submission->update(['status' => Submission::STATUS_FAILED]);

        Log::error('EvaluateSubmissionJob failed', [
            'submission_id' => $this->submission->id,
            'error' => $exception?->getMessage(),
        ]);
    }
}
