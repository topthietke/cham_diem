<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Form public, không cần đăng nhập
    }

    public function rules(): array
    {
        return [
            'parent_info' => ['sometimes', 'boolean'],
            'parent_name' => ['required_if:parent_info,1', 'nullable', 'string', 'max:255'],
            'phone' => ['required_if:parent_info,1', 'nullable', 'string', 'max:20', 'regex:/^[0-9+\s-]{8,20}$/'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'student_name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'youtube_url' => [
                'required', 'url', 'max:255',
                'regex:/^https?:\/\/(?:www\.)?(?:youtube\.com\/(?:watch\?v=|shorts\/)|youtu\.be\/)[\w-]+(?:[?&][^\s]*)?$/i',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'youtube_url.regex' => 'Vui lòng nhập đúng đường dẫn video YouTube.',
        ];
    }
}
