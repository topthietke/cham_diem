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
            <form method="POST" action="{{ route('public.submissions.store') }}" novalidate>
                @csrf

                <div class="mb-4">
                    <div class="d-flex align-items-start gap-2 mb-3">
                        <i class="bi bi-youtube fs-5 text-danger"></i>
                        <div>
                            <h2 class="h6 fw-bold mb-1">Thông tin bài thi</h2>
                            <p class="text-muted-soft small mb-0">Dán đường dẫn video YouTube để hệ thống bắt đầu chấm điểm.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" for="youtube_url">Link video YouTube</label>
                            <input id="youtube_url" type="url" name="youtube_url" value="{{ old('youtube_url') }}"
                                   class="form-control @error('youtube_url') is-invalid @enderror"
                                   placeholder="https://www.youtube.com/watch?v=...">
                            @error('youtube_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="student_name">Tên học sinh</label>
                            <input id="student_name" type="text" name="student_name" value="{{ old('student_name') }}"
                                   class="form-control @error('student_name') is-invalid @enderror">
                            @error('student_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="title">Tiêu đề bài thi</label>
                            <input id="title" type="text" name="title" value="{{ old('title') }}"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="VD: Vòng loại - Đọc sách vs Smartphone">
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4" style="border-color: var(--border)">

                <div class="mb-4">
                    <h2 class="h6 fw-bold text-uppercase-none mb-3">
                        <i class="bi bi-person-heart me-1"></i>Thông tin phụ huynh
                    </h2>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="parent_name">Họ tên phụ huynh</label>
                            <input id="parent_name" type="text" name="parent_name" value="{{ old('parent_name') }}"
                                   class="form-control @error('parent_name') is-invalid @enderror">
                            @error('parent_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="phone">Số điện thoại</label>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="Dùng để tra cứu bài nộp sau này">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="email">Email (không bắt buộc)</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="address">Địa chỉ (không bắt buộc)</label>
                            <input id="address" type="text" name="address" value="{{ old('address') }}"
                                   class="form-control @error('address') is-invalid @enderror">
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
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

@push('styles')
    <style>
        .validation-error {
            display: block;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .form-control.client-invalid {
            border-color: #dc3545;
        }

        .form-control.client-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.12);
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(function () {
            const $form = $('form[action="{{ route('public.submissions.store') }}"]');
            const requiredFields = {
                parent_name: 'Vui lòng nhập họ tên phụ huynh.',
                phone: 'Vui lòng nhập số điện thoại.',
                student_name: 'Vui lòng nhập tên học sinh.',
                title: 'Vui lòng nhập tiêu đề bài thi.',
                youtube_url: 'Vui lòng nhập link video YouTube.'
            };

            function showError($field, message) {
                $field.removeClass('is-valid').addClass('is-invalid client-invalid');
                $field.siblings('.js-validation-error').remove();
                $('<label>', {
                    class: 'validation-error js-validation-error',
                    text: message
                }).insertAfter($field);
            }

            function clearError($field) {
                $field.removeClass('client-invalid is-invalid');
                $field.siblings('.js-validation-error').remove();
            }

            $form.on('submit', function (event) {
                let isValid = true;
                let $firstInvalidField = $();

                $.each(requiredFields, function (fieldName, message) {
                    const $field = $form.find('[name="' + fieldName + '"]');

                    if ($.trim($field.val()) === '') {
                        showError($field, message);
                        $firstInvalidField = $firstInvalidField.length ? $firstInvalidField : $field;
                        isValid = false;
                    } else {
                        clearError($field);
                    }
                });

                const $phone = $form.find('[name="phone"]');
                if ($.trim($phone.val()) !== '' && !/^[0-9+\s-]{8,20}$/.test($.trim($phone.val()))) {
                    showError($phone, 'Số điện thoại không hợp lệ.');
                    $firstInvalidField = $firstInvalidField.length ? $firstInvalidField : $phone;
                    isValid = false;
                }

                const $email = $form.find('[name="email"]');
                if ($.trim($email.val()) !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($.trim($email.val()))) {
                    showError($email, 'Vui lòng nhập địa chỉ email hợp lệ.');
                    $firstInvalidField = $firstInvalidField.length ? $firstInvalidField : $email;
                    isValid = false;
                } else {
                    clearError($email);
                }

                const youtubeUrl = $.trim($form.find('[name="youtube_url"]').val());
                if (youtubeUrl !== '' && !/^https?:\/\/(www\.)?(youtube\.com|youtu\.be)\//i.test(youtubeUrl)) {
                    showError($form.find('[name="youtube_url"]'), 'Vui lòng nhập đúng đường dẫn video YouTube.');
                    $firstInvalidField = $firstInvalidField.length ? $firstInvalidField : $form.find('[name="youtube_url"]');
                    isValid = false;
                }

                if (!isValid) {
                    event.preventDefault();
                    $firstInvalidField.trigger('focus');
                }
            });

            $form.find('input, textarea, select').on('input change', function () {
                if ($.trim($(this).val()) !== '') {
                    clearError($(this));
                }
            });
        });
    </script>
@endpush
