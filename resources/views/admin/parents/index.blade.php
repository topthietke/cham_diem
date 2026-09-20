@extends('layouts.admin')

@section('title', 'Phụ huynh')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 fw-bold mb-0">Phụ huynh</h1>
    <form method="GET" class="d-flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Tìm theo tên / SĐT">
        <button class="btn btn-outline-soft btn-sm">Tìm</button>
    </form>
</div>

<div class="card-soft p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="text-muted small text-uppercase">
                <tr><th class="ps-4">Tên</th><th>SĐT</th><th>Email</th><th>Số con</th><th class="pe-4"></th></tr>
            </thead>
            <tbody>
                @foreach ($parents as $parent)
                    <tr>
                        <td class="ps-4 fw-semibold">{{ $parent->name }}</td>
                        <td>{{ $parent->phone }}</td>
                        <td>{{ $parent->email ?? '—' }}</td>
                        <td>{{ $parent->students_count }}</td>
                        <td class="pe-4 text-end">
                            <a href="{{ route('admin.parents.edit', $parent) }}" class="btn btn-outline-soft btn-sm">Sửa</a>
                            <form method="POST" action="{{ route('admin.parents.destroy', $parent) }}" class="d-inline"
                                  onsubmit="return confirm('Xoá phụ huynh sẽ xoá luôn học sinh và bài nộp liên quan. Tiếp tục?')">
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
<div class="mt-3">{{ $parents->links() }}</div>
@endsection
