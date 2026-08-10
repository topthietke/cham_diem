<?php
$pageTitle = 'Cài đặt chung';
require_once __DIR__ . '/includes/layout_head.php';

$fields = [
    'site_name'    => ['label' => 'Tên trường', 'type' => 'text'],
    'hero_title'   => ['label' => 'Tiêu đề Hero (banner đầu trang)', 'type' => 'text'],
    'hero_desc'    => ['label' => 'Mô tả Hero', 'type' => 'textarea'],
    'hero_btn1'    => ['label' => 'Nút 1 (VD: Đăng ký tư vấn)', 'type' => 'text'],
    'hero_btn2'    => ['label' => 'Nút 2 (VD: Tham quan trường)', 'type' => 'text'],
    'about_label'  => ['label' => 'Nhãn mục Giới thiệu', 'type' => 'text'],
    'about_title'  => ['label' => 'Tiêu đề Giới thiệu', 'type' => 'text'],
    'about_desc'   => ['label' => 'Mô tả Giới thiệu', 'type' => 'textarea'],
    'address'      => ['label' => 'Địa chỉ', 'type' => 'text'],
    'phone'        => ['label' => 'Số điện thoại', 'type' => 'text'],
    'email'        => ['label' => 'Email liên hệ (nhận đăng ký)', 'type' => 'text'],
    'working_hours'=> ['label' => 'Giờ làm việc', 'type' => 'text'],
    'facebook_url' => ['label' => 'Link Facebook', 'type' => 'text'],
    'map_embed'    => ['label' => 'Mã nhúng Google Maps (iframe)', 'type' => 'textarea'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE settings SET value_vi = ?, value_en = ? WHERE setting_key = ?");
    foreach ($fields as $key => $meta) {
        $vi = $_POST[$key . '_vi'] ?? '';
        $en = $_POST[$key . '_en'] ?? '';
        $stmt->execute([$vi, $en, $key]);
    }

    // Ảnh hero / about
    foreach (['hero_image' => 'banner', 'about_image' => 'banner'] as $imgKey => $folder) {
        $uploaded = upload_image($imgKey, $folder);
        if ($uploaded) {
            $u = $pdo->prepare("UPDATE settings SET value_vi = ?, value_en = ? WHERE setting_key = ?");
            $u->execute([$uploaded, $uploaded, $imgKey]);
        }
    }

    flash_set('Đã cập nhật cài đặt thành công.');
    redirect('settings.php');
}

$settings = get_settings($pdo);
?>

<form method="POST" enctype="multipart/form-data" class="a-card">
  <ul class="nav nav-pills mb-4" id="langTabs">
    <li class="nav-item"><button type="button" class="btn btn-admin-outline lang-tab-btn active me-2" data-lang="vi">🇻🇳 Tiếng Việt</button></li>
    <li class="nav-item"><button type="button" class="btn btn-admin-outline lang-tab-btn" data-lang="en">🇬🇧 English</button></li>
  </ul>

  <div class="lang-panel" data-lang="vi">
    <?php foreach ($fields as $key => $meta): ?>
      <div class="mb-3">
        <label class="form-label"><?= $meta['label'] ?> (VI)</label>
        <?php if ($meta['type'] === 'textarea'): ?>
          <textarea name="<?= $key ?>_vi" rows="3" class="form-control"><?= htmlspecialchars($settings[$key]['value_vi'] ?? '') ?></textarea>
        <?php else: ?>
          <input type="text" name="<?= $key ?>_vi" class="form-control" value="<?= htmlspecialchars($settings[$key]['value_vi'] ?? '') ?>">
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="lang-panel d-none" data-lang="en">
    <?php foreach ($fields as $key => $meta): ?>
      <div class="mb-3">
        <label class="form-label"><?= $meta['label'] ?> (EN)</label>
        <?php if ($meta['type'] === 'textarea'): ?>
          <textarea name="<?= $key ?>_en" rows="3" class="form-control"><?= htmlspecialchars($settings[$key]['value_en'] ?? '') ?></textarea>
        <?php else: ?>
          <input type="text" name="<?= $key ?>_en" class="form-control" value="<?= htmlspecialchars($settings[$key]['value_en'] ?? '') ?>">
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>

  <hr class="my-4">
  <h5 class="fw-bold mb-3">Hình ảnh</h5>
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Ảnh Hero (banner đầu trang)</label>
      <img src="<?= img_url($settings['hero_image']['value_vi'] ?? '') ?>" class="thumb-admin mb-2 d-block" style="width:120px;height:90px;">
      <input type="file" name="hero_image" class="form-control">
    </div>
    <div class="col-md-6">
      <label class="form-label">Ảnh mục Giới thiệu</label>
      <img src="<?= img_url($settings['about_image']['value_vi'] ?? '') ?>" class="thumb-admin mb-2 d-block" style="width:120px;height:90px;">
      <input type="file" name="about_image" class="form-control">
    </div>
  </div>

  <button type="submit" class="btn btn-admin-primary mt-4"><i class="bi bi-check-lg"></i> Lưu thay đổi</button>
</form>

<script>
document.querySelectorAll('.lang-tab-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.lang-tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const lang = btn.dataset.lang;
    document.querySelectorAll('.lang-panel').forEach(p => {
      p.classList.toggle('d-none', p.dataset.lang !== lang);
    });
  });
});
</script>

<?php require_once __DIR__ . '/includes/layout_foot.php'; ?>
