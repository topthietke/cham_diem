<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$pdo = get_db();
$total = $pdo->query("SELECT COUNT(*) c FROM questions")->fetch()['c'];
$categories = all_categories();
$byCategory = $pdo->query("SELECT category, COUNT(*) c FROM questions GROUP BY category ORDER BY category")->fetchAll();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ngân Hàng Câu Hỏi PHP Developer (Middle)</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="assets/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background:var(--brand-dark)">
  <div class="container">
    <a class="navbar-brand" href="index.php"><i class="bi bi-code-slash"></i> PHP QBank</a>
    <div class="d-flex">
      <a href="admin/login.php" class="btn btn-outline-light btn-sm"><i class="bi bi-shield-lock"></i> Admin</a>
    </div>
  </div>
</nav>

<section class="hero">
  <div class="container text-center">
    <h1>Ngân Hàng Câu Hỏi Phỏng Vấn PHP Developer</h1>
    <p class="mb-0 opacity-75">Level Middle · <?= (int)$total ?> câu hỏi &amp; đáp án · <?= count($categories) ?> chủ đề</p>
  </div>
</section>

<div class="container">
  <div class="card search-card p-3 p-md-4">
    <div class="row g-2 align-items-center">
      <div class="col-md-7">
        <div class="input-group">
          <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
          <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Tìm câu hỏi hoặc từ khóa trong đáp án...">
        </div>
      </div>
      <div class="col-md-3">
        <select id="difficultyFilter" class="form-select">
          <option value="all">Tất cả độ khó</option>
          <option value="Dễ">Dễ</option>
          <option value="Trung bình">Trung bình</option>
          <option value="Khó">Khó</option>
        </select>
      </div>
      <div class="col-md-2">
        <button id="resetBtn" class="btn btn-outline-secondary w-100"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
      </div>
    </div>
    <hr>
    <div class="pill-scroller">
      <span class="category-pill active" data-cat="all">Tất cả (<?= (int)$total ?>)</span>
      <?php foreach ($byCategory as $c): ?>
        <span class="category-pill" data-cat="<?= e($c['category']) ?>"><?= e($c['category']) ?> (<?= (int)$c['c'] ?>)</span>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="row g-3 my-4">
    <div class="col-6 col-md-3">
      <div class="stat-box"><div class="num" id="resultCount"><?= (int)$total ?></div><div class="text-muted small">Câu hỏi hiển thị</div></div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-box"><div class="num"><?= count($categories) ?></div><div class="text-muted small">Chủ đề</div></div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-box"><div class="num text-success">Dễ</div><div class="text-muted small">Câu hỏi nền tảng</div></div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-box"><div class="num text-danger">Khó</div><div class="text-muted small">Câu hỏi nâng cao</div></div>
    </div>
  </div>

  <div id="loadingState" class="text-center py-5 text-muted">
    <div class="spinner-border text-primary" role="status"></div>
    <p class="mt-2">Đang tải câu hỏi...</p>
  </div>

  <div id="questionList"></div>

  <div id="emptyState">
    <i class="bi bi-inbox" style="font-size:2.5rem;"></i>
    <p class="mt-2">Không tìm thấy câu hỏi phù hợp.</p>
  </div>
</div>

<div class="footer">
  &copy; <?= date('Y') ?> PHP QBank &mdash; Ngân hàng câu hỏi phỏng vấn PHP Developer (Middle Level)
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/app.js"></script>
</body>
</html>
