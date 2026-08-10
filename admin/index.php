<?php
$pageTitle = 'Tổng quan';
require_once __DIR__ . '/includes/layout_head.php';

$countPrograms   = $pdo->query("SELECT COUNT(*) FROM age_groups")->fetchColumn();
$countTeachers   = $pdo->query("SELECT COUNT(*) FROM teachers")->fetchColumn();
$countActivities = $pdo->query("SELECT COUNT(*) FROM activities")->fetchColumn();
$countUnread     = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'new'")->fetchColumn();
$recentMessages  = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 6")->fetchAll();

$cards = [
    ['icon' => 'bi-flower1', 'color' => '#FF8A5B', 'value' => $countPrograms, 'label' => 'Chương trình học'],
    ['icon' => 'bi-people-fill', 'color' => '#6FB7E0', 'value' => $countTeachers, 'label' => 'Giáo viên'],
    ['icon' => 'bi-image', 'color' => '#8AD5C0', 'value' => $countActivities, 'label' => 'Ảnh hoạt động'],
    ['icon' => 'bi-envelope-fill', 'color' => '#F4A53A', 'value' => $countUnread, 'label' => 'Tin nhắn chưa đọc'],
];
?>

<div class="row g-3 mb-4">
  <?php foreach ($cards as $c): ?>
  <div class="col-6 col-lg-3">
    <div class="a-card a-stat-card">
      <div class="a-stat-icon" style="background:<?= $c['color'] ?>"><i class="bi <?= $c['icon'] ?>"></i></div>
      <div>
        <div class="a-stat-value"><?= (int)$c['value'] ?></div>
        <div class="a-stat-label"><?= $c['label'] ?></div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<div class="a-card">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 fw-bold"><i class="bi bi-envelope-open me-2"></i>Đăng ký / tin nhắn mới nhất</h5>
    <a href="messages.php" class="small fw-bold text-decoration-none">Xem tất cả &rarr;</a>
  </div>
  <div class="table-responsive">
    <table class="table table-admin align-middle mb-0">
      <thead>
        <tr>
          <th>Phụ huynh</th>
          <th>Điện thoại</th>
          <th>Lời nhắn</th>
          <th>Thời gian</th>
          <th>Trạng thái</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($recentMessages)): ?>
          <tr><td colspan="5" class="text-center text-muted py-4">Chưa có tin nhắn nào.</td></tr>
        <?php endif; ?>
        <?php foreach ($recentMessages as $m): ?>
        <tr>
          <td class="fw-bold"><?= htmlspecialchars($m['parent_name']) ?></td>
          <td><?= htmlspecialchars($m['phone']) ?></td>
          <td class="text-truncate" style="max-width:260px;"><?= htmlspecialchars($m['message']) ?></td>
          <td class="text-muted small"><?= date('d/m/Y H:i', strtotime($m['created_at'])) ?></td>
          <td>
            <?php
              $badgeClass = ['new' => 'badge-new', 'read' => 'badge-read', 'replied' => 'badge-replied'][$m['status']];
              $badgeLabel = ['new' => 'Mới', 'read' => 'Đã xem', 'replied' => 'Đã phản hồi'][$m['status']];
            ?>
            <span class="badge <?= $badgeClass ?>"><?= $badgeLabel ?></span>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once __DIR__ . '/includes/layout_foot.php'; ?>
