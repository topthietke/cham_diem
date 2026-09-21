<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Dùng lại phone để xác thực đúng phụ huynh của bài nộp, vì trang này không cần đăng nhập
            'phone' => ['required', 'string', 'max:20'],
            'message' => ['required', 'string', 'max:2000'],
        ];
    }
}
