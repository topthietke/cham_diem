<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Hệ thống chấm bài thuyết trình / tranh biện')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --bg: #F6F6FC;
            --surface: #FFFFFF;
            --primary: #6C63FF;
            --primary-dark: #564FD1;
            --primary-soft: #EDEBFF;
            --mint: #3FD6BF;
            --mint-soft: #E1FBF6;
            --peach: #FF9E80;
            --peach-soft: #FFEDE5;
            --text: #23222E;
            --text-muted: #6E6C82;
            --border: #E7E5F5;
            --radius-lg: 20px;
            --radius-md: 14px;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .navbar-debeat {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
        }

        .navbar-debeat .brand-mark {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--mint));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
        }

        .navbar-debeat .brand-name {
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        .card-soft {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: 0 6px 20px rgba(108, 99, 255, 0.06);
        }

        .btn-primary-soft {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
            font-weight: 600;
            border-radius: 12px;
            padding: 0.65rem 1.4rem;
        }

        .btn-primary-soft:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #fff;
        }

        .btn-outline-soft {
            border-radius: 12px;
            border: 1.5px solid var(--border);
            color: var(--text);
            font-weight: 600;
        }

        .btn-outline-soft:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-soft);
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid var(--border);
            padding: 0.6rem 0.9rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(108, 99, 255, 0.12);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.92rem;
        }

        .badge-status {
            border-radius: 999px;
            padding: 0.4rem 0.85rem;
            font-weight: 600;
            font-size: 0.82rem;
        }

        .badge-pending { background: var(--peach-soft); color: #B5522B; }
        .badge-processing { background: var(--primary-soft); color: var(--primary-dark); }
        .badge-graded { background: var(--mint-soft); color: #1B8C7A; }
        .badge-failed { background: #FDE7E7; color: #C23B3B; }

        .text-muted-soft { color: var(--text-muted); }

        .nav-pills-soft .nav-link {
            border-radius: 999px;
            font-weight: 600;
            color: var(--text-muted);
            padding: 0.5rem 1.1rem;
        }

        .nav-pills-soft .nav-link.active {
            background: var(--primary);
            color: #fff;
        }

        .star-filled { color: #FFB020; }
        .star-empty { color: #E4E2F1; }
    </style>

    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-debeat py-3 mb-4">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="{{ route('public.submissions.create') }}" class="d-flex align-items-center text-decoration-none gap-2">
                <span class="brand-mark"><i class="bi bi-mic-fill"></i></span>
                <span class="brand-name text-dark">DeBeat</span>
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('public.submissions.create') }}" class="btn btn-outline-soft btn-sm">
                    <i class="bi bi-plus-lg me-1"></i>Nộp bài mới
                </a>
                <a href="{{ route('public.submissions.index') }}" class="btn btn-outline-soft btn-sm">
                    <i class="bi bi-search me-1"></i>Tra cứu bài nộp
                </a>
            </div>
        </div>
    </nav>

    <main class="container pb-5">
        @yield('content')
    </main>

    @if (session('status'))
        <div class="modal fade" id="submissionSuccessModal" tabindex="-1" aria-labelledby="submissionSuccessModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0" style="border-radius: var(--radius-lg)">
                    <div class="modal-body p-4 p-md-5 text-center">
                        <i class="bi bi-check-circle-fill fs-1 mb-3" style="color: var(--mint)"></i>
                        <h2 class="h5 fw-bold mb-2" id="submissionSuccessModalLabel">Nộp bài thành công</h2>
                        <p class="text-muted-soft mb-4">{{ session('status') }}</p>
                        <button type="button" class="btn btn-primary-soft" data-bs-dismiss="modal">Đã hiểu</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @if (session('status'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const successModal = document.getElementById('submissionSuccessModal');

                successModal.addEventListener('hidden.bs.modal', () => {
                    window.location.href = @json(route('public.submissions.create'));
                });

                bootstrap.Modal.getOrCreateInstance(successModal).show();
            });
        </script>
    @endif
    @stack('scripts')
</body>
</html>
