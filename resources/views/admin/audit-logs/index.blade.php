@extends('layouts.admin')

@section('title', 'Thao tác người dùng')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 fw-bold mb-1">Thao tác người dùng</h1>
        <p class="text-muted mb-0">Nhật ký thêm, sửa, xóa và xử lý queue trong Admin.</p>
    </div>
    <form method="GET" class="d-flex gap-2">
        <select name="action" class="form-select" onchange="this.form.submit()" aria-label="Lọc thao tác">
            <option value="">Tất cả thao tác</option>
            <option value="created" @selected(request('action') === 'created')>Thêm</option>
            <option value="updated" @selected(request('action') === 'updated')>Sửa</option>
            <option value="deleted" @selected(request('action') === 'deleted')>Xóa</option>
            <option value="retried" @selected(request('action') === 'retried')>Thử lại</option>
        </select>
    </form>
</div>

<div class="card-soft p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="text-muted small text-uppercase"><tr><th class="ps-4">Thời gian</th><th>Người dùng</th><th>Thao tác</th><th>Đối tượng</th><th>Chi tiết</th></tr></thead>
            <tbody>
                @forelse ($auditLogs as $log)
                    <tr>
                        <td class="ps-4 text-nowrap">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $log->user?->name ?? 'Tài khoản đã xóa' }}</td>
                        <td><span class="badge-status badge-{{ $log->action === 'deleted' ? 'failed' : ($log->action === 'created' ? 'graded' : 'processing') }}">{{ ['created' => 'Thêm', 'updated' => 'Sửa', 'deleted' => 'Xóa', 'retried' => 'Thử lại'][$log->action] ?? $log->action }}</span></td>
                        <td>{{ class_basename($log->auditable_type ?? $log->auditable_type) }} #{{ $log->auditable_id }}</td>
                        <td><details><summary class="small text-primary">Xem dữ liệu</summary><pre class="small mt-2 mb-0">{{ json_encode(['trước' => $log->old_values, 'sau' => $log->new_values], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) }}</pre></details></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-5">Chưa có thao tác nào được ghi nhận.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $auditLogs->links() }}</div>
@endsection
