@extends('layouts.admin')

@section('title', 'Học sinh')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 fw-bold mb-0">Học sinh</h1>
    <form method="GET" class="d-flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Tìm theo tên / SĐT phụ huynh">
        <button class="btn btn-outline-soft btn-sm">Tìm</button>
    </form>
</div>

<div class="card-soft p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="text-muted small text-uppercase">
                <tr><th class="ps-4">Học sinh</th><th>Phụ huynh</th><th>SĐT</th><th>Số bài nộp</th><th class="pe-4"></th></tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td class="ps-4 fw-semibold">{{ $student->name }}</td>
                        <td>{{ $student->parent->name }}</td>
                        <td>{{ $student->parent->phone }}</td>
                        <td>{{ $student->submissions_count }}</td>
                        <td class="pe-4 text-end">
                            <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-outline-soft btn-sm">Sửa</a>
                            <form method="POST" action="{{ route('admin.students.destroy', $student) }}" class="d-inline"
                                  onsubmit="return confirm('Xoá học sinh này sẽ xoá luôn toàn bộ bài nộp liên quan. Tiếp tục?')">
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
<div class="mt-3">{{ $students->links() }}</div>
@endsection
