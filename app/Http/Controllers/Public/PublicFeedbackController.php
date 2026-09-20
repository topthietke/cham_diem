<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedbackRequest;
use App\Models\Feedback;
use App\Models\Submission;
use Illuminate\Http\RedirectResponse;

class PublicFeedbackController extends Controller
{
    public function store(StoreFeedbackRequest $request, Submission $submission): RedirectResponse
    {
        $data = $request->validated();
        $parent = $submission->student->parent;

        // Xác thực đơn giản: SĐT nhập vào phải khớp phụ huynh của bài nộp này,
        // vì trang phụ huynh không yêu cầu đăng nhập.
        if ($parent->phone !== $data['phone']) {
            return back()
                ->withErrors(['phone' => 'Số điện thoại không khớp với bài nộp này.'])
                ->withInput();
        }

        Feedback::create([
            'submission_id' => $submission->id,
            'parent_id' => $parent->id,
            'message' => $data['message'],
        ]);

        return redirect()
            ->route('public.submissions.show', $submission)
            ->with('status', 'Cảm ơn bạn đã gửi phản hồi!');
    }
}
