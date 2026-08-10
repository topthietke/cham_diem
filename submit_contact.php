<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/lang.php';

header('Content-Type: application/json; charset=utf-8');

function json_out($success, $message) {
    echo json_encode(['success' => $success, 'message' => $message], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_out(false, tr('Yêu cầu không hợp lệ.', 'Invalid request.'));
}

$parentName = trim($_POST['parent_name'] ?? '');
$phone      = trim($_POST['phone'] ?? '');
$message    = trim($_POST['message'] ?? '');

if ($parentName === '' || $phone === '') {
    json_out(false, tr('Vui lòng nhập đầy đủ họ tên và số điện thoại.', 'Please enter your full name and phone number.'));
}

if (!preg_match('/^[0-9+\-\s()]{8,20}$/', $phone)) {
    json_out(false, tr('Số điện thoại không hợp lệ.', 'Invalid phone number.'));
}

try {
    $stmt = $pdo->prepare("INSERT INTO contact_messages (parent_name, phone, message) VALUES (?, ?, ?)");
    $stmt->execute([$parentName, $phone, $message]);

    // Gửi email thông báo cho quản trị viên (yêu cầu cấu hình mail server / SMTP trên hosting)
    $adminEmail = $pdo->query("SELECT value_vi FROM settings WHERE setting_key = 'email'")->fetchColumn();
    if ($adminEmail) {
        $subject = 'Đăng ký tư vấn mới từ ' . $parentName;
        $body    = "Họ tên: $parentName\nSố điện thoại: $phone\nLời nhắn: $message\n";
        $headers = 'From: no-reply@' . ($_SERVER['HTTP_HOST'] ?? 'mamnon.local');
        @mail($adminEmail, $subject, $body, $headers);
    }

    json_out(true, tr('Cảm ơn bạn đã đăng ký! Nhà trường sẽ liên hệ sớm nhất.', 'Thank you for registering! Our school will contact you soon.'));
} catch (Exception $e) {
    json_out(false, tr('Có lỗi xảy ra, vui lòng thử lại sau.', 'Something went wrong, please try again later.'));
}
