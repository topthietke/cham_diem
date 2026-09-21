@extends('layouts.admin')

@section('title', 'Danh sách lỗi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 fw-bold mb-1">Danh sách lỗi</h1>
        <p class="text-muted mb-0">Các job đã thất bại sau khi hết số lần thử.</p>
    </div>
    <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-soft"><i class="bi bi-hourglass-split me-1"></i>Jobs đang chờ</a>
</div>

<div class="card-soft p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="text-muted small text-uppercase"><tr><th class="ps-4">Job</th><th>Queue</th><th>Lỗi lúc</th><th class="pe-4"></th></tr></thead>
            <tbody>
                @forelse ($failedJobs as $job)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-semibold">{{ class_basename($job->display_name) }}</div>
                            <details class="small text-muted mt-1"><summary>Xem chi tiết lỗi</summary><pre class="mt-2 mb-0" style="max-width: 680px; white-space: pre-wrap">{{ $job->exception }}</pre></details>
                        </td>
                        <td><span class="badge-status badge-failed">{{ $job->queue }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($job->failed_at)->format('d/m/Y H:i') }}</td>
                        <td class="pe-4 text-end text-nowrap">
                            <form method="POST" action="{{ route('admin.failed-jobs.retry', $job->uuid) }}" class="d-inline">
                                @csrf
                                <button class="btn btn-outline-soft btn-sm"><i class="bi bi-arrow-clockwise me-1"></i>Thử lại</button>
                            </form>
                            <form method="POST" action="{{ route('admin.failed-jobs.destroy', $job->uuid) }}" class="d-inline" onsubmit="return confirm('Xoá bản ghi lỗi này?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-soft btn-sm text-danger"><i class="bi bi-trash me-1"></i>Xoá</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted py-5">Không có job lỗi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $failedJobs->links() }}</div>
@endsection
