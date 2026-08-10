<?php
/**
 * CHẠY 1 LẦN DUY NHẤT sau khi import database/schema.sql để tạo tài khoản quản trị mặc định.
 * Sau khi chạy xong, vui lòng XÓA file này khỏi server để đảm bảo an toàn.
 */
require_once __DIR__ . '/../config/db.php';

$username = 'admin';
$password = 'admin123';

$check = $pdo->prepare("SELECT id FROM admins WHERE username = ?");
$check->execute([$username]);

if ($check->fetch()) {
    echo "Tài khoản quản trị đã tồn tại. Bạn có thể xóa file setup.php này và đăng nhập tại admin/login.php";
} else {
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("INSERT INTO admins (username, password, full_name) VALUES (?, ?, ?)");
    $stmt->execute([$username, $hash, 'Quản trị viên']);
    echo "Đã tạo tài khoản quản trị mặc định thành công!<br>";
    echo "Tên đăng nhập: <b>admin</b><br>Mật khẩu: <b>admin123</b><br><br>";
    echo "<b>Vui lòng xóa file admin/setup.php ngay sau khi đọc thông tin này và đổi mật khẩu trong phần quản trị.</b><br>";
    echo '<a href="login.php">Đến trang đăng nhập &rarr;</a>';
}
