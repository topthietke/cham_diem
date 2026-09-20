@extends('layouts.admin')

@section('title', 'Tài khoản admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 fw-bold mb-0">Tài khoản admin</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary-soft"><i class="bi bi-plus-lg me-1"></i>Thêm tài khoản</a>
</div>

<div class="card-soft p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="text-muted small text-uppercase">
                <tr><th class="ps-4">Tên</th><th>Email</th><th>Vai trò</th><th class="pe-4"></th></tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="ps-4 fw-semibold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role === 'super_admin' ? 'Super Admin' : 'Giám khảo (Evaluator)' }}</td>
                        <td class="pe-4 text-end">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-soft btn-sm">Sửa</a>
                            @if ($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Xoá tài khoản này?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-soft btn-sm text-danger">Xoá</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $users->links() }}</div>
@endsection
