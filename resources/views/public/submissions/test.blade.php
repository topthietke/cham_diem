@extends('layouts.public')

@section('title', 'Nộp bài test từ YouTube')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-4">
                <h1 class="h3 fw-bold mb-1">Nộp bài test</h1>
                <p class="text-muted-soft mb-0">Dán link YouTube để lấy tiêu đề video và gợi ý tên học sinh tự động.</p>
            </div>

            <div class="card-soft p-4 p-md-5">
                <form id="youtube-inspection-form" method="POST" action="{{ route('public.submissions.test.inspect') }}"
                    novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-lg-9 col-md-9">
                            <label class="form-label" for="youtube_url">Link video YouTube</label>
                            <input id="youtube_url" type="url" name="youtube_url" class="form-control"  placeholder="https://www.youtube.com/watch?v=..." required>
                            <div id="youtube-error" class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <label class="form-label" for="youtube_url"> --- </label>
                            <button id="inspect-submit" type="submit" class="btn btn-primary-soft w-100 py-2">
                                <i class="bi bi-stars me-1"></i>Nộp bài
                            </button>
                        </div>
                    </div>


                    <div id="video-result" class="alert alert-success d-none my-3" role="status"></div>

                    <div class="row my-3">
                        <div class="col-lg-6 col-md-6">
                            <label class="form-label" for="title">Tên tiêu đề</label>
                            <input id="title" type="text" name="title" class="form-control"
                                placeholder="Tên sẽ được gợi ý sau khi nộp bài test" required>
                            <div class="form-text">Gemini sẽ tự điền tiêu đề sau khi phân tích video.
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label class="form-label" for="student_name">Tên học sinh</label>
                            <input id="student_name" type="text" name="student_name" class="form-control"
                                placeholder="Tên sẽ được gợi ý sau khi nộp bài test" required>
                            <div class="form-text">Gemini sẽ lấy tên học sinh được giới thiệu trong video.
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            const $form = $('#youtube-inspection-form');
            const $url = $('#youtube_url');
            const $title = $('#title');
            const $name = $('#student_name');
            const $error = $('#youtube-error');
            const $result = $('#video-result');
            const $button = $('#inspect-submit');

            $form.on('submit', function (event) {
                event.preventDefault();
                $url.removeClass('is-invalid');
                $error.text('');
                $result.addClass('d-none').text('');
                $button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" aria-hidden="true"></span>Đang xem xét video...');

                $.ajax({
                    url: $form.attr('action'),
                    method: 'POST',
                    data: $form.serialize(),
                    dataType: 'json'
                }).done(function (data) {
                    $title.val(data.title).trigger('input');
                    $name.val(data.student_name).trigger('input');
                    $result.text('Gemini đã phân tích video và tự điền tiêu đề cùng tên học sinh.').removeClass('d-none');
                }).fail(function (xhr) {
                    const message = xhr.responseJSON?.errors?.youtube_url?.[0] || 'Không thể xem xét video lúc này.';
                    $url.addClass('is-invalid');
                    $error.text(message);
                }).always(function () {
                    $button.prop('disabled', false).html('<i class="bi bi-stars me-1"></i>Phân tích bằng Gemini');
                });
            });
        });
    </script>
@endpush