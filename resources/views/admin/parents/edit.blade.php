@extends('layouts.admin')

@section('title', 'Sửa phụ huynh')

@section('content')
<h1 class="h4 fw-bold mb-4">Sửa thông tin phụ huynh</h1>

<div class="card-soft p-4 p-md-5" style="max-width: 560px">
    <form method="POST" action="{{ route('admin.parents.update', $parent) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label fw-semibold">Họ tên</label>
            <input type="text" name="name" value="{{ old('name', $parent->name) }}" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Số điện thoại</label>
            <input type="text" name="phone" value="{{ old('phone', $parent->phone) }}" class="form-control @error('phone') is-invalid @enderror" required>
            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email', $parent->email) }}" class="form-control @error('email') is-invalid @enderror">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold">Địa chỉ</label>
            <input type="text" name="address" value="{{ old('address', $parent->address) }}" class="form-control @error('address') is-invalid @enderror">
            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary-soft">Lưu thay đổi</button>
        <a href="{{ route('admin.parents.index') }}" class="btn btn-outline-soft">Huỷ</a>
    </form>
</div>
@endsection
