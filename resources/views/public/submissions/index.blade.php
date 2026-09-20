@extends('layouts.public')

@section('title', 'Tra cứu bài nộp')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="mb-4">
            <h1 class="h3 fw-bold mb-1">Tra cứu bài nộp</h1>
            <p class="text-muted-soft mb-0">Nhập số điện thoại, tên học sinh hoặc tiêu đề bài thi để xem kết quả chấm điểm.</p>
        </div>

        <form method="GET" action="{{ route('public.submissions.index') }}" class="card-soft p-4 mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" value="{{ request('phone') }}" class="form-control" placeholder="09xxxxxxxx">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tên học sinh</label>
                    <input type="text" name="student_name" value="{{ request('student_name') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tiêu đề bài thi</label>
                    <input type="text" name="title" value="{{ request('title') }}" class="form-control">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary-soft">
                        <i class="bi bi-search me-1"></i>Tìm kiếm
                    </button>
                </div>
            </div>
        </form>

        @if ($hasFilter)
            @if ($results->isEmpty())
                <div class="card-soft p-5 text-center text-muted-soft">
                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                    Không tìm thấy bài nộp nào khớp với thông tin đã nhập.
                </div>
            @else
                <div class="card-soft p-0 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr class="text-muted-soft small text-uppercase">
                                    <th class="ps-4">Học sinh</th>
                                    <th>Tiêu đề bài thi</th>
                                    <th>Trạng thái</th>
                                    <th>Điểm</th>
                                    <th class="pe-4"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $submission)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-semibold">{{ $submission->student->name }}</div>
                                            <div class="text-muted-soft small">{{ $submission->student->parent->phone }}</div>
                                        </td>
                                        <td>{{ $submission->title }}</td>
                                        <td>
                                            @php
                                                $badgeMap = [
                                                    'pending' => ['badge-pending', 'Chờ chấm'],
                                                    'processing' => ['badge-processing', 'Đang chấm'],
                                                    'graded' => ['badge-graded', 'Đã chấm'],
                                                    'failed' => ['badge-failed', 'Lỗi chấm'],
                                                ];
                                                [$badgeClass, $badgeLabel] = $badgeMap[$submission->status];
                                            @endphp
                                            <span class="badge-status {{ $badgeClass }}">{{ $badgeLabel }}</span>
                                        </td>
                                        <td>
                                            {{ $submission->evaluation?->total_score !== null ? $submission->evaluation->total_score.'/100' : '—' }}
                                        </td>
                                        <td class="pe-4 text-end">
                                            <a href="{{ route('public.submissions.show', $submission) }}" class="btn btn-outline-soft btn-sm">
                                                Xem chi tiết <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-3">{{ $results->links() }}</div>
            @endif
        @endif
    </div>
</div>
@endsection
