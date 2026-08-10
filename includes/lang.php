<?php
/**
 * Xử lý đa ngôn ngữ cho landing page (VI / EN)
 * Ngôn ngữ được lưu trong session + cookie, có thể đổi qua ?lang=vi|en
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$allowedLangs = ['vi', 'en'];

if (isset($_GET['lang']) && in_array($_GET['lang'], $allowedLangs, true)) {
    $_SESSION['lang'] = $_GET['lang'];
    setcookie('site_lang', $_GET['lang'], time() + 60 * 60 * 24 * 30, '/');
}

if (!isset($_SESSION['lang'])) {
    if (isset($_COOKIE['site_lang']) && in_array($_COOKIE['site_lang'], $allowedLangs, true)) {
        $_SESSION['lang'] = $_COOKIE['site_lang'];
    } else {
        $_SESSION['lang'] = 'vi';
    }
}

$CURRENT_LANG = $_SESSION['lang'];

/**
 * Lấy nội dung theo ngôn ngữ hiện tại từ một hàng dữ liệu (mảng)
 * $row phải có 2 cột dạng {field}_vi và {field}_en
 */
function t($row, $field) {
    global $CURRENT_LANG;
    $key = $field . '_' . $CURRENT_LANG;
    $fallback = $field . '_vi';
    if (isset($row[$key]) && $row[$key] !== '') {
        return $row[$key];
    }
    return $row[$fallback] ?? '';
}

/** Nhãn tĩnh dùng cho các chuỗi giao diện cố định (không lấy từ DB) */
function tr($vi, $en) {
    global $CURRENT_LANG;
    return $CURRENT_LANG === 'en' ? $en : $vi;
}
