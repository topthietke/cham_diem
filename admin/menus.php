<?php
$pageTitle = 'Danh mục (Menu)';
require_once __DIR__ . '/includes/layout_head.php';

// Xử lý thêm / sửa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save') {
    $id = $_POST['id'] ?? '';
    $label_vi = trim($_POST['label_vi']);
    $label_en = trim($_POST['label_en']);
    $link = trim($_POST['link']);
    $sort_order = (int)($_POST['sort_order'] ?? 0);
    $status = isset($_POST['status']) ? 1 : 0;

    if ($id) {
        $stmt = $pdo->prepare("UPDATE menus SET label_vi=?, label_en=?, link=?, sort_order=?, status=? WHERE id=?");
        $stmt->execute([$label_vi, $label_en, $link, $sort_order, $status, $id]);
        flash_set('Đã cập nhật mục menu.');
    } else {
        $stmt = $pdo->prepare("INSERT INTO menus (label_vi, label_en, link, sort_order, status) VALUES (?,?,?,?,?)");
        $stmt->execute([$label_vi, $label_en, $link, $sort_order, $status]);
        flash_set('Đã thêm mục menu mới.');
    }
    redirect('menus.php');
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM menus WHERE id = ?");
    $stmt->execute([(int)$_GET['delete']]);
    flash_set('Đã xóa mục menu.');
    redirect('menus.php');
}

$editItem = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM menus WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editItem = $stmt->fetch();
}

$menus = $pdo->query("SELECT * FROM menus ORDER BY sort_order ASC")->fetchAll();
?>

<div class="row g-4">
  <div class="col-lg-7">
    <div class="a-card">
      <h5 class="fw-bold mb-3">Danh sách menu header</h5>
      <div class="table-responsive">
        <table class="table table-admin align-middle mb-0">
          <thead><tr><th>Thứ tự</th><th>Nhãn (VI / EN)</th><th>Liên kết</th><th>Hiển thị</th><th></th></tr></thead>
          <tbody>
          <?php foreach ($menus as $m): ?>
            <tr>
              <td><?= $m['sort_order'] ?></td>
              <td><?= htmlspecialchars($m['label_vi']) ?> <span class="text-muted small">/ <?= htmlspecialchars($m['label_en']) ?></span></td>
              <td class="small text-muted"><?= htmlspecialchars($m['link']) ?></td>
              <td><?= $m['status'] ? '<span class="badge badge-replied">Hiện</span>' : '<span class="badge badge-read">Ẩn</span>' ?></td>
              <td class="text-end">
                <a href="?edit=<?= $m['id'] ?>" class="btn btn-sm btn-admin-outline"><i class="bi bi-pencil"></i></a>
                <a href="?delete=<?= $m['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa mục menu này?')"><i class="bi bi-trash"></i></a>
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
      <h5 class="fw-bold mb-3"><?= $editItem ? 'Sửa mục menu' : 'Thêm mục menu mới' ?></h5>
      <form method="POST">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?= $editItem['id'] ?? '' ?>">
        <div class="mb-3">
          <label class="form-label">Nhãn tiếng Việt</label>
          <input type="text" name="label_vi" class="form-control" required value="<?= htmlspecialchars($editItem['label_vi'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Nhãn tiếng Anh</label>
          <input type="text" name="label_en" class="form-control" required value="<?= htmlspecialchars($editItem['label_en'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Liên kết (VD: #about hoặc /trang.php)</label>
          <input type="text" name="link" class="form-control" required value="<?= htmlspecialchars($editItem['link'] ?? '#') ?>">
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
        <?php if ($editItem): ?><a href="menus.php" class="btn btn-light w-100 mt-2">Hủy</a><?php endif; ?>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/layout_foot.php'; ?>
