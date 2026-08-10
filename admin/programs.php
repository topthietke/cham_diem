<?php
$pageTitle = 'Chương trình học';
require_once __DIR__ . '/includes/layout_head.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save') {
    $id = $_POST['id'] ?? '';
    $data = [
        trim($_POST['name_vi']), trim($_POST['name_en']), trim($_POST['age_range']),
        trim($_POST['desc_vi']), trim($_POST['desc_en']), trim($_POST['icon']) ?: 'bi-flower1',
        (int)($_POST['sort_order'] ?? 0), isset($_POST['status']) ? 1 : 0
    ];
    if ($id) {
        $stmt = $pdo->prepare("UPDATE age_groups SET name_vi=?, name_en=?, age_range=?, desc_vi=?, desc_en=?, icon=?, sort_order=?, status=? WHERE id=?");
        $stmt->execute([...$data, $id]);
        flash_set('Đã cập nhật chương trình học.');
    } else {
        $stmt = $pdo->prepare("INSERT INTO age_groups (name_vi, name_en, age_range, desc_vi, desc_en, icon, sort_order, status) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute($data);
        flash_set('Đã thêm chương trình học mới.');
    }
    redirect('programs.php');
}

if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM age_groups WHERE id = ?")->execute([(int)$_GET['delete']]);
    flash_set('Đã xóa.');
    redirect('programs.php');
}

$editItem = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM age_groups WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editItem = $stmt->fetch();
}

$items = $pdo->query("SELECT * FROM age_groups ORDER BY sort_order ASC")->fetchAll();
?>

<div class="row g-4">
  <div class="col-lg-7">
    <div class="a-card">
      <div class="table-responsive">
        <table class="table table-admin align-middle mb-0">
          <thead><tr><th>Icon</th><th>Tên lớp</th><th>Độ tuổi</th><th>Hiển thị</th><th></th></tr></thead>
          <tbody>
          <?php foreach ($items as $it): ?>
            <tr>
              <td><i class="bi <?= htmlspecialchars($it['icon']) ?> fs-4 text-warning"></i></td>
              <td class="fw-bold"><?= htmlspecialchars($it['name_vi']) ?></td>
              <td><?= htmlspecialchars($it['age_range']) ?></td>
              <td><?= $it['status'] ? '<span class="badge badge-replied">Hiện</span>' : '<span class="badge badge-read">Ẩn</span>' ?></td>
              <td class="text-end">
                <a href="?edit=<?= $it['id'] ?>" class="btn btn-sm btn-admin-outline"><i class="bi bi-pencil"></i></a>
                <a href="?delete=<?= $it['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa mục này?')"><i class="bi bi-trash"></i></a>
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
      <h5 class="fw-bold mb-3"><?= $editItem ? 'Sửa chương trình' : 'Thêm chương trình mới' ?></h5>
      <form method="POST">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?= $editItem['id'] ?? '' ?>">
        <div class="row g-3">
          <div class="col-6">
            <label class="form-label">Tên lớp (VI)</label>
            <input type="text" name="name_vi" class="form-control" required value="<?= htmlspecialchars($editItem['name_vi'] ?? '') ?>">
          </div>
          <div class="col-6">
            <label class="form-label">Tên lớp (EN)</label>
            <input type="text" name="name_en" class="form-control" required value="<?= htmlspecialchars($editItem['name_en'] ?? '') ?>">
          </div>
        </div>
        <div class="mb-3 mt-3">
          <label class="form-label">Độ tuổi (VD: 2 - 3 tuổi)</label>
          <input type="text" name="age_range" class="form-control" value="<?= htmlspecialchars($editItem['age_range'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Mô tả (VI)</label>
          <textarea name="desc_vi" rows="2" class="form-control"><?= htmlspecialchars($editItem['desc_vi'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Mô tả (EN)</label>
          <textarea name="desc_en" rows="2" class="form-control"><?= htmlspecialchars($editItem['desc_en'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Icon (Bootstrap Icons)</label>
          <input type="text" name="icon" class="form-control" value="<?= htmlspecialchars($editItem['icon'] ?? 'bi-flower1') ?>">
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
        <?php if ($editItem): ?><a href="programs.php" class="btn btn-light w-100 mt-2">Hủy</a><?php endif; ?>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/layout_foot.php'; ?>
