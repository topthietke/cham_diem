<?php
$pageTitle = 'Thêm câu hỏi';
require_once __DIR__ . '/_layout_top.php';

$errors = [];
$formData = ['category' => '', 'question' => '', 'answer' => '', 'difficulty' => 'Trung bình'];
$categories = all_categories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData['category'] = trim($_POST['category_select'] === '__new__' ? ($_POST['category_new'] ?? '') : ($_POST['category_select'] ?? ''));
    $formData['question'] = trim($_POST['question'] ?? '');
    $formData['answer'] = trim($_POST['answer'] ?? '');
    $formData['difficulty'] = trim($_POST['difficulty'] ?? 'Trung bình');

    if ($formData['category'] === '') $errors[] = 'Vui lòng chọn hoặc nhập chủ đề.';
    if ($formData['question'] === '') $errors[] = 'Vui lòng nhập nội dung câu hỏi.';
    if ($formData['answer'] === '') $errors[] = 'Vui lòng nhập nội dung đáp án.';
    if (!in_array($formData['difficulty'], ['Dễ', 'Trung bình', 'Khó'], true)) $errors[] = 'Độ khó không hợp lệ.';

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO questions (category, question, answer, difficulty, updated_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
        $stmt->execute([$formData['category'], $formData['question'], $formData['answer'], $formData['difficulty']]);
        header('Location: index.php?saved=1');
        exit;
    }
}
?>

<h3 class="mb-4"><i class="bi bi-plus-circle"></i> Thêm câu hỏi mới</h3>

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
            <option value="">-- Chọn chủ đề --</option>
            <?php foreach ($categories as $c): ?>
              <option value="<?= e($c) ?>" <?= $formData['category'] === $c ? 'selected' : '' ?>><?= e($c) ?></option>
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
              <option value="<?= $d ?>" <?= $formData['difficulty'] === $d ? 'selected' : '' ?>><?= $d ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-12">
          <label class="form-label">Câu hỏi</label>
          <textarea name="question" class="form-control" rows="2" required><?= e($formData['question']) ?></textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Đáp án</label>
          <textarea name="answer" class="form-control" rows="4" required><?= e($formData['answer']) ?></textarea>
        </div>
      </div>
      <div class="mt-4">
        <button type="submit" class="btn text-white" style="background:var(--brand)"><i class="bi bi-save"></i> Lưu câu hỏi</button>
        <a href="index.php" class="btn btn-outline-secondary">Hủy</a>
      </div>
    </form>
  </div>
</div>

<?php require_once __DIR__ . '/_layout_bottom.php'; ?>
