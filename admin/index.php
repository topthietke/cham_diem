<?php
$pageTitle = 'Danh sách câu hỏi';
require_once __DIR__ . '/_layout_top.php';

// Xử lý xóa
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index.php?deleted=1');
    exit;
}

$q = trim($_GET['q'] ?? '');
$cat = trim($_GET['cat'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 20;

$sql = "SELECT * FROM questions WHERE 1=1";
$countSql = "SELECT COUNT(*) c FROM questions WHERE 1=1";
$params = [];

if ($q !== '') {
    $sql .= " AND (question LIKE :kw OR answer LIKE :kw)";
    $countSql .= " AND (question LIKE :kw OR answer LIKE :kw)";
    $params[':kw'] = '%' . $q . '%';
}
if ($cat !== '') {
    $sql .= " AND category = :cat";
    $countSql .= " AND category = :cat";
    $params[':cat'] = $cat;
}

$countStmt = $pdo->prepare($countSql);
$countStmt->execute($params);
$total = (int)$countStmt->fetch()['c'];
$totalPages = max(1, (int)ceil($total / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;

$sql .= " ORDER BY id ASC LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
foreach ($params as $k => $v) {
    $stmt->bindValue($k, $v);
}
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$questions = $stmt->fetchAll();

$categories = all_categories();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h3 class="mb-0">Quản lý câu hỏi</h3>
    <small class="text-muted">Tổng cộng <?= (int)$total ?> câu hỏi</small>
  </div>
  <a href="add.php" class="btn text-white" style="background:var(--brand)"><i class="bi bi-plus-circle"></i> Thêm câu hỏi mới</a>
</div>

<?php if (isset($_GET['deleted'])): ?>
  <div class="alert alert-success alert-dismissible fade show">Đã xóa câu hỏi thành công. <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>
<?php if (isset($_GET['saved'])): ?>
  <div class="alert alert-success alert-dismissible fade show">Đã lưu câu hỏi thành công. <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="card border-0 shadow-sm mb-3">
  <div class="card-body">
    <form method="get" class="row g-2">
      <div class="col-md-6">
        <input type="text" name="q" class="form-control" placeholder="Tìm theo câu hỏi hoặc đáp án..." value="<?= e($q) ?>">
      </div>
      <div class="col-md-4">
        <select name="cat" class="form-select">
          <option value="">Tất cả chủ đề</option>
          <?php foreach ($categories as $c): ?>
            <option value="<?= e($c) ?>" <?= $cat === $c ? 'selected' : '' ?>><?= e($c) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-outline-secondary w-100" type="submit"><i class="bi bi-search"></i> Lọc</button>
      </div>
    </form>
  </div>
</div>

<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th style="width:60px;">#</th>
          <th style="width:160px;">Chủ đề</th>
          <th>Câu hỏi</th>
          <th>Đáp án</th>
          <th style="width:100px;">Độ khó</th>
          <th style="width:110px;">Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($questions)): ?>
          <tr><td colspan="6" class="text-center text-muted py-4">Không có câu hỏi nào.</td></tr>
        <?php endif; ?>
        <?php foreach ($questions as $row): ?>
          <tr>
            <td><?= (int)$row['id'] ?></td>
            <td><span class="badge bg-light text-dark border"><?= e($row['category']) ?></span></td>
            <td><?= e($row['question']) ?></td>
            <td class="answer-cell text-muted"><?= e($row['answer']) ?></td>
            <td><span class="badge <?= badge_class($row['difficulty']) ?>"><?= e($row['difficulty']) ?></span></td>
            <td>
              <a href="edit.php?id=<?= (int)$row['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
              <a href="#" class="btn btn-sm btn-outline-danger btn-delete" data-id="<?= (int)$row['id'] ?>"><i class="bi bi-trash"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php if ($totalPages > 1): ?>
<nav class="mt-3">
  <ul class="pagination justify-content-center">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <li class="page-item <?= $i === $page ? 'active' : '' ?>">
        <a class="page-link" href="?page=<?= $i ?>&q=<?= urlencode($q) ?>&cat=<?= urlencode($cat) ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>
<?php endif; ?>

<script>
document.querySelectorAll('.btn-delete').forEach(function (btn) {
  btn.addEventListener('click', function (e) {
    e.preventDefault();
    if (confirm('Bạn có chắc muốn xóa câu hỏi này không?')) {
      window.location.href = 'index.php?delete=' + this.dataset.id;
    }
  });
});
</script>

<?php require_once __DIR__ . '/_layout_bottom.php'; ?>
