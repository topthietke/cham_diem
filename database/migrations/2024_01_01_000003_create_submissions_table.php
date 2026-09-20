<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->string('title');
            $table->string('youtube_url');
            $table->enum('status', ['pending', 'processing', 'graded', 'failed'])
                ->default('pending');
            $table->timestamps();

            $table->index('status'); // Lọc nhanh theo trạng thái chấm bài (dashboard admin, queue polling)
            $table->index(['student_id', 'created_at']); // Lịch sử bài nộp theo học sinh
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
