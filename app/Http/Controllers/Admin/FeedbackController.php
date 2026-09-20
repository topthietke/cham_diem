<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function index(Request $request): View
    {
        $feedbacks = Feedback::query()
            ->with(['submission.student', 'parent'])
            ->when($request->boolean('unanswered'), fn ($q) => $q->whereNull('admin_reply'))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    public function reply(Request $request, Feedback $feedback)
    {
        $data = $request->validate([
            'admin_reply' => ['required', 'string', 'max:2000'],
        ]);

        $feedback->update($data);

        return back()->with('status', 'Đã gửi phản hồi cho phụ huynh.');
    }
}
