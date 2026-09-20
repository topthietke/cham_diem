<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ParentController extends Controller
{
    public function index(Request $request): View
    {
        $parents = ParentModel::query()
            ->withCount('students')
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = '%'.$request->string('q').'%';
                $q->where('name', 'like', $term)->orWhere('phone', 'like', $term);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.parents.index', compact('parents'));
    }

    public function edit(ParentModel $parent): View
    {
        $parent->load('students');

        return view('admin.parents.edit', compact('parent'));
    }

    public function update(Request $request, ParentModel $parent)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20', Rule::unique('parents', 'phone')->ignore($parent->id)],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $parent->update($data);

        return redirect()->route('admin.parents.index')->with('status', 'Đã cập nhật thông tin phụ huynh.');
    }

    public function destroy(ParentModel $parent)
    {
        $parent->delete();

        return redirect()->route('admin.parents.index')->with('status', 'Đã xoá phụ huynh.');
    }
}
