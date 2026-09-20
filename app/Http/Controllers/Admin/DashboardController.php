<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\ParentModel;
use App\Models\Student;
use App\Models\Submission;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'parents' => ParentModel::count(),
            'students' => Student::count(),
            'submissions' => Submission::count(),
            'pending' => Submission::where('status', Submission::STATUS_PENDING)->count(),
            'processing' => Submission::where('status', Submission::STATUS_PROCESSING)->count(),
            'graded' => Submission::where('status', Submission::STATUS_GRADED)->count(),
            'failed' => Submission::where('status', Submission::STATUS_FAILED)->count(),
            'unanswered_feedbacks' => Feedback::whereNull('admin_reply')->count(),
        ];

        $recentSubmissions = Submission::with(['student.parent', 'evaluation'])
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentSubmissions'));
    }
}
