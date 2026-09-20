<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('parents')->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();

            $table->index(['parent_id', 'name']); // Tra cứu học sinh theo phụ huynh + tên
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
