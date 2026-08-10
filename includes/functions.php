<?php
/**
 * Các hàm tiện ích dùng chung
 */

/** Lấy toàn bộ settings dưới dạng mảng key => row(value_vi, value_en) */
function get_settings($pdo) {
    static $cache = null;
    if ($cache !== null) return $cache;
    $stmt = $pdo->query("SELECT setting_key, value_vi, value_en FROM settings");
    $cache = [];
    foreach ($stmt->fetchAll() as $row) {
        $cache[$row['setting_key']] = $row;
    }
    return $cache;
}

/** Lấy 1 giá trị setting theo ngôn ngữ hiện tại */
function setting($pdo, $key, $default = '') {
    $settings = get_settings($pdo);
    if (!isset($settings[$key])) return $default;
    return t($settings[$key], 'value') ?: $default;
}

function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = strtolower($text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    return $text ?: 'item';
}

/** Upload ảnh an toàn, trả về tên file đã lưu hoặc false */
function upload_image($fileInputName, $subfolder) {
    if (empty($_FILES[$fileInputName]['name'])) return false;
    $file = $_FILES[$fileInputName];
    if ($file['error'] !== UPLOAD_ERR_OK) return false;

    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed, true)) return false;

    // Kiểm tra thực sự là ảnh
    if (@getimagesize($file['tmp_name']) === false) return false;

    $destDir = rtrim(UPLOAD_PATH, '/') . '/' . $subfolder . '/';
    if (!is_dir($destDir)) {
        mkdir($destDir, 0755, true);
    }
    $filename = uniqid($subfolder . '_', true) . '.' . $ext;
    if (move_uploaded_file($file['tmp_name'], $destDir . $filename)) {
        return $subfolder . '/' . $filename;
    }
    return false;
}

function img_url($path, $placeholder = 'assets/images/placeholder.svg') {
    if (empty($path)) return BASE_URL . '/' . $placeholder;
    return UPLOAD_URL . $path;
}

function redirect($url) {
    header("Location: $url");
    exit;
}

function flash_set($msg, $type = 'success') {
    $_SESSION['flash'] = ['msg' => $msg, 'type' => $type];
}

function flash_get() {
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $f;
    }
    return null;
}
