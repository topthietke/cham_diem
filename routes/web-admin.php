<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubmissionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin routes — ghép nhóm này vào routes/web.php hiện có.
| Nhớ đăng ký middleware alias 'super_admin' theo bootstrap-app-middleware-snippet.php
|--------------------------------------------------------------------------
*/
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
            Route::resource('users', UserController::class)->except(['show']);
        });
    });
});
