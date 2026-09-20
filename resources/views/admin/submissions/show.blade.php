@extends('layouts.admin')

@section('title', 'Chi tiết bài nộp')

@php
    $e = $submission->evaluation;
    $rubric = $e?->rubric_scores ?? [];
    $diagnosis = $e?->diagnosis ?? [];
    $coaching = $e?->coaching_plan ?? [];
@endphp

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-4">
    <div>
        <h1 class="h4 fw-bold mb-1">{{ $submission->title }}</h1>
        <p class="text-muted mb-0">
            {{ $submission->student->name }} · {{ $submission->student->parent->name }} ({{ $submission->student->parent->phone }})
            &nbsp;·&nbsp;<a href="{{ $submission->youtube_url }}" target="_blank">Xem video <i class="bi bi-box-arrow-up-right"></i></a>
        </p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <span class="badge-status badge-{{ $submission->status }}">{{ $submission->status }}</span>
        <form method="POST" action="{{ route('admin.submissions.regrade', $submission) }}"
              onsubmit="return confirm('Gửi lại cho Gemini chấm điểm từ đầu? Kết quả hiện tại sẽ bị ghi đè sau khi chấm xong.')">
            @csrf
            <button class="btn btn-outline-soft btn-sm"><i class="bi bi-arrow-repeat me-1"></i>AI chấm lại</button>
        </form>
    </div>
</div>

<form method="POST" action="{{ route('admin.submissions.update', $submission) }}">
    @csrf @method('PUT')

    <div class="card-soft p-4 mb-4">
        <h2 class="h6 fw-bold mb-3">Judge Score</h2>
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Tổng điểm (0-100)</label>
                <input type="number" min="0" max="100" name="total_score" value="{{ old('total_score', $e?->total_score ?? 0) }}" class="form-control" required>
            </div>
            <div class="col-md-9">
                <label class="form-label fw-semibold">Nhận định tổng quan</label>
                <input type="text" name="judge_score_note" value="{{ old('judge_score_note', $e?->judge_score_note) }}" class="form-control">
            </div>
        </div>
    </div>

    <div class="card-soft p-4 mb-4">
        <h2 class="h6 fw-bold mb-3">Rubric chi tiết</h2>

        @php
            $groups = [
                'content' => ['label' => 'Content (40)', 'items' => ['clarity' => ['Clarity', 15], 'evidence' => ['Evidence', 15], 'originality' => ['Originality', 10]]],
                'strategy' => ['label' => 'Strategy (30)', 'items' => ['rebuttal' => ['Rebuttal', 15], 'clash' => ['Clash', 10], 'time_management' => ['Time Mgmt', 5]]],
                'style' => ['label' => 'Style (30)', 'items' => ['body_language' => ['Body Language', 10], 'voice_delivery' => ['Voice & Delivery', 10], 'academic_language' => ['Academic Lang', 10]]],
            ];
        @endphp

        @foreach ($groups as $groupKey => $group)
            <div class="mb-4">
                <div class="fw-semibold mb-2">{{ $group['label'] }}</div>
                <div class="row g-2 mb-2">
                    @foreach ($group['items'] as $itemKey => [$itemLabel, $itemMax])
                        <div class="col-md-4">
                            <label class="form-label small">{{ $itemLabel }} (max {{ $itemMax }})</label>
                            <input type="number" min="0" max="{{ $itemMax }}"
                                   name="rubric[{{ $groupKey }}][{{ $itemKey }}]"
                                   value="{{ old("rubric.$groupKey.$itemKey", data_get($rubric, "$groupKey.$itemKey", 0)) }}"
                                   class="form-control form-control-sm" required>
                        </div>
                    @endforeach
                </div>
                <input type="text" name="rubric[{{ $groupKey }}][note]"
                       value="{{ old("rubric.$groupKey.note", data_get($rubric, "$groupKey.note")) }}"
                       class="form-control form-control-sm" placeholder="Ghi chú của giám khảo cho {{ $group['label'] }}">
            </div>
        @endforeach
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card-soft p-4 h-100">
                <label class="form-label fw-semibold">Điểm mạnh nhất (mỗi dòng 1 ý)</label>
                <textarea name="strengths" rows="5" class="form-control">{{ old('strengths', implode("\n", $e?->strengths ?? [])) }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-soft p-4 h-100">
                <label class="form-label fw-semibold">Cần cải thiện (mỗi dòng 1 ý)</label>
                <textarea name="improvements" rows="5" class="form-control">{{ old('improvements', implode("\n", $e?->improvements ?? [])) }}</textarea>
            </div>
        </div>
    </div>

    <div class="card-soft p-4 mb-4">
        <label class="form-label fw-semibold">Lỗi mất điểm nhiều nhất</label>
        <textarea name="critical_error" rows="2" class="form-control">{{ old('critical_error', $e?->critical_error) }}</textarea>
    </div>

    <div class="card-soft p-4 mb-4">
        <h2 class="h6 fw-bold mb-3">Speaker Diagnosis</h2>
        <div class="row g-3">
            @foreach (['content' => 'Content', 'strategy' => 'Strategy', 'delivery' => 'Delivery', 'rebuttal' => 'Rebuttal'] as $key => $label)
                <div class="col-6 col-md-3">
                    <label class="form-label small">{{ $label }} (0-5 sao)</label>
                    <input type="number" min="0" max="5" name="diagnosis[{{ $key }}]"
                           value="{{ old("diagnosis.$key", data_get($diagnosis, $key, 0)) }}" class="form-control">
                </div>
            @endforeach
            <div class="col-md-3">
                <label class="form-label small">Level</label>
                <select name="diagnosis[level]" class="form-select">
                    @foreach (['Beginner', 'Developing', 'Strong'] as $level)
                        <option value="{{ $level }}" @selected(old('diagnosis.level', data_get($diagnosis, 'level')) === $level)>{{ $level }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="card-soft p-4 mb-4">
        <h2 class="h6 fw-bold mb-3">Coaching Plan</h2>
        @foreach (['week_1_2' => 'Tuần 1-2 (CREL)', 'week_3' => 'Tuần 3 (Đối chiếu)', 'week_4' => 'Tuần 4 (Thẻ dàn ý)'] as $key => $label)
            <div class="mb-3">
                <label class="form-label small fw-semibold">{{ $label }}</label>
                <textarea name="coaching_plan[{{ $key }}]" rows="2" class="form-control">{{ old("coaching_plan.$key", data_get($coaching, $key)) }}</textarea>
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary-soft px-4">Lưu chấm điểm thủ công</button>
</form>

@if ($submission->feedbacks->isNotEmpty())
    <div class="card-soft p-4 mt-4">
        <h2 class="h6 fw-bold mb-3">Phản hồi từ phụ huynh</h2>
        @foreach ($submission->feedbacks as $feedback)
            <div class="mb-3 pb-3 border-bottom">
                <p class="mb-1">{{ $feedback->message }}</p>
                @if ($feedback->admin_reply)
                    <div class="text-muted small">Đã trả lời: {{ $feedback->admin_reply }}</div>
                @else
                    <a href="{{ route('admin.feedbacks.index') }}" class="small">Trả lời trong mục Phản hồi →</a>
                @endif
            </div>
        @endforeach
    </div>
@endif
@endsection
