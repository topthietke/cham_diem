<?php
$menus = $menus ?? $pdo->query("SELECT * FROM menus WHERE status = 1 ORDER BY sort_order ASC")->fetchAll();
?>
<!-- ============ FOOTER ============ -->
<footer class="footer-mamnon">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <h5><i class="bi bi-flower1"></i> <?= e(setting($pdo, 'site_name')) ?></h5>
        <p><?= e(setting($pdo, 'about_desc')) ?></p>
        <div class="d-flex gap-2">
          <a href="<?= e(setting($pdo, 'facebook_url', '#')) ?>" class="social-icon"><i class="bi bi-facebook"></i></a>
          <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
          <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
        </div>
      </div>
      <div class="col-lg-2 col-md-4">
        <h5><?= tr('Menu', 'Menu') ?></h5>
        <ul class="list-unstyled">
          <?php foreach ($menus as $m): ?>
            <li class="mb-2"><a href="<?= e($m['link']) ?>"><?= e(t($m, 'label')) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="col-lg-3 col-md-4">
        <h5><?= tr('Liên hệ', 'Contact') ?></h5>
        <ul class="list-unstyled">
          <li class="mb-2"><i class="bi bi-geo-alt me-2"></i><?= e(setting($pdo, 'address')) ?></li>
          <li class="mb-2"><i class="bi bi-telephone me-2"></i><?= e(setting($pdo, 'phone')) ?></li>
          <li class="mb-2"><i class="bi bi-envelope me-2"></i><?= e(setting($pdo, 'email')) ?></li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-4">
        <h5><?= tr('Giờ làm việc', 'Working hours') ?></h5>
        <p><i class="bi bi-clock me-2"></i><?= e(setting($pdo, 'working_hours')) ?></p>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; <?= date('Y') ?> <?= e(setting($pdo, 'site_name')) ?>. <?= tr('Đã đăng ký bản quyền.', 'All rights reserved.') ?>
    </div>
  </div>
</footer>

<div class="back-to-top"><i class="bi bi-arrow-up"></i></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>/assets/js/main.js"></script>
</body>
</html>
