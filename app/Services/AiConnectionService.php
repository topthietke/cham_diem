<?php

namespace App\Services;

use App\Models\AiProvider;
use Illuminate\Support\Facades\Http;
use Throwable;

class AiConnectionService
{
    /**
     * @return array{success: bool, message: string}
     */
    public function check(AiProvider $ai): array
    {
        if (! $ai->is_enabled) {
            return ['success' => false, 'message' => 'AI này đang được tắt.'];
        }

        if (! $ai->api_key) {
            return ['success' => false, 'message' => 'Chưa cấu hình API key.'];
        }

        try {
            $response = match ($ai->provider) {
                'gemini' => Http::acceptJson()->timeout(15)->get(
                    "https://generativelanguage.googleapis.com/v1beta/models/{$ai->model}",
                    ['key' => $ai->api_key]
                ),
                'openai' => Http::acceptJson()->withToken($ai->api_key)->timeout(15)->get(
                    'https://api.openai.com/v1/models/'.$ai->model
                ),
                'claude' => Http::acceptJson()->withHeaders([
                    'x-api-key' => $ai->api_key,
                    'anthropic-version' => '2023-06-01',
                ])->timeout(15)->get('https://api.anthropic.com/v1/models/'.$ai->model),
                'copilot' => null,
                default => null,
            };
        } catch (Throwable) {
            return ['success' => false, 'message' => 'Không thể kết nối đến dịch vụ AI.'];
        }

        if ($ai->provider === 'copilot') {
            return ['success' => false, 'message' => 'Copilot chưa có endpoint API độc lập để kiểm tra tự động.'];
        }

        return $response?->successful()
            ? ['success' => true, 'message' => 'Kết nối thành công.']
            : ['success' => false, 'message' => 'API key hoặc model không hợp lệ.'];
    }
}
