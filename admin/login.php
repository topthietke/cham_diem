<?php
require_once __DIR__ . '/includes/auth.php';

if (admin_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id']   = $admin['id'];
        $_SESSION['admin_name'] = $admin['full_name'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Tên đăng nhập hoặc mật khẩu không đúng.';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đăng nhập quản trị - Mầm Non Ánh Dương</title>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700&family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<style>
  body{
    font-family:'Quicksand',sans-serif;
    min-height:100vh;
    display:flex; align-items:center; justify-content:center;
    background: linear-gradient(120deg, #FFE3D0 0%, #FFD6E4 45%, #E6E1FF 100%);
  }
  .login-card{
    background:#fff; border-radius:24px; padding:44px;
    box-shadow:0 20px 50px rgba(255,138,91,0.2);
    width:100%; max-width:400px;
  }
  .login-card h1{ font-family:'Baloo 2',cursive; font-size:1.5rem; color:#F4623A; text-align:center; margin-bottom:6px;}
  .login-card p.sub{ text-align:center; color:#8a6a5c; margin-bottom:26px; font-size:.9rem;}
  .form-control{ border-radius:12px; padding:12px 16px; border:2px solid #f1e0d5;}
  .form-control:focus{ border-color:#FF8A5B; box-shadow:0 0 0 .15rem rgba(255,138,91,.2);}
  .btn-login{ background:#FF8A5B; border:none; color:#fff; font-weight:700; border-radius:50px; padding:12px; width:100%; }
  .btn-login:hover{ background:#F4623A; color:#fff; }
</style>
</head>
<body>
  <div class="login-card">
    <h1><i class="bi bi-flower1"></i> Quản trị Mầm Non</h1>
    <p class="sub">Đăng nhập để quản lý nội dung website</p>
    <?php if ($error): ?>
      <div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label fw-bold">Tên đăng nhập</label>
        <input type="text" name="username" class="form-control" required autofocus>
      </div>
      <div class="mb-4">
        <label class="form-label fw-bold">Mật khẩu</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-login">Đăng nhập</button>
    </form>
  </div>
</body>
</html>
