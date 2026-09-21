<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class JobController extends Controller
{
    public function index(): View
    {
        $jobs = DB::table('jobs')->latest('id')->paginate(20, ['*'], 'jobs_page');

        $jobs->getCollection()->transform(function (object $job): object {
            $payload = json_decode($job->payload, true);
            $job->display_name = data_get($payload, 'displayName', 'Không xác định');

            return $job;
        });

        return view('admin.jobs.index', compact('jobs'));
    }

    public function destroy(Request $request, int $job): RedirectResponse
    {
        $queuedJob = DB::table('jobs')->where('id', $job)->first();

        abort_unless($queuedJob !== null, 404);
        DB::table('jobs')->where('id', $job)->delete();
        $this->recordAudit('deleted', 'jobs', $job, ['queue' => $queuedJob->queue]);

        return back()->with('status', 'Đã xoá job khỏi hàng đợi.');
    }

    public function failed(): View
    {
        $failedJobs = DB::table('failed_jobs')->latest('failed_at')->paginate(20, ['*'], 'failed_page');

        $failedJobs->getCollection()->transform(function (object $job): object {
            $payload = json_decode($job->payload, true);
            $job->display_name = data_get($payload, 'displayName', 'Không xác định');

            return $job;
        });

        return view('admin.failed-jobs.index', compact('failedJobs'));
    }

    public function retry(string $failedJob): RedirectResponse
    {
        $job = DB::table('failed_jobs')->where('uuid', $failedJob)->first();

        abort_unless($job !== null, 404);
        Artisan::call('queue:retry', ['id' => [$failedJob]]);
        $this->recordAudit('retried', 'failed_jobs', $job->id, ['uuid' => $failedJob]);

        return back()->with('status', 'Đã đưa lỗi trở lại hàng đợi.');
    }

    public function forget(string $failedJob): RedirectResponse
    {
        $job = DB::table('failed_jobs')->where('uuid', $failedJob)->first();

        abort_unless($job !== null, 404);
        Artisan::call('queue:forget', ['id' => $failedJob]);
        $this->recordAudit('deleted', 'failed_jobs', $job->id, ['uuid' => $failedJob]);

        return back()->with('status', 'Đã xoá bản ghi lỗi.');
    }

    private function recordAudit(string $action, string $type, int $id, array $newValues): void
    {
        AuditLog::create([
            'user_id' => request()->user()->id,
            'action' => $action,
            'auditable_type' => $type,
            'auditable_id' => $id,
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
