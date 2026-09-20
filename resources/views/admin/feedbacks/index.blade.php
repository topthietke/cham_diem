@extends('layouts.admin')

@section('title', 'Phản hồi')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <h1 class="h4 fw-bold mb-0">Phản hồi từ phụ huynh</h1>
    <form method="GET" class="d-flex align-items-center gap-2">
        <div class="form-check">
            <input type="checkbox" name="unanswered" value="1" class="form-check-input" id="unanswered"
                   onchange="this.form.submit()" @checked(request('unanswered'))>
            <label class="form-check-label small" for="unanswered">Chỉ chưa trả lời</label>
        </div>
    </form>
</div>

@forelse ($feedbacks as $feedback)
    <div class="card-soft p-4 mb-3">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <div class="fw-semibold">{{ $feedback->parent->name }} ({{ $feedback->parent->phone }})</div>
                <div class="text-muted small">
                    Bài: <a href="{{ route('admin.submissions.show', $feedback->submission) }}">{{ $feedback->submission->title }}</a>
                    · {{ $feedback->created_at->format('d/m/Y H:i') }}
                </div>
            </div>
            @if (! $feedback->admin_reply)
                <span class="badge-status badge-pending">Chưa trả lời</span>
            @else
                <span class="badge-status badge-graded">Đã trả lời</span>
            @endif
        </div>
        <p class="mb-3">{{ $feedback->message }}</p>

        <form method="POST" action="{{ route('admin.feedbacks.reply', $feedback) }}" class="d-flex gap-2">
            @csrf
            <input type="text" name="admin_reply" value="{{ $feedback->admin_reply }}" class="form-control form-control-sm" placeholder="Nhập phản hồi..." required>
            <button class="btn btn-primary-soft btn-sm">Gửi</button>
        </form>
    </div>
@empty
    <div class="card-soft p-5 text-center text-muted">Chưa có phản hồi nào.</div>
@endforelse

<div class="mt-3">{{ $feedbacks->links() }}</div>
@endsection
