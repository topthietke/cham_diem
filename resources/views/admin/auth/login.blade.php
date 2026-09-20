<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập Admin · DeBeat</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; background: #F6F6FC; min-height: 100vh; display: flex; align-items: center; }
        .login-card { max-width: 420px; margin: auto; background: #fff; border: 1px solid #E7E5F5; border-radius: 20px; box-shadow: 0 10px 30px rgba(108,99,255,.08); }
        .form-control { border-radius: 10px; border: 1.5px solid #E7E5F5; padding: .6rem .9rem; }
        .btn-primary-soft { background: #6C63FF; border-color: #6C63FF; border-radius: 10px; font-weight: 600; }
        .btn-primary-soft:hover { background: #564FD1; border-color: #564FD1; }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card p-4 p-md-5">
            <h1 class="h4 fw-bold text-center mb-1">DeBeat Admin</h1>
            <p class="text-center text-muted mb-4">Đăng nhập để quản lý hệ thống chấm bài</p>

            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.attempt') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                </div>
                <button type="submit" class="btn btn-primary-soft w-100 py-2 text-white">Đăng nhập</button>
            </form>
        </div>
    </div>
</body>
</html>
