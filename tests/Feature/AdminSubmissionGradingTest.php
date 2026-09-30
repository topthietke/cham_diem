<?php

namespace Tests\Feature;

use App\Models\Evaluation;
use App\Models\Student;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSubmissionGradingTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_save_manual_grading_changes(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_EVALUATOR]);
        $submission = $this->createSubmission();

        $response = $this->actingAs($admin)
            ->from(route('admin.submissions.show', $submission))
            ->put(route('admin.submissions.update', $submission), [
            'total_score' => 82,
            'judge_score_note' => 'Bài nói có lập luận tốt.',
            'critical_error' => 'Thiếu dẫn chứng.',
            'strengths' => "Lập luận rõ\nPhản biện tốt",
            'improvements' => 'Bổ sung dẫn chứng',
            'diagnosis' => [
                'content' => 4,
                'strategy' => 3,
                'delivery' => 4,
                'rebuttal' => 3,
                'level' => 'Strong',
            ],
            'coaching_plan' => [
                'week_1_2' => 'Luyện lập luận.',
                'week_3' => 'Đối chiếu bằng chứng.',
                'week_4' => 'Tập trình bày.',
            ],
            'rubric' => [
                'content' => ['clarity' => 12, 'evidence' => 13, 'originality' => 8, 'note' => 'Lập luận tốt'],
                'strategy' => ['rebuttal' => 12, 'clash' => 8, 'time_management' => 4, 'note' => 'Đúng thời gian'],
                'style' => ['body_language' => 8, 'voice_delivery' => 9, 'academic_language' => 8, 'note' => 'Nói rõ'],
            ],
        ]);

        $response->assertRedirect(route('admin.submissions.show', $submission));
        $response->assertSessionHas('grading_saved', true);

        $evaluation = Evaluation::where('submission_id', $submission->id)->firstOrFail();
        $this->assertSame(82, $evaluation->total_score);
        $this->assertSame(['Lập luận rõ', 'Phản biện tốt'], $evaluation->strengths);
        $this->assertSame(33, $evaluation->rubric_scores['content']['sub_total']);
        $this->assertSame(Submission::STATUS_GRADED, $submission->fresh()->status);

        $this->get(route('admin.submissions.show', $submission))
            ->assertOk()
            ->assertSee('Tải kết quả TXT');
    }

    public function test_saved_grading_can_be_downloaded_as_a_text_file(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_EVALUATOR]);
        $submission = $this->createSubmission();
        Evaluation::create([
            'submission_id' => $submission->id,
            'total_score' => 82,
            'judge_score_note' => 'Bài nói có lập luận tốt.',
            'critical_error' => 'Thiếu dẫn chứng.',
            'strengths' => ['Lập luận rõ'],
            'improvements' => ['Bổ sung dẫn chứng'],
            'diagnosis' => ['content' => 4, 'strategy' => 3, 'delivery' => 4, 'rebuttal' => 3, 'level' => 'Strong'],
            'coaching_plan' => ['week_1_2' => 'Luyện lập luận.'],
            'rubric_scores' => ['content' => ['clarity' => 12, 'evidence' => 13, 'originality' => 8, 'note' => 'Lập luận tốt']],
        ]);

        $response = $this->actingAs($admin)->get(route('admin.submissions.download', $submission));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
        $response->assertHeader('Content-Disposition', 'attachment; filename="Day_02_grading.txt"');
        $response->assertSeeText('Tổng điểm: 82');
        $response->assertSeeText('Nhận định tổng quan: Bài nói có lập luận tốt.');
        $response->assertSeeText('Clarity: 12');
        $response->assertSeeText('Điểm mạnh nhất:');
        $response->assertSeeText('Luyện lập luận.');
    }

    private function createSubmission(): Submission
    {
        $student = Student::create(['name' => 'Nguyễn An']);

        return Submission::create([
            'student_id' => $student->id,
            'title' => 'Day 02',
            'youtube_url' => 'https://youtu.be/example',
        ]);
    }
}