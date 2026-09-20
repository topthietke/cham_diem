@extends('layouts.admin')

@section('title', 'Bài nộp')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <h1 class="h4 fw-bold mb-0">Bài nộp</h1>
    <form method="GET" class="d-flex gap-2">
        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="">Tất cả trạng thái</option>
            @foreach (['pending' => 'Chờ chấm', 'processing' => 'Đang chấm', 'graded' => 'Đã chấm', 'failed' => 'Thất bại'] as $value => $label)
                <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Tìm theo tên / tiêu đề">
        <button class="btn btn-outline-soft btn-sm">Tìm</button>
    </form>
</div>

<div class="card-soft p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="text-muted small text-uppercase">
                <tr><th class="ps-4">Học sinh</th><th>Tiêu đề</th><th>Trạng thái</th><th>Điểm</th><th class="pe-4"></th></tr>
            </thead>
            <tbody>
                @forelse ($submissions as $submission)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-semibold">{{ $submission->student->name }}</div>
                            <div class="text-muted small">{{ $submission->student->parent->phone }}</div>
                        </td>
                        <td>{{ $submission->title }}</td>
                        <td><span class="badge-status badge-{{ $submission->status }}">{{ $submission->status }}</span></td>
                        <td>{{ $submission->evaluation?->total_score ?? '—' }}</td>
                        <td class="pe-4 text-end">
                            <a href="{{ route('admin.submissions.show', $submission) }}" class="btn btn-outline-soft btn-sm">Xem / Chấm lại</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Không có bài nộp nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $submissions->links() }}</div>
@endsection
