<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('provider')->unique();
            $table->string('model')->nullable();
            $table->text('api_key')->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->string('connection_status')->default('unknown');
            $table->text('connection_message')->nullable();
            $table->timestamp('last_checked_at')->nullable();
            $table->timestamps();
        });

        $now = now();

        DB::table('ai_providers')->insert([
            ['name' => 'ClaudeAI', 'provider' => 'claude', 'model' => 'claude-3-5-sonnet-latest', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Gemini', 'provider' => 'gemini', 'model' => 'gemini-2.5-pro', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'ChatGPT', 'provider' => 'openai', 'model' => 'gpt-4o-mini', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Copilot', 'provider' => 'copilot', 'model' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_providers');
    }
};
