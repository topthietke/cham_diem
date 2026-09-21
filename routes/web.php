<?php

use App\Http\Controllers\Admin\AiProviderController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubmissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Public\PublicFeedbackController;
use App\Http\Controllers\Public\PublicSubmissionController;
use Illuminate\Support\Facades\Route;

Route::prefix('nop-bai')->name('public.')->group(function () {
    Route::get('/', [PublicSubmissionController::class, 'create'])->name('submissions.create');
    Route::post('/', [PublicSubmissionController::class, 'store'])->name('submissions.store');
    Route::get('/tra-cuu', [PublicSubmissionController::class, 'index'])->name('submissions.index');
    Route::get('/bai-nop/{submission}', [PublicSubmissionController::class, 'show'])->name('submissions.show');
    Route::post('/bai-nop/{submission}/feedback', [PublicFeedbackController::class, 'store'])->name('feedback.store');
});

// Trang chủ tạm thời trỏ về form nộp bài
Route::redirect('/', '/nop-bai');

// ========================================== Admin routes (routes/web-admin.php) ==========================================

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'create'])->name('login');
        Route::post('login', [AuthController::class, 'store'])->name('login.attempt');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('students', StudentController::class)->except(['create', 'store', 'show']);
        Route::resource('parents', ParentController::class)->except(['create', 'store', 'show']);

        Route::get('submissions', [SubmissionController::class, 'index'])->name('submissions.index');
        Route::get('submissions/{submission}', [SubmissionController::class, 'show'])->name('submissions.show');
        Route::put('submissions/{submission}', [SubmissionController::class, 'update'])->name('submissions.update');
        Route::post('submissions/{submission}/regrade', [SubmissionController::class, 'regrade'])->name('submissions.regrade');

        Route::get('feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
        Route::post('feedbacks/{feedback}/reply', [FeedbackController::class, 'reply'])->name('feedbacks.reply');

        // Chỉ Super Admin được quản lý tài khoản admin khác
        Route::middleware('super_admin')->group(function () {
            Route::resource('ai-providers', AiProviderController::class)
                ->except(['show'])
                ->parameters(['ai-providers' => 'aiProvider']);
            Route::post('ai-providers/{aiProvider}/check', [AiProviderController::class, 'check'])->name('ai-providers.check');
            Route::resource('users', UserController::class)->except(['show']);
            Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');
            Route::delete('jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
            Route::get('failed-jobs', [JobController::class, 'failed'])->name('failed-jobs.index');
            Route::post('failed-jobs/{failedJob}/retry', [JobController::class, 'retry'])->name('failed-jobs.retry');
            Route::delete('failed-jobs/{failedJob}', [JobController::class, 'forget'])->name('failed-jobs.destroy');
            Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
        });
    });
});
