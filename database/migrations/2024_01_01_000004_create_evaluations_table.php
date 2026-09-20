<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            // Quan hệ 1-1 với submissions: mỗi bài nộp chỉ có 1 bảng điểm hiện hành
            // (chấm lại sẽ update/replace bản ghi này, không tạo bản ghi mới)
            $table->foreignId('submission_id')
                ->unique()
                ->constrained('submissions')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('total_score'); // 0-100

            // rubric_scores: { content: {clarity, evidence, originality, sub_total},
            //                  strategy: {...}, style: {...} }
            $table->json('rubric_scores');

            $table->text('judge_score_note')->nullable(); // Nhận định tổng quan kèm điểm số

            $table->json('strengths')->nullable();     // 2-3 điểm mạnh nhất
            $table->json('improvements')->nullable();  // 3 điểm cần cải thiện
            $table->text('critical_error')->nullable(); // Lỗi mất điểm nhiều nhất

            // diagnosis: { content: 4, strategy: 3, delivery: 4, rebuttal: 2, level: "Developing" }
            $table->json('diagnosis')->nullable();

            // coaching_plan: { week_1_2: {...CREL...}, week_3: {...}, week_4: {...} }
            $table->json('coaching_plan')->nullable();

            $table->longText('raw_ai_response')->nullable(); // Lưu nguyên văn JSON trả về từ Gemini để audit/debug

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
