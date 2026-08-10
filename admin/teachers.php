<?php
$pageTitle = 'Đội ngũ giáo viên';
require_once __DIR__ . '/includes/layout_head.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save') {
    $id = $_POST['id'] ?? '';
    $name = trim($_POST['name']);
    $position_vi = trim($_POST['position_vi']);
    $position_en = trim($_POST['position_en']);
    $sort_order = (int)($_POST['sort_order'] ?? 0);
    $status = isset($_POST['status']) ? 1 : 0;
    $photo = upload_image('photo', 'teachers');

    if ($id) {
        if ($photo) {
            $pdo->prepare("UPDATE teachers SET name=?, position_vi=?, position_en=?, sort_order=?, status=?, photo=? WHERE id=?")
                ->execute([$name, $position_vi, $position_en, $sort_order, $status, $photo, $id]);
        } else {
            $pdo->prepare("UPDATE teachers SET name=?, position_vi=?, position_en=?, sort_order=?, status=? WHERE id=?")
                ->execute([$name, $position_vi, $position_en, $sort_order, $status, $id]);
        }
        flash_set('Đã cập nhật thông tin giáo viên.');
    } else {
        if (!$photo) { flash_set('Vui lòng chọn ảnh đại diện.', 'error'); redirect('teachers.php'); }
        $pdo->prepare("INSERT INTO teachers (name, position_vi, position_en, photo, sort_order, status) VALUES (?,?,?,?,?,?)")
            ->execute([$name, $position_vi, $position_en, $photo, $sort_order, $status]);
        flash_set('Đã thêm giáo viên mới.');
    }
    redirect('teachers.php');
}

if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM teachers WHERE id = ?")->execute([(int)$_GET['delete']]);
    flash_set('Đã xóa.');
    redirect('teachers.php');
}

$editItem = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM teachers WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editItem = $stmt->fetch();
}

$items = $pdo->query("SELECT * FROM teachers ORDER BY sort_order ASC")->fetchAll();
?>

<div class="row g-4">
  <div class="col-lg-8">
    <div class="row g-3">
      <?php foreach ($items as $it): ?>
      <div class="col-6 col-md-3">
        <div class="a-card p-3 text-center">
          <img src="<?= img_url($it['photo']) ?>" class="rounded-circle mb-2" style="width:80px;height:80px;object-fit:cover;">
          <div class="fw-bold small"><?= htmlspecialchars($it['name']) ?></div>
          <div class="text-muted small mb-2"><?= htmlspecialchars($it['position_vi']) ?></div>
          <?= $it['status'] ? '<span class="badge badge-replied">Hiện</span>' : '<span class="badge badge-read">Ẩn</span>' ?>
          <div class="mt-2">
            <a href="?edit=<?= $it['id'] ?>" class="btn btn-sm btn-admin-outline"><i class="bi bi-pencil"></i></a>
            <a href="?delete=<?= $it['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa giáo viên này?')"><i class="bi bi-trash"></i></a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php if (empty($items)): ?><div class="col-12 text-center text-muted py-5">Chưa có giáo viên nào.</div><?php endif; ?>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="a-card">
      <h5 class="fw-bold mb-3"><?= $editItem ? 'Sửa giáo viên' : 'Thêm giáo viên mới' ?></h5>
      <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?= $editItem['id'] ?? '' ?>">
        <div class="mb-3">
          <label class="form-label">Họ và tên</label>
          <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($editItem['name'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Chức vụ (VI)</label>
          <input type="text" name="position_vi" class="form-control" value="<?= htmlspecialchars($editItem['position_vi'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Chức vụ (EN)</label>
          <input type="text" name="position_en" class="form-control" value="<?= htmlspecialchars($editItem['position_en'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Ảnh đại diện <?= $editItem ? '(để trống nếu giữ ảnh cũ)' : '' ?></label>
          <?php if ($editItem): ?><img src="<?= img_url($editItem['photo']) ?>" class="rounded-circle d-block mb-2" style="width:80px;height:80px;object-fit:cover;"><?php endif; ?>
          <input type="file" name="photo" class="form-control" <?= $editItem ? '' : 'required' ?>>
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
        <?php if ($editItem): ?><a href="teachers.php" class="btn btn-light w-100 mt-2">Hủy</a><?php endif; ?>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/layout_foot.php'; ?>
