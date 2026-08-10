<?php
$pageTitle = 'Thống kê số liệu';
require_once __DIR__ . '/includes/layout_head.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save') {
    $id = $_POST['id'] ?? '';
    $number_value = trim($_POST['number_value']);
    $label_vi = trim($_POST['label_vi']);
    $label_en = trim($_POST['label_en']);
    $icon = trim($_POST['icon']) ?: 'bi-star-fill';
    $sort_order = (int)($_POST['sort_order'] ?? 0);

    if ($id) {
        $stmt = $pdo->prepare("UPDATE stats SET number_value=?, label_vi=?, label_en=?, icon=?, sort_order=? WHERE id=?");
        $stmt->execute([$number_value, $label_vi, $label_en, $icon, $sort_order, $id]);
        flash_set('Đã cập nhật số liệu.');
    } else {
        $stmt = $pdo->prepare("INSERT INTO stats (number_value, label_vi, label_en, icon, sort_order) VALUES (?,?,?,?,?)");
        $stmt->execute([$number_value, $label_vi, $label_en, $icon, $sort_order]);
        flash_set('Đã thêm số liệu mới.');
    }
    redirect('stats.php');
}

if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM stats WHERE id = ?")->execute([(int)$_GET['delete']]);
    flash_set('Đã xóa.');
    redirect('stats.php');
}

$editItem = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM stats WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editItem = $stmt->fetch();
}

$stats = $pdo->query("SELECT * FROM stats ORDER BY sort_order ASC")->fetchAll();
?>

<p class="text-muted mb-4">Đây là các số liệu hiển thị ở thanh thống kê dưới banner đầu trang (VD: 300+ Học sinh, 20+ Giáo viên...). Icon dùng tên class của <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>, VD: <code>bi-emoji-smile</code>.</p>

<div class="row g-4">
  <div class="col-lg-7">
    <div class="a-card">
      <div class="table-responsive">
        <table class="table table-admin align-middle mb-0">
          <thead><tr><th>Icon</th><th>Số liệu</th><th>Nhãn</th><th></th></tr></thead>
          <tbody>
          <?php foreach ($stats as $s): ?>
            <tr>
              <td><i class="bi <?= htmlspecialchars($s['icon']) ?> fs-4 text-warning"></i></td>
              <td class="fw-bold"><?= htmlspecialchars($s['number_value']) ?></td>
              <td><?= htmlspecialchars($s['label_vi']) ?> <span class="text-muted small">/ <?= htmlspecialchars($s['label_en']) ?></span></td>
              <td class="text-end">
                <a href="?edit=<?= $s['id'] ?>" class="btn btn-sm btn-admin-outline"><i class="bi bi-pencil"></i></a>
                <a href="?delete=<?= $s['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa mục này?')"><i class="bi bi-trash"></i></a>
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
      <h5 class="fw-bold mb-3"><?= $editItem ? 'Sửa số liệu' : 'Thêm số liệu mới' ?></h5>
      <form method="POST">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?= $editItem['id'] ?? '' ?>">
        <div class="mb-3">
          <label class="form-label">Giá trị số (VD: 300+)</label>
          <input type="text" name="number_value" class="form-control" required value="<?= htmlspecialchars($editItem['number_value'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Nhãn (VI)</label>
          <input type="text" name="label_vi" class="form-control" required value="<?= htmlspecialchars($editItem['label_vi'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Nhãn (EN)</label>
          <input type="text" name="label_en" class="form-control" required value="<?= htmlspecialchars($editItem['label_en'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Icon (Bootstrap Icons class)</label>
          <input type="text" name="icon" class="form-control" value="<?= htmlspecialchars($editItem['icon'] ?? 'bi-star-fill') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Thứ tự hiển thị</label>
          <input type="number" name="sort_order" class="form-control" value="<?= htmlspecialchars($editItem['sort_order'] ?? 0) ?>">
        </div>
        <button type="submit" class="btn btn-admin-primary w-100"><?= $editItem ? 'Cập nhật' : 'Thêm mới' ?></button>
        <?php if ($editItem): ?><a href="stats.php" class="btn btn-light w-100 mt-2">Hủy</a><?php endif; ?>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/layout_foot.php'; ?>
