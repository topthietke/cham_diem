@extends('layouts.public')

@section('title', 'Kết quả chấm bài - '.$submission->title)

@php
    $badgeMap = [
        'pending' => ['badge-pending', 'Chờ chấm'],
        'processing' => ['badge-processing', 'Đang chấm điểm...'],
        'graded' => ['badge-graded', 'Đã chấm xong'],
        'failed' => ['badge-failed', 'Chấm điểm thất bại'],
    ];
    [$badgeClass, $badgeLabel] = $badgeMap[$submission->status];

    $criteriaMap = [
        'content' => [
            'label' => 'Content — Nội dung & lập luận',
            'max' => 40,
            'items' => [
                'clarity' => ['Clarity of Arguments', 15],
                'evidence' => ['Quality of Evidence', 15],
                'originality' => ['Originality', 10],
            ],
        ],
        'strategy' => [
            'label' => 'Strategy — Chiến thuật',
            'max' => 30,
            'items' => [
                'rebuttal' => ['Rebuttal', 15],
                'clash' => ['Clash', 10],
                'time_management' => ['Time Management', 5],
            ],
        ],
        'style' => [
            'label' => 'Style — Phong cách',
            'max' => 30,
            'items' => [
                'body_language' => ['Body Language & Eye Contact', 10],
                'voice_delivery' => ['Voice & Delivery', 10],
                'academic_language' => ['Academic Language', 10],
            ],
        ],
    ];

    $stars = fn (int $value, int $max = 5) => str_repeat('★', max(0, min($value, $max))).str_repeat('☆', $max - max(0, min($value, $max)));
@endphp

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">

        <div class="d-flex flex-wrap align-items-start justify-content-between gap-2 mb-4">
            <div>
                <h1 class="h4 fw-bold mb-1">{{ $submission->title }}</h1>
                <p class="text-muted-soft mb-0">
                    <i class="bi bi-mortarboard me-1"></i>{{ $submission->student->name }}
                    &nbsp;·&nbsp;
                    <a href="{{ $submission->youtube_url }}" target="_blank" class="text-decoration-none">
                        <i class="bi bi-youtube me-1"></i>Xem video
                    </a>
                </p>
            </div>
            <span class="badge-status {{ $badgeClass }}">{{ $badgeLabel }}</span>
        </div>

        @if (in_array($submission->status, ['pending', 'processing']))
            <div class="card-soft p-5 text-center">
                <div class="spinner-border mb-3" style="color: var(--primary)" role="status"></div>
                <h2 class="h6 fw-bold mb-1">Bài thi đang được chấm điểm tự động</h2>
                <p class="text-muted-soft mb-0">Quá trình này thường mất vài phút. Bạn có thể tải lại trang sau để xem kết quả.</p>
            </div>
        @elseif ($submission->status === 'failed')
            <div class="card-soft p-5 text-center">
                <i class="bi bi-exclamation-triangle fs-1 mb-2" style="color: var(--peach)"></i>
                <h2 class="h6 fw-bold mb-1">Chấm điểm chưa thành công</h2>
                <p class="text-muted-soft mb-0">Đội ngũ sẽ kiểm tra và chấm lại bài thi của bạn sớm nhất.</p>
            </div>
        @else
            @php $evaluation = $submission->evaluation; @endphp

            {{-- Judge Score --}}
            <div class="card-soft p-4 p-md-5 mb-4 text-center">
                <div class="text-muted-soft fw-semibold mb-1">Điểm tổng (Judge Score)</div>
                <div class="display-4 fw-bold" style="color: var(--primary)">{{ $evaluation->total_score }}<span class="fs-4 text-muted-soft">/100</span></div>
                <p class="text-muted-soft mb-0 mt-2">{{ $evaluation->judge_score_note }}</p>
            </div>

            {{-- Rubric chi tiết: tabs Content / Strategy / Style --}}
            <div class="card-soft p-4 p-md-5 mb-4">
                <h2 class="h6 fw-bold mb-3">Bảng điểm chi tiết (Rubric)</h2>

                <ul class="nav nav-pills nav-pills-soft mb-4 gap-2" role="tablist">
                    @foreach ($criteriaMap as $key => $group)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if ($loop->first) active @endif"
                                    data-bs-toggle="pill" data-bs-target="#tab-{{ $key }}" type="button">
                                {{ $group['label'] }}
                                <span class="ms-1">({{ data_get($evaluation->rubric_scores, "$key.sub_total", 0) }}/{{ $group['max'] }})</span>
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    @foreach ($criteriaMap as $key => $group)
                        <div class="tab-pane fade @if ($loop->first) show active @endif" id="tab-{{ $key }}">
                            <table class="table">
                                <tbody>
                                    @foreach ($group['items'] as $itemKey => [$itemLabel, $itemMax])
                                        <tr>
                                            <td>{{ $itemLabel }}</td>
                                            <td class="text-end fw-semibold" style="width: 90px">
                                                {{ data_get($evaluation->rubric_scores, "$key.$itemKey", 0) }}/{{ $itemMax }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p class="text-muted-soft mb-0">
                                <i class="bi bi-chat-square-quote me-1"></i>
                                {{ data_get($evaluation->rubric_scores, "$key.note") }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Judge Feedback --}}
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card-soft p-4 h-100">
                        <h2 class="h6 fw-bold mb-3" style="color: #1B8C7A">
                            <i class="bi bi-hand-thumbs-up me-1"></i>Điểm mạnh nhất
                        </h2>
                        <ul class="mb-0 ps-3">
                            @foreach ($evaluation->strengths as $point)
                                <li class="mb-2">{{ $point }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-soft p-4 h-100">
                        <h2 class="h6 fw-bold mb-3" style="color: #B5522B">
                            <i class="bi bi-lightbulb me-1"></i>Cần cải thiện
                        </h2>
                        <ul class="mb-0 ps-3">
                            @foreach ($evaluation->improvements as $point)
                                <li class="mb-2">{{ $point }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-soft p-4 mb-4" style="background: var(--peach-soft); border-color: transparent">
                <h2 class="h6 fw-bold mb-2"><i class="bi bi-exclamation-circle me-1"></i>Lỗi mất điểm nhiều nhất</h2>
                <p class="mb-0">{{ $evaluation->critical_error }}</p>
            </div>

            {{-- Speaker Diagnosis --}}
            <div class="card-soft p-4 p-md-5 mb-4">
                <h2 class="h6 fw-bold mb-4">Chẩn đoán trình độ (Speaker Diagnosis)</h2>
                <div class="row g-3 text-center">
                    @foreach (['content' => 'Content', 'strategy' => 'Strategy', 'delivery' => 'Delivery', 'rebuttal' => 'Rebuttal'] as $key => $label)
                        <div class="col-6 col-md-3">
                            <div class="text-muted-soft small fw-semibold mb-1">{{ $label }}</div>
                            <div class="fs-4 star-filled" style="letter-spacing: 2px">
                                {{ $stars((int) data_get($evaluation->diagnosis, $key, 0)) }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <span class="badge-status badge-processing">
                        Trình độ tổng quát: {{ data_get($evaluation->diagnosis, 'level', '—') }}
                    </span>
                </div>
            </div>

            {{-- Coaching Plan --}}
            <div class="card-soft p-4 p-md-5 mb-4">
                <h2 class="h6 fw-bold mb-3">Lộ trình luyện tập (Coaching Plan)</h2>
                <div class="accordion" id="coachingAccordion">
                    @foreach (['week_1_2' => 'Tuần 1–2', 'week_3' => 'Tuần 3', 'week_4' => 'Tuần 4'] as $key => $label)
                        <div class="accordion-item border-0 mb-2" style="background: var(--bg); border-radius: 12px">
                            <h2 class="accordion-header">
                                <button class="accordion-button @if (! $loop->first) collapsed @endif" type="button"
                                        style="background: transparent; box-shadow: none; font-weight: 600; border-radius: 12px"
                                        data-bs-toggle="collapse" data-bs-target="#week-{{ $key }}">
                                    {{ $label }}
                                </button>
                            </h2>
                            <div id="week-{{ $key }}" class="accordion-collapse collapse @if ($loop->first) show @endif"
                                 data-bs-parent="#coachingAccordion">
                                <div class="accordion-body pt-0">
                                    {{ data_get($evaluation->coaching_plan, $key) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Feedback --}}
        <div class="card-soft p-4 p-md-5">
            <h2 class="h6 fw-bold mb-3"><i class="bi bi-chat-dots me-1"></i>Gửi phản hồi cho ban giám khảo</h2>

            <form method="POST" action="{{ route('public.feedback.store', $submission) }}" class="mb-4">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Số điện thoại đã dùng để nộp bài</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="form-control @error('phone') is-invalid @enderror" required>
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Nội dung phản hồi</label>
                        <textarea name="message" rows="1" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                        @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary-soft mt-3">Gửi phản hồi</button>
            </form>

            @if ($submission->feedbacks->isNotEmpty())
                <hr style="border-color: var(--border)">
                @foreach ($submission->feedbacks as $feedback)
                    <div class="mb-3">
                        <div class="fw-semibold small text-muted-soft mb-1">
                            <i class="bi bi-person-circle me-1"></i>Phụ huynh · {{ $feedback->created_at->format('d/m/Y H:i') }}
                        </div>
                        <p class="mb-2">{{ $feedback->message }}</p>
                        @if ($feedback->admin_reply)
                            <div class="ps-3 border-start" style="border-color: var(--primary) !important">
                                <div class="fw-semibold small mb-1" style="color: var(--primary)">Phản hồi từ Ban tổ chức</div>
                                <p class="mb-0">{{ $feedback->admin_reply }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
