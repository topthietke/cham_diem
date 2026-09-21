<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiProvider;
use App\Services\AiConnectionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AiProviderController extends Controller
{
    public function index(): View
    {
        $aiProviders = AiProvider::orderBy('id')->get();

        return view('admin.ai-providers.index', compact('aiProviders'));
    }

    public function create(): View
    {
        return view('admin.ai-providers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        AiProvider::create($this->validated($request));

        return redirect()->route('admin.ai-providers.index')->with('status', 'Đã thêm AI.');
    }

    public function edit(AiProvider $aiProvider): View
    {
        return view('admin.ai-providers.edit', compact('aiProvider'));
    }

    public function update(Request $request, AiProvider $aiProvider): RedirectResponse
    {
        $data = $this->validated($request);

        if ($data['api_key'] === null) {
            unset($data['api_key']);
        }

        $aiProvider->update($data);

        return redirect()->route('admin.ai-providers.index')->with('status', 'Đã cập nhật AI.');
    }

    public function destroy(AiProvider $aiProvider): RedirectResponse
    {
        $aiProvider->delete();

        return back()->with('status', 'Đã xoá AI.');
    }

    public function check(AiProvider $aiProvider, AiConnectionService $connection): RedirectResponse
    {
        $result = $connection->check($aiProvider);

        $aiProvider->update([
            'connection_status' => $result['success'] ? AiProvider::STATUS_CONNECTED : AiProvider::STATUS_FAILED,
            'connection_message' => $result['message'],
            'last_checked_at' => now(),
        ]);

        return back()->with($result['success'] ? 'status' : 'error', "{$aiProvider->name}: {$result['message']}");
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        $currentProvider = $request->route('aiProvider');

        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'provider' => ['required', 'string', 'max:50', Rule::unique('ai_providers', 'provider')->ignore($currentProvider?->id)],
            'model' => ['nullable', 'string', 'max:150'],
            'api_key' => ['nullable', 'string', 'max:1000'],
            'is_enabled' => ['sometimes', 'boolean'],
        ]);
    }
}
