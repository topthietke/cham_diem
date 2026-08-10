<?php
require_once __DIR__ . '/auth.php';
require_admin_login();
$flash = flash_get();
$currentPage = basename($_SERVER['PHP_SELF']);

$navItems = [
    ['index.php', 'bi-grid-1x2-fill', 'Tổng quan', null],
    ['settings.php', 'bi-gear-fill', 'Cài đặt chung', null],
    ['menus.php', 'bi-list-ul', 'Danh mục (Menu)', null],
    ['banners.php', 'bi-images', 'Banner trang chủ', null],
    ['stats.php', 'bi-bar-chart-fill', 'Thống kê số liệu', null],
    ['programs.php', 'bi-flower1', 'Chương trình học', null],
    ['activities.php', 'bi-image', 'Thư viện ảnh HĐ', null],
    ['teachers.php', 'bi-people-fill', 'Đội ngũ giáo viên', null],
    ['testimonials.php', 'bi-chat-heart-fill', 'Cảm nhận phụ huynh', null],
    ['news.php', 'bi-newspaper', 'Tin tức', null],
    ['messages.php', 'bi-envelope-fill', 'Tin nhắn liên hệ', 'contact_messages'],
];

// đếm tin nhắn chưa đọc cho badge
$unread = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'new'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quản trị Mầm Non - <?= htmlspecialchars($pageTitle ?? 'Tổng quan') ?></title>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="admin-wrapper">
  <aside class="admin-sidebar" id="adminSidebar">
    <div class="brand"><i class="bi bi-flower1"></i> Quản trị Mầm Non</div>
    <nav class="admin-nav">
      <?php foreach ($navItems as [$file, $icon, $label, $badgeKey]): ?>
        <a href="<?= $file ?>" class="<?= $currentPage === $file ? 'active' : '' ?>">
          <i class="bi <?= $icon ?>"></i> <?= $label ?>
          <?php if ($badgeKey === 'contact_messages' && $unread > 0): ?>
            <span class="badge rounded-pill bg-danger ms-auto"><?= $unread ?></span>
          <?php endif; ?>
        </a>
      <?php endforeach; ?>
      <div class="nav-section-title">Tài khoản</div>
      <a href="account.php" class="<?= $currentPage === 'account.php' ? 'active' : '' ?>"><i class="bi bi-person-circle"></i> Tài khoản của tôi</a>
      <a href="logout.php" class="logout-link"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a>
      <a href="../index.php" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Xem website</a>
    </nav>
  </aside>

  <main class="admin-main">
    <div class="admin-topbar">
      <div class="d-flex align-items-center gap-3">
        <button class="btn btn-sm btn-light d-md-none" onclick="document.getElementById('adminSidebar').classList.toggle('open')"><i class="bi bi-list"></i></button>
        <h1><?= htmlspecialchars($pageTitle ?? 'Tổng quan') ?></h1>
      </div>
      <div class="admin-user-chip"><i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['admin_name'] ?? 'Quản trị viên') ?></div>
    </div>
    <div class="admin-content">
      <?php if ($flash): ?>
        <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?>"><?= htmlspecialchars($flash['msg']) ?></div>
      <?php endif; ?>
