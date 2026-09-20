<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParentModel;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $students = Student::query()
            ->with('parent')
            ->withCount('submissions')
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = '%'.$request->string('q').'%';
                $q->where('name', 'like', $term)
                    ->orWhereHas('parent', fn ($qp) => $qp->where('phone', 'like', $term));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.students.index', compact('students'));
    }

    public function edit(Student $student): View
    {
        $student->load('parent');
        $parents = ParentModel::orderBy('name')->get();

        return view('admin.students.edit', compact('student', 'parents'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => ['required', 'exists:parents,id'],
        ]);

        $student->update($data);

        return redirect()->route('admin.students.index')->with('status', 'Đã cập nhật thông tin học sinh.');
    }

    public function destroy(Student $student)
    {
        // Cascade xoá luôn các submissions/evaluations liên quan (đã khai báo cascadeOnDelete ở migration)
        $student->delete();

        return redirect()->route('admin.students.index')->with('status', 'Đã xoá học sinh.');
    }
}
