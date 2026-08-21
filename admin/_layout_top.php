<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_admin_login();
$pdo = get_db();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($pageTitle) ? e($pageTitle) . ' - ' : '' ?>Admin PHP QBank</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="../assets/style.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
  <div class="admin-sidebar p-3" style="width:240px;flex-shrink:0;">
    <a href="index.php" class="text-white text-decoration-none d-block mb-4">
      <i class="bi bi-code-slash"></i> <strong>PHP QBank</strong>
    </a>
    <a href="index.php" class="<?= $currentPage === 'index.php' ? 'active' : '' ?>"><i class="bi bi-list-ul"></i> Danh sách câu hỏi</a>
    <a href="add.php" class="<?= $currentPage === 'add.php' ? 'active' : '' ?>"><i class="bi bi-plus-circle"></i> Thêm câu hỏi</a>
    <a href="../index.php" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Xem trang public</a>
    <hr style="border-color:rgba(255,255,255,.2)">
    <div class="small text-white-50 px-2 mb-2">Đăng nhập: <?= e($_SESSION['admin_username'] ?? '') ?></div>
    <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a>
  </div>
  <div class="flex-grow-1 p-4" style="background:#f7f7fb;min-height:100vh;">
