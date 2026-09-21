<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('ai_providers')) {
            return;
        }

        $apiKey = env('GEMINI_API_KEY');

        if (! $apiKey) {
            return;
        }

        DB::table('ai_providers')
            ->where('provider', 'gemini')
            ->whereNull('api_key')
            ->update([
                'api_key' => Crypt::encryptString($apiKey),
                'model' => env('GEMINI_MODEL', 'gemini-2.5-pro'),
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('ai_providers')) {
            return;
        }

        DB::table('ai_providers')
            ->where('provider', 'gemini')
            ->update([
                'api_key' => null,
                'model' => 'gemini-2.5-pro',
                'updated_at' => now(),
            ]);
    }
};
