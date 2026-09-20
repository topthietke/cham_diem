@extends('layouts.admin')

@section('title', 'Thêm tài khoản admin')

@section('content')
<h1 class="h4 fw-bold mb-4">Thêm tài khoản admin</h1>

<div class="card-soft p-4 p-md-5" style="max-width: 520px">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Họ tên</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Vai trò</label>
            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                <option value="evaluator" @selected(old('role') === 'evaluator')>Giám khảo (Evaluator)</option>
                <option value="super_admin" @selected(old('role') === 'super_admin')>Super Admin</option>
            </select>
            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Mật khẩu</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary-soft">Tạo tài khoản</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-soft">Huỷ</a>
    </form>
</div>
@endsection
