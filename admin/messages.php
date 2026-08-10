<?php
$pageTitle = 'Tin nhắn liên hệ';
require_once __DIR__ . '/includes/layout_head.php';

if (isset($_GET['mark_read'])) {
    $pdo->prepare("UPDATE contact_messages SET status = 'read' WHERE id = ? AND status = 'new'")->execute([(int)$_GET['mark_read']]);
    redirect('messages.php');
}
if (isset($_GET['mark_replied'])) {
    $pdo->prepare("UPDATE contact_messages SET status = 'replied' WHERE id = ?")->execute([(int)$_GET['mark_replied']]);
    redirect('messages.php');
}
if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM contact_messages WHERE id = ?")->execute([(int)$_GET['delete']]);
    flash_set('Đã xóa tin nhắn.');
    redirect('messages.php');
}

$messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll();
?>

<div class="a-card">
  <div class="table-responsive">
    <table class="table table-admin align-middle mb-0">
      <thead>
        <tr><th>Phụ huynh</th><th>Điện thoại</th><th>Lời nhắn</th><th>Thời gian</th><th>Trạng thái</th><th></th></tr>
      </thead>
      <tbody>
        <?php if (empty($messages)): ?>
          <tr><td colspan="6" class="text-center text-muted py-5">Chưa có tin nhắn liên hệ nào.</td></tr>
        <?php endif; ?>
        <?php foreach ($messages as $m): ?>
        <tr>
          <td class="fw-bold"><?= htmlspecialchars($m['parent_name']) ?></td>
          <td><a href="tel:<?= htmlspecialchars($m['phone']) ?>"><?= htmlspecialchars($m['phone']) ?></a></td>
          <td style="max-width:280px;"><?= nl2br(htmlspecialchars($m['message'])) ?></td>
          <td class="text-muted small"><?= date('d/m/Y H:i', strtotime($m['created_at'])) ?></td>
          <td>
            <?php
              $badgeClass = ['new' => 'badge-new', 'read' => 'badge-read', 'replied' => 'badge-replied'][$m['status']];
              $badgeLabel = ['new' => 'Mới', 'read' => 'Đã xem', 'replied' => 'Đã phản hồi'][$m['status']];
            ?>
            <span class="badge <?= $badgeClass ?>"><?= $badgeLabel ?></span>
          </td>
          <td class="text-end">
            <?php if ($m['status'] === 'new'): ?>
              <a href="?mark_read=<?= $m['id'] ?>" class="btn btn-sm btn-admin-outline" title="Đánh dấu đã xem"><i class="bi bi-eye"></i></a>
            <?php endif; ?>
            <?php if ($m['status'] !== 'replied'): ?>
              <a href="?mark_replied=<?= $m['id'] ?>" class="btn btn-sm btn-admin-outline" title="Đánh dấu đã phản hồi"><i class="bi bi-check2"></i></a>
            <?php endif; ?>
            <a href="?delete=<?= $m['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa tin nhắn này?')"><i class="bi bi-trash"></i></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once __DIR__ . '/includes/layout_foot.php'; ?>
