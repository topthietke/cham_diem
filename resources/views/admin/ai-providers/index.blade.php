@extends('layouts.admin')

@section('title', 'Quản lý AI')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 fw-bold mb-1">Quản lý AI</h1>
        <p class="text-muted mb-0">Quản lý các nhà cung cấp và trạng thái kết nối.</p>
    </div>
    <a href="{{ route('admin.ai-providers.create') }}" class="btn btn-primary-soft"><i class="bi bi-plus-lg me-1"></i>Thêm AI</a>
</div>

<div class="card-soft p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="text-muted small text-uppercase">
                <tr><th class="ps-4">AI</th><th>Model</th><th>Trạng thái</th><th>Lần kiểm tra</th><th class="pe-4"></th></tr>
            </thead>
            <tbody>
                @foreach ($aiProviders as $ai)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-semibold">{{ $ai->name }}</div>
                            <div class="text-muted small">{{ $ai->provider }} · {{ $ai->is_enabled ? 'Đang bật' : 'Đang tắt' }}</div>
                        </td>
                        <td>{{ $ai->model ?: '—' }}</td>
                        <td>
                            @if ($ai->connection_status === 'connected')
                                <span class="badge-status badge-graded"><i class="bi bi-check-circle me-1"></i>Đã kết nối</span>
                            @elseif ($ai->connection_status === 'failed')
                                <span class="badge-status badge-failed"><i class="bi bi-x-circle me-1"></i>Thất bại</span>
                            @else
                                <span class="badge-status badge-processing">Chưa kiểm tra</span>
                            @endif
                            @if ($ai->connection_message)
                                <div class="text-muted small mt-1">{{ $ai->connection_message }}</div>
                            @endif
                        </td>
                        <td>{{ $ai->last_checked_at?->format('d/m/Y H:i') ?? '—' }}</td>
                        <td class="pe-4 text-end text-nowrap">
                            <form method="POST" action="{{ route('admin.ai-providers.check', $ai) }}" class="d-inline">
                                @csrf
                                <button class="btn btn-outline-soft btn-sm"><i class="bi bi-plug me-1"></i>Kiểm tra</button>
                            </form>
                            <a href="{{ route('admin.ai-providers.edit', $ai) }}" class="btn btn-outline-soft btn-sm">Sửa</a>
                            <form method="POST" action="{{ route('admin.ai-providers.destroy', $ai) }}" class="d-inline" onsubmit="return confirm('Xoá AI này?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-soft btn-sm text-danger">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
