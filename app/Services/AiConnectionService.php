<?php

namespace App\Services;

use App\Models\AiProvider;
use Illuminate\Support\Facades\Http;
use Throwable;

class AiConnectionService
{
    /**
     * @return array{models: list<string>, message: string|null}
     */
    public function models(string $provider, string $apiKey): array
    {
        try {
            $models = match ($provider) {
                'gemini' => $this->geminiModels($apiKey),
                'openai' => Http::acceptJson()->withToken($apiKey)->timeout(15)
                    ->get('https://api.openai.com/v1/models')->throw()->json('data', []),
                'claude' => Http::acceptJson()->withHeaders([
                    'x-api-key' => $apiKey,
                    'anthropic-version' => '2023-06-01',
                ])->timeout(15)->get('https://api.anthropic.com/v1/models')->throw()->json('data', []),
                default => [],
            };
        } catch (Throwable) {
            return ['models' => [], 'message' => 'Không thể tải danh sách model. Vui lòng kiểm tra provider và API key.'];
        }

        $modelNames = collect($models)
            ->pluck('id', 'name')
            ->filter(fn ($model) => is_string($model) && $model !== '')
            ->values()
            ->sort()
            ->values()
            ->all();

        return ['models' => $modelNames, 'message' => empty($modelNames) ? 'AI này không trả về model nào.' : null];
    }

    /**
     * @return list<array{id: string}>
     */
    private function geminiModels(string $apiKey): array
    {
        $models = [];
        $pageToken = null;

        do {
            $query = ['key' => $apiKey];

            if ($pageToken !== null) {
                $query['pageToken'] = $pageToken;
            }

            $response = Http::acceptJson()->timeout(15)
                ->get('https://generativelanguage.googleapis.com/v1beta/models', $query)
                ->throw()
                ->json();

            foreach ($response['models'] ?? [] as $model) {
                if (isset($model['name']) && str_starts_with($model['name'], 'models/')) {
                    $models[] = ['id' => substr($model['name'], 7)];
                }
            }

            $pageToken = $response['nextPageToken'] ?? null;
        } while ($pageToken !== null);

        return $models;
    }

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
