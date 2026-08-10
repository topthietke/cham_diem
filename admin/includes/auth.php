<?php
require_once __DIR__ . '/../../config/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Trang quản trị luôn hiển thị tiếng Việt
$CURRENT_LANG = 'vi';

require_once __DIR__ . '/../../includes/functions.php';

function t($row, $field) {
    return $row[$field . '_vi'] ?? '';
}
function tr($vi, $en) {
    return $vi;
}

function admin_logged_in() {
    return !empty($_SESSION['admin_id']);
}

function require_admin_login() {
    if (!admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
