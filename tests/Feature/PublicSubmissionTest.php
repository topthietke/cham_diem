<?php

namespace Tests\Feature;

use App\Jobs\EvaluateSubmissionJob;
use App\Models\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class PublicSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_submission_is_saved_and_evaluation_is_queued(): void
    {
        Queue::fake();

        $response = $this->post(route('public.submissions.store'), [
            'parent_name' => 'Nguyen Van A',
            'phone' => '0901234567',
            'email' => 'parent@example.com',
            'student_name' => 'Nguyen Van B',
            'title' => 'Bai thuyet trinh',
            'youtube_url' => 'https://www.youtube.com/watch?v=example',
        ]);

        $submission = Submission::query()->firstOrFail();

        $response
            ->assertRedirect(route('public.submissions.show', $submission))
            ->assertSessionHas('status');

        $this->assertSame(Submission::STATUS_PENDING, $submission->status);
        Queue::assertPushed(EvaluateSubmissionJob::class, function (EvaluateSubmissionJob $job) use ($submission): bool {
            return $job->submission->is($submission);
        });
    }
}
