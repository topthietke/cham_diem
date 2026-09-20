<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 20)->unique(); // Định danh chính, dùng để tra cứu bài nộp
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            // unique('phone') ở trên đã tự tạo index B-Tree, không cần khai báo thêm index('phone')
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
