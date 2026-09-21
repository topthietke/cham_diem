<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Quản trị') · DeBeat Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --bg: #F6F6FC; --surface: #fff; --primary: #6C63FF; --primary-dark: #564FD1;
            --primary-soft: #EDEBFF; --mint: #3FD6BF; --mint-soft: #E1FBF6;
            --peach: #FF9E80; --peach-soft: #FFEDE5; --text: #23222E; --text-muted: #6E6C82;
            --border: #E7E5F5; --radius-lg: 18px;
        }
        body { font-family: 'Inter', system-ui, sans-serif; background: var(--bg); color: var(--text); }
        .admin-sidebar {
            width: 240px; background: var(--surface); border-right: 1px solid var(--border);
            min-height: 100vh; position: fixed; top: 0; left: 0; padding: 1.5rem 1rem;
        }
        .admin-content { margin-left: 240px; padding: 2rem; }
        .admin-sidebar .brand { font-weight: 700; font-size: 1.05rem; margin-bottom: 2rem; display: block; }
        .admin-nav-link {
            display: flex; align-items: center; gap: 0.6rem; padding: 0.6rem 0.9rem; border-radius: 10px;
            color: var(--text-muted); font-weight: 600; font-size: 0.92rem; text-decoration: none; margin-bottom: 0.2rem;
        }
        .admin-nav-link:hover { background: var(--primary-soft); color: var(--primary-dark); }
        .admin-nav-link.active { background: var(--primary); color: #fff; }
        .card-soft { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-lg); box-shadow: 0 6px 20px rgba(108,99,255,.06); }
        .btn-primary-soft { background: var(--primary); border-color: var(--primary); color: #fff; font-weight: 600; border-radius: 10px; }
        .btn-primary-soft:hover { background: var(--primary-dark); border-color: var(--primary-dark); color: #fff; }
        .btn-outline-soft { border-radius: 10px; border: 1.5px solid var(--border); color: var(--text); font-weight: 600; }
        .btn-outline-soft:hover { border-color: var(--primary); color: var(--primary); background: var(--primary-soft); }
        .form-control, .form-select { border-radius: 10px; border: 1.5px solid var(--border); }
        .badge-status { border-radius: 999px; padding: 0.35rem 0.75rem; font-weight: 600; font-size: 0.78rem; }
        .badge-pending { background: var(--peach-soft); color: #B5522B; }
        .badge-processing { background: var(--primary-soft); color: var(--primary-dark); }
        .badge-graded { background: var(--mint-soft); color: #1B8C7A; }
        .badge-failed { background: #FDE7E7; color: #C23B3B; }
        .stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 1.25rem; }
        @media (max-width: 900px) {
            .admin-sidebar { position: static; width: 100%; min-height: auto; }
            .admin-content { margin-left: 0; padding: 1.25rem; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <aside class="admin-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand text-dark text-decoration-none">
            <i class="bi bi-mic-fill me-1"></i>DeBeat Admin
        </a>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>Tổng quan
            </a>
            <a href="{{ route('admin.submissions.index') }}" class="admin-nav-link {{ request()->routeIs('admin.submissions.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i>Bài nộp
            </a>
            <a href="{{ route('admin.students.index') }}" class="admin-nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <i class="bi bi-mortarboard"></i>Học sinh
            </a>
            <a href="{{ route('admin.parents.index') }}" class="admin-nav-link {{ request()->routeIs('admin.parents.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>Phụ huynh
            </a>
            <a href="{{ route('admin.feedbacks.index') }}" class="admin-nav-link {{ request()->routeIs('admin.feedbacks.*') ? 'active' : '' }}">
                <i class="bi bi-chat-dots"></i>Phản hồi
            </a>
            @if (auth()->user()?->isSuperAdmin())
                <a href="{{ route('admin.ai-providers.index') }}" class="admin-nav-link {{ request()->routeIs('admin.ai-providers.*') ? 'active' : '' }}">
                    <i class="bi bi-cpu"></i>Quản lý AI
                </a>
                <a href="{{ route('admin.users.index') }}" class="admin-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i>Tài khoản admin
                </a>
                <a href="{{ route('admin.jobs.index') }}" class="admin-nav-link {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
                    <i class="bi bi-hourglass-split"></i>Jobs đang chờ
                </a>
                <a href="{{ route('admin.failed-jobs.index') }}" class="admin-nav-link {{ request()->routeIs('admin.failed-jobs.*') ? 'active' : '' }}">
                    <i class="bi bi-exclamation-triangle"></i>Danh sách lỗi
                </a>
                <a href="{{ route('admin.audit-logs.index') }}" class="admin-nav-link {{ request()->routeIs('admin.audit-logs.*') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i>Thao tác người dùng
                </a>
            @endif
            <form method="POST" action="{{ route('admin.logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="admin-nav-link border-0 bg-transparent w-100 text-start">
                    <i class="bi bi-box-arrow-right"></i>Đăng xuất
                </button>
            </form>
        </nav>
    </aside>

    <div class="admin-content">
        @if (session('status'))
            <div class="alert alert-success card-soft border-0 mb-4"><i class="bi bi-check-circle-fill me-2"></i>{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger card-soft border-0 mb-4"><i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
