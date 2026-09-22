@csrf
<div class="mb-3">
    <label class="form-label fw-semibold">Tên hiển thị</label>
    <input type="text" name="name" value="{{ old('name', $aiProvider->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" required>
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Provider code</label>
    <input type="text" name="provider" value="{{ old('provider', $aiProvider->provider ?? '') }}" class="form-control @error('provider') is-invalid @enderror" required>
    @error('provider')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Model</label>
    <select name="model" id="ai-model" class="form-select @error('model') is-invalid @enderror" data-current-model="{{ old('model', $aiProvider->model ?? '') }}" disabled>
        <option value="">Chọn provider và nhập API key trước</option>
    </select>
    @error('model')<div class="invalid-feedback">{{ $message }}</div>@enderror
    <div id="ai-model-status" class="form-text"></div>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">API key</label>
    <input type="password" name="api_key" value="" class="form-control @error('api_key') is-invalid @enderror" autocomplete="new-password" {{ isset($aiProvider) ? '' : 'required' }}>
    @if (isset($aiProvider))<div class="form-text">Để trống nếu muốn giữ API key hiện tại.</div>@endif
    @error('api_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="form-check mb-4">
    <input type="hidden" name="is_enabled" value="0">
    <input type="checkbox" name="is_enabled" value="1" class="form-check-input" id="is_enabled" @checked(old('is_enabled', $aiProvider->is_enabled ?? true))>
    <label class="form-check-label" for="is_enabled">Cho phép kết nối AI này</label>
</div>
<button type="submit" class="btn btn-primary-soft">{{ isset($aiProvider) ? 'Lưu thay đổi' : 'Thêm AI' }}</button>
<a href="{{ route('admin.ai-providers.index') }}" class="btn btn-outline-soft">Huỷ</a>

@push('scripts')
<script>
    (() => {
        const providerInput = document.querySelector('input[name="provider"]');
        const apiKeyInput = document.querySelector('input[name="api_key"]');
        const modelSelect = document.querySelector('#ai-model');
        const status = document.querySelector('#ai-model-status');
        const currentModel = modelSelect.dataset.currentModel;
        let requestId = 0;

        const renderModels = (models, emptyLabel) => {
            modelSelect.replaceChildren();

            if (models.length === 0) {
                const option = new Option(emptyLabel, '');
                modelSelect.add(option);
                return;
            }

            models.forEach(model => {
                const option = new Option(model, model, false, model === currentModel);
                modelSelect.add(option);
            });
        };

        const loadModels = async () => {
            const provider = providerInput.value.trim().toLowerCase();
            const apiKey = apiKeyInput.value.trim();
            const currentRequestId = ++requestId;

            modelSelect.disabled = true;
            modelSelect.innerHTML = '<option value="">Đang tải model...</option>';
            status.textContent = '';

            if (!provider || !apiKey) {
                renderModels(currentModel ? [currentModel] : [], currentModel ? '' : 'Nhập provider và API key để tải model');
                status.textContent = currentModel ? 'Nhập API key mới để cập nhật danh sách model.' : '';
                modelSelect.disabled = !currentModel;
                return;
            }

            try {
                const response = await fetch('{{ route('admin.ai-providers.models') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ provider, api_key: apiKey }),
                });
                const data = await response.json();

                if (currentRequestId !== requestId) return;
                if (!response.ok) throw new Error(data.message || 'Không thể tải danh sách model.');

                const models = data.models || [];
                renderModels(models, 'Không có model khả dụng');
                modelSelect.disabled = !models.length;
                status.textContent = data.message || '';
            } catch (error) {
                if (currentRequestId !== requestId) return;
                renderModels(currentModel ? [currentModel] : [], currentModel ? '' : 'Không thể tải model');
                modelSelect.disabled = !currentModel;
                status.textContent = error.message;
            }
        };

        providerInput.addEventListener('change', loadModels);
        apiKeyInput.addEventListener('change', loadModels);
        loadModels();
    })();
</script>
@endpush
