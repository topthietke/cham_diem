<?php
$pageTitle = 'Sửa câu hỏi';
require_once __DIR__ . '/_layout_top.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM questions WHERE id = ?");
$stmt->execute([$id]);
$question = $stmt->fetch();

if (!$question) {
    header('Location: index.php');
    exit;
}

$errors = [];
$categories = all_categories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = trim($_POST['category_select'] === '__new__' ? ($_POST['category_new'] ?? '') : ($_POST['category_select'] ?? ''));
    $q = trim($_POST['question'] ?? '');
    $a = trim($_POST['answer'] ?? '');
    $diff = trim($_POST['difficulty'] ?? 'Trung bình');

    if ($category === '') $errors[] = 'Vui lòng chọn hoặc nhập chủ đề.';
    if ($q === '') $errors[] = 'Vui lòng nhập nội dung câu hỏi.';
    if ($a === '') $errors[] = 'Vui lòng nhập nội dung đáp án.';
    if (!in_array($diff, ['Dễ', 'Trung bình', 'Khó'], true)) $errors[] = 'Độ khó không hợp lệ.';

    if (empty($errors)) {
        $upd = $pdo->prepare("UPDATE questions SET category=?, question=?, answer=?, difficulty=?, updated_at=CURRENT_TIMESTAMP WHERE id=?");
        $upd->execute([$category, $q, $a, $diff, $id]);
        header('Location: index.php?saved=1');
        exit;
    }
    // giữ lại dữ liệu vừa nhập nếu lỗi
    $question = ['id' => $id, 'category' => $category, 'question' => $q, 'answer' => $a, 'difficulty' => $diff];
}
?>

<h3 class="mb-4"><i class="bi bi-pencil-square"></i> Sửa câu hỏi #<?= (int)$question['id'] ?></h3>

<?php if ($errors): ?>
  <div class="alert alert-danger">
    <ul class="mb-0"><?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?></ul>
  </div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
  <div class="card-body">
    <form method="post">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Chủ đề</label>
          <select name="category_select" id="categorySelect" class="form-select" onchange="document.getElementById('newCatWrap').style.display = this.value === '__new__' ? 'block' : 'none';">
            <?php foreach ($categories as $c): ?>
              <option value="<?= e($c) ?>" <?= $question['category'] === $c ? 'selected' : '' ?>><?= e($c) ?></option>
            <?php endforeach; ?>
            <option value="__new__">+ Chủ đề mới...</option>
          </select>
          <div id="newCatWrap" class="mt-2" style="display:none;">
            <input type="text" name="category_new" class="form-control" placeholder="Nhập tên chủ đề mới">
          </div>
        </div>
        <div class="col-md-6">
          <label class="form-label">Độ khó</label>
          <select name="difficulty" class="form-select">
            <?php foreach (['Dễ', 'Trung bình', 'Khó'] as $d): ?>
              <option value="<?= $d ?>" <?= $question['difficulty'] === $d ? 'selected' : '' ?>><?= $d ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-12">
          <label class="form-label">Câu hỏi</label>
          <textarea name="question" class="form-control" rows="2" required><?= e($question['question']) ?></textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Đáp án</label>
          <textarea name="answer" class="form-control" rows="4" required><?= e($question['answer']) ?></textarea>
        </div>
      </div>
      <div class="mt-4">
        <button type="submit" class="btn text-white" style="background:var(--brand)"><i class="bi bi-save"></i> Cập nhật</button>
        <a href="index.php" class="btn btn-outline-secondary">Hủy</a>
      </div>
    </form>
  </div>
</div>

<?php require_once __DIR__ . '/_layout_bottom.php'; ?>
