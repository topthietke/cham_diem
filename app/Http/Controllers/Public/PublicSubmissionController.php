<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubmissionRequest;
use App\Jobs\EvaluateSubmissionJob;
use App\Models\ParentModel;
use App\Models\Student;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicSubmissionController extends Controller
{
    public function create(): View
    {
        return view('public.submissions.create');
    }

    public function store(StoreSubmissionRequest $request)
    {
        $data = $request->validated();

        // Tra theo SĐT: nếu phụ huynh đã tồn tại -> link, chưa có -> tạo mới
        $parent = ParentModel::firstOrCreate(
            ['phone' => $data['phone']],
            [
                'name' => $data['parent_name'],
                'email' => $data['email'] ?? null,
                'address' => $data['address'] ?? null,
            ]
        );

        // Nếu phụ huynh đã tồn tại từ trước, cập nhật nhẹ các trường mới được điền thêm
        if (! $parent->wasRecentlyCreated) {
            $parent->fill(array_filter([
                'email' => $data['email'] ?? null,
                'address' => $data['address'] ?? null,
            ]))->save();
        }

        // Tạo học sinh nếu chưa có (cùng phụ huynh + cùng tên)
        $student = Student::firstOrCreate([
            'parent_id' => $parent->id,
            'name' => $data['student_name'],
        ]);

        $submission = Submission::create([
            'student_id' => $student->id,
            'title' => $data['title'],
            'youtube_url' => $data['youtube_url'],
            'status' => Submission::STATUS_PENDING,
        ]);

        EvaluateSubmissionJob::dispatch($submission);

        return redirect()
            ->route('public.submissions.show', $submission)
            ->with('status', 'Bài nộp đã được ghi nhận! Hệ thống đang chấm điểm tự động, vui lòng quay lại trang này sau ít phút.');
    }

    public function index(Request $request): View
    {
        $hasFilter = $request->filled('phone') || $request->filled('student_name') || $request->filled('title');

        $results = $hasFilter
            ? Submission::query()
                ->when($request->filled('title'), fn ($q) => $q->where('title', 'like', '%'.$request->string('title').'%'))
                ->whereHas('student', function ($q) use ($request) {
                    $q->when(
                        $request->filled('student_name'),
                        fn ($qq) => $qq->where('name', 'like', '%'.$request->string('student_name').'%')
                    );
                    $q->when($request->filled('phone'), function ($qq) use ($request) {
                        $qq->whereHas('parent', fn ($qp) => $qp->where('phone', $request->string('phone')));
                    });
                })
                ->with(['student.parent', 'evaluation'])
                ->latest()
                ->paginate(10)
                ->withQueryString()
            : null;

        return view('public.submissions.index', compact('results', 'hasFilter'));
    }

    public function show(Submission $submission): View
    {
        $submission->load(['student.parent', 'evaluation', 'feedbacks' => fn ($q) => $q->latest()]);

        return view('public.submissions.show', compact('submission'));
    }
}
