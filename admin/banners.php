<?php
$pageTitle = 'Banner trang chủ';
require_once __DIR__ . '/includes/layout_head.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save') {
    $id = $_POST['id'] ?? '';
    $title_vi = trim($_POST['title_vi']);
    $title_en = trim($_POST['title_en']);
    $subtitle_vi = trim($_POST['subtitle_vi']);
    $subtitle_en = trim($_POST['subtitle_en']);
    $link = trim($_POST['link']) ?: '#';
    $sort_order = (int)($_POST['sort_order'] ?? 0);
    $status = isset($_POST['status']) ? 1 : 0;

    $image = upload_image('image', 'banner');

    if ($id) {
        if ($image) {
            $stmt = $pdo->prepare("UPDATE banners SET title_vi=?, title_en=?, subtitle_vi=?, subtitle_en=?, link=?, sort_order=?, status=?, image=? WHERE id=?");
            $stmt->execute([$title_vi, $title_en, $subtitle_vi, $subtitle_en, $link, $sort_order, $status, $image, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE banners SET title_vi=?, title_en=?, subtitle_vi=?, subtitle_en=?, link=?, sort_order=?, status=? WHERE id=?");
            $stmt->execute([$title_vi, $title_en, $subtitle_vi, $subtitle_en, $link, $sort_order, $status, $id]);
        }
        flash_set('Đã cập nhật banner.');
    } else {
        if (!$image) {
            flash_set('Vui lòng chọn hình ảnh cho banner.', 'error');
            redirect('banners.php');
        }
        $stmt = $pdo->prepare("INSERT INTO banners (title_vi, title_en, subtitle_vi, subtitle_en, image, link, sort_order, status) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute([$title_vi, $title_en, $subtitle_vi, $subtitle_en, $image, $link, $sort_order, $status]);
        flash_set('Đã thêm banner mới.');
    }
    redirect('banners.php');
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM banners WHERE id = ?");
    $stmt->execute([(int)$_GET['delete']]);
    flash_set('Đã xóa banner.');
    redirect('banners.php');
}

$editItem = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM banners WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editItem = $stmt->fetch();
}

$banners = $pdo->query("SELECT * FROM banners ORDER BY sort_order ASC")->fetchAll();
?>

<div class="row g-4">
  <div class="col-lg-7">
    <div class="a-card">
      <h5 class="fw-bold mb-3">Danh sách banner</h5>
      <div class="table-responsive">
        <table class="table table-admin align-middle mb-0">
          <thead><tr><th>Ảnh</th><th>Tiêu đề</th><th>Hiển thị</th><th></th></tr></thead>
          <tbody>
          <?php foreach ($banners as $b): ?>
            <tr>
              <td><img src="<?= img_url($b['image']) ?>" class="thumb-admin"></td>
              <td><?= htmlspecialchars($b['title_vi']) ?></td>
              <td><?= $b['status'] ? '<span class="badge badge-replied">Hiện</span>' : '<span class="badge badge-read">Ẩn</span>' ?></td>
              <td class="text-end">
                <a href="?edit=<?= $b['id'] ?>" class="btn btn-sm btn-admin-outline"><i class="bi bi-pencil"></i></a>
                <a href="?delete=<?= $b['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa banner này?')"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php if (empty($banners)): ?><tr><td colspan="4" class="text-center text-muted py-4">Chưa có banner nào.</td></tr><?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-5">
    <div class="a-card">
      <h5 class="fw-bold mb-3"><?= $editItem ? 'Sửa banner' : 'Thêm banner mới' ?></h5>
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
          <label class="form-label">Mô tả phụ (VI)</label>
          <input type="text" name="subtitle_vi" class="form-control" value="<?= htmlspecialchars($editItem['subtitle_vi'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Mô tả phụ (EN)</label>
          <input type="text" name="subtitle_en" class="form-control" value="<?= htmlspecialchars($editItem['subtitle_en'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Liên kết khi bấm vào banner</label>
          <input type="text" name="link" class="form-control" value="<?= htmlspecialchars($editItem['link'] ?? '#') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Hình ảnh <?= $editItem ? '(để trống nếu giữ ảnh cũ)' : '' ?></label>
          <?php if ($editItem): ?><img src="<?= img_url($editItem['image']) ?>" class="thumb-admin d-block mb-2" style="width:120px;height:90px;"><?php endif; ?>
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
        <?php if ($editItem): ?><a href="banners.php" class="btn btn-light w-100 mt-2">Hủy</a><?php endif; ?>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/layout_foot.php'; ?>
