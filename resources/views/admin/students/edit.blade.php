@extends('layouts.admin')

@section('title', 'Sửa học sinh')

@section('content')
<h1 class="h4 fw-bold mb-4">Sửa thông tin học sinh</h1>

<div class="card-soft p-4 p-md-5" style="max-width: 560px">
    <form method="POST" action="{{ route('admin.students.update', $student) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label fw-semibold">Tên học sinh</label>
            <input type="text" name="name" value="{{ old('name', $student->name) }}" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold">Phụ huynh</label>
            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror" required>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" @selected(old('parent_id', $student->parent_id) == $parent->id)>
                        {{ $parent->name }} — {{ $parent->phone }}
                    </option>
                @endforeach
            </select>
            @error('parent_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary-soft">Lưu thay đổi</button>
        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-soft">Huỷ</a>
    </form>
</div>
@endsection
