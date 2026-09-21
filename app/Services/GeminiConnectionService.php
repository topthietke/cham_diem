<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Throwable;

class GeminiConnectionService
{
    /**
     * @return array{success: bool, message: string, model: string}
     */
    public function check(): array
    {
        $apiKey = (string) config('services.gemini.key');
        $model = (string) config('services.gemini.model', 'gemini-2.5-pro');

        if ($apiKey === '') {
            return [
                'success' => false,
                'message' => 'Chưa cấu hình GEMINI_API_KEY.',
                'model' => $model,
            ];
        }

        try {
            $response = Http::acceptJson()
                ->timeout(15)
                ->get("https://generativelanguage.googleapis.com/v1beta/models/{$model}", [
                    'key' => $apiKey,
                ]);
        } catch (Throwable) {
            return [
                'success' => false,
                'message' => 'Không thể kết nối đến Gemini. Vui lòng kiểm tra mạng hoặc thử lại sau.',
                'model' => $model,
            ];
        }

        if ($response->successful()) {
            return [
                'success' => true,
                'message' => "Kết nối Gemini thành công với model {$model}.",
                'model' => $model,
            ];
        }

        return [
            'success' => false,
            'message' => 'Gemini từ chối kết nối hoặc model không khả dụng. Vui lòng kiểm tra API key và GEMINI_MODEL.',
            'model' => $model,
        ];
    }
}
