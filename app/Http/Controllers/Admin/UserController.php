<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_EVALUATOR])],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        $this->recordAudit('created', $user, null, $user->only(['name', 'email', 'role']));

        return redirect()->route('admin.users.index')->with('status', 'Đã tạo tài khoản admin mới.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $oldValues = $user->only(['name', 'email', 'role']);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_EVALUATOR])],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
        ]);

        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();
        $this->recordAudit('updated', $user, $oldValues, $user->only(['name', 'email', 'role']));

        return redirect()->route('admin.users.index')->with('status', 'Đã cập nhật tài khoản.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Không thể tự xoá tài khoản đang đăng nhập.');
        }

        $oldValues = $user->only(['name', 'email', 'role']);
        $user->delete();
        $this->recordAudit('deleted', $user, $oldValues, null);

        return redirect()->route('admin.users.index')->with('status', 'Đã xoá tài khoản.');
    }

    private function recordAudit(string $action, Model $model, ?array $oldValues, ?array $newValues): void
    {
        AuditLog::create([
            'user_id' => request()->user()->id,
            'action' => $action,
            'auditable_type' => $model::class,
            'auditable_id' => $model->getKey(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
