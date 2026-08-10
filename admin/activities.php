<?php
$pageTitle = 'Thư viện ảnh hoạt động';
require_once __DIR__ . '/includes/layout_head.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save') {
    $id = $_POST['id'] ?? '';
    $title_vi = trim($_POST['title_vi']);
    $title_en = trim($_POST['title_en']);
    $sort_order = (int)($_POST['sort_order'] ?? 0);
    $status = isset($_POST['status']) ? 1 : 0;
    $image = upload_image('image', 'activities');

    if ($id) {
        if ($image) {
            $pdo->prepare("UPDATE activities SET title_vi=?, title_en=?, sort_order=?, status=?, image=? WHERE id=?")
                ->execute([$title_vi, $title_en, $sort_order, $status, $image, $id]);
        } else {
            $pdo->prepare("UPDATE activities SET title_vi=?, title_en=?, sort_order=?, status=? WHERE id=?")
                ->execute([$title_vi, $title_en, $sort_order, $status, $id]);
        }
        flash_set('Đã cập nhật ảnh hoạt động.');
    } else {
        if (!$image) { flash_set('Vui lòng chọn hình ảnh.', 'error'); redirect('activities.php'); }
        $pdo->prepare("INSERT INTO activities (title_vi, title_en, image, sort_order, status) VALUES (?,?,?,?,?)")
            ->execute([$title_vi, $title_en, $image, $sort_order, $status]);
        flash_set('Đã thêm ảnh hoạt động mới.');
    }
    redirect('activities.php');
}

if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM activities WHERE id = ?")->execute([(int)$_GET['delete']]);
    flash_set('Đã xóa.');
    redirect('activities.php');
}

$editItem = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM activities WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editItem = $stmt->fetch();
}

$items = $pdo->query("SELECT * FROM activities ORDER BY sort_order ASC")->fetchAll();
?>
<p class="text-muted mb-4">Trang chủ hiển thị 4 ảnh hoạt động mới nhất theo thứ tự sắp xếp bên dưới.</p>
<div class="row g-4">
  <div class="col-lg-8">
    <div class="row g-3">
      <?php foreach ($items as $it): ?>
      <div class="col-6 col-md-4">
        <div class="a-card p-2">
          <img src="<?= img_url($it['image']) ?>" class="w-100 rounded mb-2" style="aspect-ratio:1/1;object-fit:cover;">
          <div class="fw-bold small text-truncate"><?= htmlspecialchars($it['title_vi']) ?></div>
          <div class="d-flex justify-content-between align-items-center mt-2">
            <?= $it['status'] ? '<span class="badge badge-replied">Hiện</span>' : '<span class="badge badge-read">Ẩn</span>' ?>
            <div>
              <a href="?edit=<?= $it['id'] ?>" class="btn btn-sm btn-admin-outline"><i class="bi bi-pencil"></i></a>
              <a href="?delete=<?= $it['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa ảnh này?')"><i class="bi bi-trash"></i></a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php if (empty($items)): ?><div class="col-12 text-center text-muted py-5">Chưa có ảnh hoạt động nào.</div><?php endif; ?>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="a-card">
      <h5 class="fw-bold mb-3"><?= $editItem ? 'Sửa ảnh' : 'Thêm ảnh mới' ?></h5>
      <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?= $editItem['id'] ?? '' ?>">
        <div class="mb-3">
          <label class="form-label">Tiêu đề (VI)</label>
          <input type="text" name="title_vi" class="form-control" value="<?= htmlspecialchars($editItem['title_vi'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Tiêu đề (EN)</label>
          <input type="text" name="title_en" class="form-control" value="<?= htmlspecialchars($editItem['title_en'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Hình ảnh <?= $editItem ? '(để trống nếu giữ ảnh cũ)' : '' ?></label>
          <?php if ($editItem): ?><img src="<?= img_url($editItem['image']) ?>" class="thumb-admin d-block mb-2" style="width:100px;height:100px;"><?php endif; ?>
          <input type="file" name="image" class="form-control" <?= $editItem ? '' : 'required' ?>>
        </div>
        <div class="mb-3">
          <label class="form-label">Thứ tự hiển thị</label>
          <input type="number" name="sort_order" class="form-control" value="<?= htmlspecialchars($editItem['sort_order'] ?? 0) ?>">
        </div>
        <div class="form-check mb-3">
          <input type="checkbox" name="status" class="form-check-input" id="statusChk" <?= (!$editItem || $editItem['status']) ? 'checked' : '' ?>>
          <label class="form-check-label" for="statusChk">Hiển thị trên website</label>
        </div>
        <button type="submit" class="btn btn-admin-primary w-100"><?= $editItem ? 'Cập nhật' : 'Thêm mới' ?></button>
        <?php if ($editItem): ?><a href="activities.php" class="btn btn-light w-100 mt-2">Hủy</a><?php endif; ?>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/layout_foot.php'; ?>
