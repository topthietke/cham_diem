<?php
$siteName = setting($pdo, 'site_name', 'Mầm Non Ánh Dương');
$menus = $pdo->query("SELECT * FROM menus WHERE status = 1 ORDER BY sort_order ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="<?= $CURRENT_LANG ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($siteName) ?> - <?= tr('Trường Mầm Non', 'Kindergarten School') ?></title>
<meta name="description" content="<?= e(setting($pdo, 'hero_desc')) ?>">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<!-- ============ NAVBAR ============ -->
<nav class="navbar navbar-expand-lg navbar-mamnon">
  <div class="container">
    <a class="navbar-brand navbar-brand-mamnon" href="#home">
      <i class="bi bi-flower1"></i> <?= e($siteName) ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav mx-auto">
        <?php foreach ($menus as $m): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= e($m['link']) ?>"><?= e(t($m, 'label')) ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="d-flex align-items-center gap-3">
        <div class="lang-switch">
          <a href="?lang=vi" class="<?= $CURRENT_LANG === 'vi' ? 'active' : '' ?>">VI</a>
          <a href="?lang=en" class="<?= $CURRENT_LANG === 'en' ? 'active' : '' ?>">EN</a>
        </div>
        <a href="#contact" class="btn btn-primary d-none d-lg-inline-block"><?= tr('Đăng ký ngay', 'Register now') ?></a>
      </div>
    </div>
  </div>
</nav>
