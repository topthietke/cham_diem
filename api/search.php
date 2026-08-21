<?php
require_once __DIR__ . '/../includes/db.php';
header('Content-Type: application/json; charset=utf-8');

$pdo = get_db();
$keyword = trim($_GET['q'] ?? '');
$category = trim($_GET['category'] ?? '');
$difficulty = trim($_GET['difficulty'] ?? '');

$sql = "SELECT id, category, question, answer, difficulty FROM questions WHERE 1=1";
$params = [];

if ($keyword !== '') {
    $sql .= " AND (question LIKE :kw OR answer LIKE :kw2)";
    $params[':kw'] = '%' . $keyword . '%';
    $params[':kw2'] = '%' . $keyword . '%';
}
if ($category !== '' && $category !== 'all') {
    $sql .= " AND category = :cat";
    $params[':cat'] = $category;
}
if ($difficulty !== '' && $difficulty !== 'all') {
    $sql .= " AND difficulty = :diff";
    $params[':diff'] = $difficulty;
}

$sql .= " ORDER BY category ASC, id ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll();

echo json_encode([
    'success' => true,
    'total' => count($rows),
    'data' => $rows,
]);
