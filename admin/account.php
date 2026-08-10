<?php
$pageTitle = 'Tài khoản của tôi';
require_once __DIR__ . '/includes/layout_head.php';

$stmt = $pdo->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->execute([$_SESSION['admin_id']]);
$admin = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name']);
    $currentPw = $_POST['current_password'] ?? '';
    $newPw = $_POST['new_password'] ?? '';

    if ($newPw !== '') {
        if (!password_verify($currentPw, $admin['password'])) {
            flash_set('Mật khẩu hiện tại không đúng.', 'error');
            redirect('account.php');
        }
        if (strlen($newPw) < 6) {
            flash_set('Mật khẩu mới phải có ít nhất 6 ký tự.', 'error');
            redirect('account.php');
        }
        $hash = password_hash($newPw, PASSWORD_BCRYPT);
        $pdo->prepare("UPDATE admins SET full_name = ?, password = ? WHERE id = ?")
            ->execute([$fullName, $hash, $admin['id']]);
        flash_set('Đã cập nhật tài khoản và mật khẩu mới.');
    } else {
        $pdo->prepare("UPDATE admins SET full_name = ? WHERE id = ?")->execute([$fullName, $admin['id']]);
        flash_set('Đã cập nhật thông tin tài khoản.');
    }
    $_SESSION['admin_name'] = $fullName;
    redirect('account.php');
}
?>

<div class="row">
  <div class="col-lg-6">
    <div class="a-card">
      <h5 class="fw-bold mb-3">Thông tin tài khoản</h5>
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Tên đăng nhập</label>
          <input type="text" class="form-control" value="<?= htmlspecialchars($admin['username']) ?>" disabled>
        </div>
        <div class="mb-3">
          <label class="form-label">Họ và tên hiển thị</label>
          <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($admin['full_name']) ?>">
        </div>
        <hr>
        <p class="text-muted small">Để trống nếu bạn không muốn đổi mật khẩu.</p>
        <div class="mb-3">
          <label class="form-label">Mật khẩu hiện tại</label>
          <input type="password" name="current_password" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Mật khẩu mới</label>
          <input type="password" name="new_password" class="form-control">
        </div>
        <button type="submit" class="btn btn-admin-primary">Lưu thay đổi</button>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/layout_foot.php'; ?>
