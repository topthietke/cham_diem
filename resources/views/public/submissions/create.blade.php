@extends('layouts.public')

@section('title', 'Nộp bài thi thuyết trình / tranh biện')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="mb-4">
            <h1 class="h3 fw-bold mb-1">Nộp bài thi cho con</h1>
            <p class="text-muted-soft mb-0">Điền thông tin và dán link YouTube bài thi. Hệ thống sẽ chấm điểm tự động theo Rubric quốc tế trong vài phút.</p>
        </div>

        <div class="card-soft p-4 p-md-5">
            <form method="POST" action="{{ route('public.submissions.store') }}">
                @csrf

                <div class="mb-4">
                    <h2 class="h6 fw-bold text-uppercase-none mb-3">
                        <i class="bi bi-person-heart me-1"></i>Thông tin phụ huynh
                    </h2>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Họ tên phụ huynh</label>
                            <input type="text" name="parent_name" value="{{ old('parent_name') }}"
                                   class="form-control @error('parent_name') is-invalid @enderror" required>
                            @error('parent_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="Dùng để tra cứu bài nộp sau này" required>
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email (không bắt buộc)</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Địa chỉ (không bắt buộc)</label>
                            <input type="text" name="address" value="{{ old('address') }}"
                                   class="form-control @error('address') is-invalid @enderror">
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4" style="border-color: var(--border)">

                <div class="mb-4">
                    <h2 class="h6 fw-bold mb-3"><i class="bi bi-mortarboard me-1"></i>Thông tin học sinh & bài thi</h2>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Tên học sinh</label>
                            <input type="text" name="student_name" value="{{ old('student_name') }}"
                                   class="form-control @error('student_name') is-invalid @enderror" required>
                            @error('student_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tiêu đề bài thi</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="VD: Vòng loại - Đọc sách vs Smartphone" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Link video YouTube</label>
                            <input type="url" name="youtube_url" value="{{ old('youtube_url') }}"
                                   class="form-control @error('youtube_url') is-invalid @enderror"
                                   placeholder="https://www.youtube.com/watch?v=..." required>
                            @error('youtube_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary-soft w-100 py-2">
                    <i class="bi bi-send-check me-1"></i>Nộp bài & bắt đầu chấm điểm
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
