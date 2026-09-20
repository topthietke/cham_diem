<?php

use App\Http\Controllers\Public\PublicFeedbackController;
use App\Http\Controllers\Public\PublicSubmissionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public routes (Phụ huynh) — không yêu cầu đăng nhập
|--------------------------------------------------------------------------
| Ghép nhóm này vào routes/web.php hiện có của dự án.
*/
Route::prefix('nop-bai')->name('public.')->group(function () {
    Route::get('/', [PublicSubmissionController::class, 'create'])->name('submissions.create');
    Route::post('/', [PublicSubmissionController::class, 'store'])->name('submissions.store');
    Route::get('/tra-cuu', [PublicSubmissionController::class, 'index'])->name('submissions.index');
    Route::get('/bai-nop/{submission}', [PublicSubmissionController::class, 'show'])->name('submissions.show');
    Route::post('/bai-nop/{submission}/feedback', [PublicFeedbackController::class, 'store'])->name('feedback.store');
});

// Trang chủ tạm thời trỏ về form nộp bài
Route::redirect('/', '/nop-bai');
