<?php
/**
 * Cấu hình kết nối cơ sở dữ liệu
 * Đổi các thông số bên dưới cho phù hợp với môi trường của bạn.
 */
define('DB_HOST', 'localhost');
define('DB_NAME', 'mamnon_database');
define('DB_USER', 'root');
define('DB_PASS', '!23456aA@');
define('DB_CHARSET', 'utf8mb4');

// Đường dẫn gốc của website (không có dấu / cuối). VD: /mamnon hoặc để rỗng nếu chạy ở domain gốc
define('BASE_URL', '');

// Thư mục upload
define('UPLOAD_PATH', __DIR__ . '/../uploads/');
define('UPLOAD_URL', BASE_URL . '/uploads/');

try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    die('Lỗi kết nối cơ sở dữ liệu: ' . htmlspecialchars($e->getMessage()) .
        '<br>Vui lòng kiểm tra cấu hình tại config/db.php và đảm bảo đã import database/schema.sql');
}
