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
    <input type="text" name="model" value="{{ old('model', $aiProvider->model ?? '') }}" class="form-control @error('model') is-invalid @enderror">
    @error('model')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
