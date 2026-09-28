@extends('layouts.public')

@section('title', 'Nộp bài thi thuyết trình / tranh biện')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="mb-4">
            <h3 class="fw-bold mb-1">Thông tin bài thi</h3>
        </div>

        <div class="card-soft p-4">
            <form method="POST" action="{{ route('public.submissions.store') }}"
                data-inspect-url="{{ route('public.submissions.inspect') }}" novalidate>
                @csrf
                <div class="mb-4">                    
                    <div class="row align-items-end mb-3">
                        <div class="col-lg-10 col-md-9 col-sm-12 mb-3 mb-md-0">
                            <h6 class="form-label d-flex align-items-center" for="youtube_url">
                                <i class="bi bi-youtube fs-3 text-danger"></i>                                
                                <span class="ms-2">Liên kết YouTube</span>
                            </h6>
                            <input id="youtube_url" type="url" name="youtube_url" value="{{ old('youtube_url') }}"
                                   class="form-control @error('youtube_url') is-invalid @enderror"
                                   placeholder="https://www.youtube.com/watch?v=...">
                            @error('youtube_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-12 mb-3 mb-md-0">
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                <i class="bi bi-send-check me-1"></i>
                                Nộp bài
                            </button>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="student_name">Tên học sinh</label>
                            <input id="student_name" type="text" name="student_name" value="{{ old('student_name') }}"
                                placeholder="VD: Nguyễn Văn A"    
                                class="form-control @error('student_name') is-invalid @enderror">
                            @error('student_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="title">Tiêu đề bài thi</label>
                            <input id="title" type="text" name="title" value="{{ old('title') }}"
                                   class="form-control @error('title') is-invalid @enderror"
                                placeholder="Tự điền theo tiêu đề video YouTube">
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4" style="border-color: var(--border)">

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="parent_info" value="1" id="parent_info"
                           @checked(old('parent_info'))>
                    <label class="form-check-label" for="parent_info">Điền thông tin phụ huynh</label>
                </div>

                <div class="mb-4" id="parent_details" @if (! old('parent_info')) hidden @endif>
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
                youtube_url: 'Vui lòng nhập link video YouTube.'
            };
            const $submitButton = $form.find('[type="submit"]');
            const submitButtonHtml = $submitButton.html();
            let youtubeInspected = false;
            let isInspecting = false;

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

            function toggleParentFields() {
                const enabled = $('#parent_info').is(':checked');
                $('#parent_details').prop('hidden', !enabled)
                    .find('input').prop('disabled', !enabled);

                if (!enabled) {
                    $('#parent_details input').each(function () {
                        clearError($(this));
                    });
                }
            }

            $('#parent_info').on('change', toggleParentFields);
            toggleParentFields();

            $form.on('submit', function (event) {
                if (youtubeInspected) {
                    return;
                }

                event.preventDefault();

                if (isInspecting) {
                    return;
                }

                let isValid = true;
                let $firstInvalidField = $();

                if ($('#parent_info').is(':checked')) {
                    $.each({
                        parent_name: 'Vui lòng nhập họ tên phụ huynh.',
                        phone: 'Vui lòng nhập số điện thoại.'
                    }, function (fieldName, message) {
                        const $field = $form.find('[name="' + fieldName + '"]');

                        if ($.trim($field.val()) === '') {
                            showError($field, message);
                            $firstInvalidField = $firstInvalidField.length ? $firstInvalidField : $field;
                            isValid = false;
                        } else {
                            clearError($field);
                        }
                    });
                }

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

                const parentInfoEnabled = $('#parent_info').is(':checked');
                const $phone = $form.find('[name="phone"]');
                if (parentInfoEnabled && !/^[0-9+\s-]{8,20}$/.test($.trim($phone.val()))) {
                    showError($phone, 'Số điện thoại không hợp lệ.');
                    $firstInvalidField = $firstInvalidField.length ? $firstInvalidField : $phone;
                    isValid = false;
                }

                const $email = $form.find('[name="email"]');
                if (parentInfoEnabled && $.trim($email.val()) !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($.trim($email.val()))) {
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
                    $firstInvalidField.trigger('focus');
                    return;
                }

                isInspecting = true;
                $submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>Đang phân tích video...');

                $.ajax({
                    url: $form.data('inspect-url'),
                    method: 'POST',
                    dataType: 'json',
                    headers: { Accept: 'application/json' },
                    data: {
                        _token: $form.find('input[name="_token"]').val(),
                        youtube_url: $.trim($form.find('[name="youtube_url"]').val())
                    }
                }).done(function (data) {
                    const $studentName = $form.find('[name="student_name"]');
                    const $title = $form.find('[name="title"]');

                    if (!data.student_name || !data.title) {
                        showError($form.find('[name="youtube_url"]'), 'Không lấy được tên học sinh hoặc tiêu đề từ video.');
                        isInspecting = false;
                        $submitButton.prop('disabled', false).html(submitButtonHtml);
                        return;
                    }

                    $studentName.val(data.student_name);
                    $title.val(data.title);
                    clearError($studentName);
                    clearError($title);
                    youtubeInspected = true;
                    isInspecting = false;
                    $submitButton.prop('disabled', false).html(submitButtonHtml);
                    $form[0].requestSubmit();
                }).fail(function (xhr) {
                    const message = xhr.responseJSON?.errors?.youtube_url?.[0]
                        || 'Không thể phân tích video YouTube. Vui lòng thử lại.';
                    showError($form.find('[name="youtube_url"]'), message);
                    isInspecting = false;
                    $submitButton.prop('disabled', false).html(submitButtonHtml);
                });
            });

            $form.find('input, textarea, select').on('input change', function () {
                if ($.trim($(this).val()) !== '') {
                    clearError($(this));
                }
            });
        });
    </script>
@endpush
