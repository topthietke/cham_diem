@extends('layouts.admin')

@section('title', 'Tổng quan')

@section('content')
<h1 class="h4 fw-bold mb-4">Tổng quan hệ thống</h1>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="text-muted small fw-semibold mb-1">Phụ huynh</div>
            <div class="fs-3 fw-bold">{{ $stats['parents'] }}</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="text-muted small fw-semibold mb-1">Học sinh</div>
            <div class="fs-3 fw-bold">{{ $stats['students'] }}</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="text-muted small fw-semibold mb-1">Tổng bài nộp</div>
            <div class="fs-3 fw-bold">{{ $stats['submissions'] }}</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="text-muted small fw-semibold mb-1">Phản hồi chưa trả lời</div>
            <div class="fs-3 fw-bold" style="color: var(--peach)">{{ $stats['unanswered_feedbacks'] }}</div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <span class="badge-status badge-pending">Chờ chấm: {{ $stats['pending'] }}</span>
    </div>
    <div class="col-6 col-md-3">
        <span class="badge-status badge-processing">Đang chấm: {{ $stats['processing'] }}</span>
    </div>
    <div class="col-6 col-md-3">
        <span class="badge-status badge-graded">Đã chấm: {{ $stats['graded'] }}</span>
    </div>
    <div class="col-6 col-md-3">
        <span class="badge-status badge-failed">Thất bại: {{ $stats['failed'] }}</span>
    </div>
</div>

<div class="card-soft p-4">
    <h2 class="h6 fw-bold mb-3">Bài nộp gần đây</h2>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="text-muted small text-uppercase">
                <tr><th>Học sinh</th><th>Tiêu đề</th><th>Trạng thái</th><th>Điểm</th><th></th></tr>
            </thead>
            <tbody>
                @foreach ($recentSubmissions as $submission)
                    <tr>
                        <td>{{ $submission->student->name }}</td>
                        <td>{{ $submission->title }}</td>
                        <td><span class="badge-status badge-{{ $submission->status }}">{{ $submission->status }}</span></td>
                        <td>{{ $submission->evaluation?->total_score ?? '—' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.submissions.show', $submission) }}" class="btn btn-outline-soft btn-sm">Xem</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
