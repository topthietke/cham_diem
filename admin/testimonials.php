<?php
$pageTitle = 'Cảm nhận phụ huynh';
require_once __DIR__ . '/includes/layout_head.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save') {
    $id = $_POST['id'] ?? '';
    $parent_name = trim($_POST['parent_name']);
    $content_vi = trim($_POST['content_vi']);
    $content_en = trim($_POST['content_en']);
    $rating = max(1, min(5, (int)($_POST['rating'] ?? 5)));
    $sort_order = (int)($_POST['sort_order'] ?? 0);
    $status = isset($_POST['status']) ? 1 : 0;
    $avatar = upload_image('avatar', 'teachers');

    if ($id) {
        if ($avatar) {
            $pdo->prepare("UPDATE testimonials SET parent_name=?, content_vi=?, content_en=?, rating=?, sort_order=?, status=?, avatar=? WHERE id=?")
                ->execute([$parent_name, $content_vi, $content_en, $rating, $sort_order, $status, $avatar, $id]);
        } else {
            $pdo->prepare("UPDATE testimonials SET parent_name=?, content_vi=?, content_en=?, rating=?, sort_order=?, status=? WHERE id=?")
                ->execute([$parent_name, $content_vi, $content_en, $rating, $sort_order, $status, $id]);
        }
        flash_set('Đã cập nhật cảm nhận.');
    } else {
        $avatar = $avatar ?: 'teachers/p1.svg';
        $pdo->prepare("INSERT INTO testimonials (parent_name, content_vi, content_en, avatar, rating, sort_order, status) VALUES (?,?,?,?,?,?,?)")
            ->execute([$parent_name, $content_vi, $content_en, $avatar, $rating, $sort_order, $status]);
        flash_set('Đã thêm cảm nhận mới.');
    }
    redirect('testimonials.php');
}

if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM testimonials WHERE id = ?")->execute([(int)$_GET['delete']]);
    flash_set('Đã xóa.');
    redirect('testimonials.php');
}

$editItem = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editItem = $stmt->fetch();
}

$items = $pdo->query("SELECT * FROM testimonials ORDER BY sort_order ASC")->fetchAll();
?>

<div class="row g-4">
  <div class="col-lg-7">
    <div class="a-card">
      <div class="table-responsive">
        <table class="table table-admin align-middle mb-0">
          <thead><tr><th>Ảnh</th><th>Phụ huynh</th><th>Đánh giá</th><th>Hiển thị</th><th></th></tr></thead>
          <tbody>
          <?php foreach ($items as $it): ?>
            <tr>
              <td><img src="<?= img_url($it['avatar']) ?>" class="thumb-admin" style="border-radius:50%;"></td>
              <td class="fw-bold"><?= htmlspecialchars($it['parent_name']) ?></td>
              <td><?= str_repeat('⭐', $it['rating']) ?></td>
              <td><?= $it['status'] ? '<span class="badge badge-replied">Hiện</span>' : '<span class="badge badge-read">Ẩn</span>' ?></td>
              <td class="text-end">
                <a href="?edit=<?= $it['id'] ?>" class="btn btn-sm btn-admin-outline"><i class="bi bi-pencil"></i></a>
                <a href="?delete=<?= $it['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa cảm nhận này?')"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-5">
    <div class="a-card">
      <h5 class="fw-bold mb-3"><?= $editItem ? 'Sửa cảm nhận' : 'Thêm cảm nhận mới' ?></h5>
      <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?= $editItem['id'] ?? '' ?>">
        <div class="mb-3">
          <label class="form-label">Tên phụ huynh</label>
          <input type="text" name="parent_name" class="form-control" required value="<?= htmlspecialchars($editItem['parent_name'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Nội dung (VI)</label>
          <textarea name="content_vi" rows="3" class="form-control"><?= htmlspecialchars($editItem['content_vi'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Nội dung (EN)</label>
          <textarea name="content_en" rows="3" class="form-control"><?= htmlspecialchars($editItem['content_en'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Ảnh đại diện</label>
          <?php if ($editItem): ?><img src="<?= img_url($editItem['avatar']) ?>" class="thumb-admin d-block mb-2" style="border-radius:50%;"><?php endif; ?>
          <input type="file" name="avatar" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Số sao đánh giá</label>
          <select name="rating" class="form-select">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <option value="<?= $i ?>" <?= (($editItem['rating'] ?? 5) == $i) ? 'selected' : '' ?>><?= $i ?> sao</option>
            <?php endfor; ?>
          </select>
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
        <?php if ($editItem): ?><a href="testimonials.php" class="btn btn-light w-100 mt-2">Hủy</a><?php endif; ?>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/layout_foot.php'; ?>
