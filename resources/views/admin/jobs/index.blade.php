@extends('layouts.admin')

@section('title', 'Jobs đang chờ')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 fw-bold mb-1">Jobs đang chờ</h1>
        <p class="text-muted mb-0">Các tác vụ đang nằm trong hàng đợi xử lý.</p>
    </div>
    <a href="{{ route('admin.failed-jobs.index') }}" class="btn btn-outline-soft"><i class="bi bi-exclamation-triangle me-1"></i>Xem lỗi</a>
</div>

<div class="card-soft p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="text-muted small text-uppercase"><tr><th class="ps-4">Job</th><th>Queue</th><th>Lần thử</th><th>Sẵn sàng lúc</th><th class="pe-4"></th></tr></thead>
            <tbody>
                @forelse ($jobs as $job)
                    <tr>
                        <td class="ps-4 fw-semibold">{{ class_basename($job->display_name) }}</td>
                        <td><span class="badge-status badge-processing">{{ $job->queue }}</span></td>
                        <td>{{ $job->attempts }}</td>
                            <td>{{ \Carbon\Carbon::createFromTimestamp($job->available_at)->format('d/m/Y H:i') }}</td>
                        <td class="pe-4 text-end">
                            <form method="POST" action="{{ route('admin.jobs.destroy', $job->id) }}" class="d-inline" onsubmit="return confirm('Xoá job này khỏi hàng đợi?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-soft btn-sm text-danger"><i class="bi bi-trash me-1"></i>Xoá</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-5">Không có job đang chờ.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $jobs->links() }}</div>
@endsection
