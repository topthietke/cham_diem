<?php
$pageTitle = 'Tin tức';
require_once __DIR__ . '/includes/layout_head.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save') {
    $id = $_POST['id'] ?? '';
    $title_vi = trim($_POST['title_vi']);
    $title_en = trim($_POST['title_en']);
    $summary_vi = trim($_POST['summary_vi']);
    $summary_en = trim($_POST['summary_en']);
    $content_vi = $_POST['content_vi'] ?? '';
    $content_en = $_POST['content_en'] ?? '';
    $status = isset($_POST['status']) ? 1 : 0;
    $slug = slugify($title_vi);
    $image = upload_image('image', 'news');

    if ($id) {
        if ($image) {
            $pdo->prepare("UPDATE news SET title_vi=?, title_en=?, summary_vi=?, summary_en=?, content_vi=?, content_en=?, status=?, slug=?, image=? WHERE id=?")
                ->execute([$title_vi, $title_en, $summary_vi, $summary_en, $content_vi, $content_en, $status, $slug, $image, $id]);
        } else {
            $pdo->prepare("UPDATE news SET title_vi=?, title_en=?, summary_vi=?, summary_en=?, content_vi=?, content_en=?, status=?, slug=? WHERE id=?")
                ->execute([$title_vi, $title_en, $summary_vi, $summary_en, $content_vi, $content_en, $status, $slug, $id]);
        }
        flash_set('Đã cập nhật tin tức.');
    } else {
        if (!$image) { flash_set('Vui lòng chọn hình ảnh cho bài viết.', 'error'); redirect('news.php'); }
        $pdo->prepare("INSERT INTO news (title_vi, title_en, summary_vi, summary_en, content_vi, content_en, image, slug, status, published_at) VALUES (?,?,?,?,?,?,?,?,?,NOW())")
            ->execute([$title_vi, $title_en, $summary_vi, $summary_en, $content_vi, $content_en, $image, $slug, $status]);
        flash_set('Đã thêm tin tức mới.');
    }
    redirect('news.php');
}

if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM news WHERE id = ?")->execute([(int)$_GET['delete']]);
    flash_set('Đã xóa.');
    redirect('news.php');
}

$editItem = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editItem = $stmt->fetch();
}

$items = $pdo->query("SELECT * FROM news ORDER BY published_at DESC")->fetchAll();
?>

<div class="row g-4">
  <div class="col-lg-7">
    <div class="a-card">
      <div class="table-responsive">
        <table class="table table-admin align-middle mb-0">
          <thead><tr><th>Ảnh</th><th>Tiêu đề</th><th>Ngày đăng</th><th>Hiển thị</th><th></th></tr></thead>
          <tbody>
          <?php foreach ($items as $it): ?>
            <tr>
              <td><img src="<?= img_url($it['image']) ?>" class="thumb-admin"></td>
              <td class="fw-bold"><?= htmlspecialchars($it['title_vi']) ?></td>
              <td class="small text-muted"><?= date('d/m/Y', strtotime($it['published_at'])) ?></td>
              <td><?= $it['status'] ? '<span class="badge badge-replied">Hiện</span>' : '<span class="badge badge-read">Ẩn</span>' ?></td>
              <td class="text-end">
                <a href="?edit=<?= $it['id'] ?>" class="btn btn-sm btn-admin-outline"><i class="bi bi-pencil"></i></a>
                <a href="?delete=<?= $it['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa tin tức này?')"><i class="bi bi-trash"></i></a>
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
      <h5 class="fw-bold mb-3"><?= $editItem ? 'Sửa tin tức' : 'Thêm tin tức mới' ?></h5>
      <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?= $editItem['id'] ?? '' ?>">
        <div class="mb-3">
          <label class="form-label">Tiêu đề (VI)</label>
          <input type="text" name="title_vi" class="form-control" required value="<?= htmlspecialchars($editItem['title_vi'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Tiêu đề (EN)</label>
          <input type="text" name="title_en" class="form-control" value="<?= htmlspecialchars($editItem['title_en'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Tóm tắt (VI)</label>
          <textarea name="summary_vi" rows="2" class="form-control"><?= htmlspecialchars($editItem['summary_vi'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Tóm tắt (EN)</label>
          <textarea name="summary_en" rows="2" class="form-control"><?= htmlspecialchars($editItem['summary_en'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Nội dung chi tiết (VI)</label>
          <textarea name="content_vi" rows="4" class="form-control"><?= htmlspecialchars($editItem['content_vi'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Nội dung chi tiết (EN)</label>
          <textarea name="content_en" rows="4" class="form-control"><?= htmlspecialchars($editItem['content_en'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Hình ảnh <?= $editItem ? '(để trống nếu giữ ảnh cũ)' : '' ?></label>
          <?php if ($editItem): ?><img src="<?= img_url($editItem['image']) ?>" class="thumb-admin d-block mb-2" style="width:120px;height:90px;"><?php endif; ?>
          <input type="file" name="image" class="form-control" <?= $editItem ? '' : 'required' ?>>
        </div>
        <div class="form-check mb-3">
          <input type="checkbox" name="status" class="form-check-input" id="statusChk" <?= (!$editItem || $editItem['status']) ? 'checked' : '' ?>>
          <label class="form-check-label" for="statusChk">Hiển thị trên website</label>
        </div>
        <button type="submit" class="btn btn-admin-primary w-100"><?= $editItem ? 'Cập nhật' : 'Thêm mới' ?></button>
        <?php if ($editItem): ?><a href="news.php" class="btn btn-light w-100 mt-2">Hủy</a><?php endif; ?>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/layout_foot.php'; ?>
