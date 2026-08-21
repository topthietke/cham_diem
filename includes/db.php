<?php
// Kết nối cơ sở dữ liệu SQLite (không cần cấu hình MySQL server)
define('DB_PATH', __DIR__ . '/../data/qbank.sqlite');

function get_db(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $isNew = !file_exists(DB_PATH);
        if (!is_dir(dirname(DB_PATH))) {
            mkdir(dirname(DB_PATH), 0777, true);
        }
        $pdo = new PDO('sqlite:' . DB_PATH);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->exec("CREATE TABLE IF NOT EXISTS questions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            category TEXT NOT NULL,
            question TEXT NOT NULL,
            answer TEXT NOT NULL,
            difficulty TEXT NOT NULL DEFAULT 'Trung bình',
            created_at TEXT DEFAULT CURRENT_TIMESTAMP,
            updated_at TEXT DEFAULT CURRENT_TIMESTAMP
        )");
        $pdo->exec("CREATE TABLE IF NOT EXISTS admins (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE NOT NULL,
            password_hash TEXT NOT NULL
        )");
        if ($isNew) {
            seed_admin($pdo);
            seed_questions($pdo);
        }
    }
    return $pdo;
}

function seed_admin(PDO $pdo): void
{
    $stmt = $pdo->prepare("INSERT INTO admins (username, password_hash) VALUES (?, ?)");
    $stmt->execute(['admin', password_hash('admin123', PASSWORD_DEFAULT)]);
}

function seed_questions(PDO $pdo): void
{
    $data = require __DIR__ . '/seed_data.php';
    $stmt = $pdo->prepare("INSERT INTO questions (category, question, answer, difficulty) VALUES (?, ?, ?, ?)");
    $pdo->beginTransaction();
    foreach ($data as $row) {
        $stmt->execute([$row['category'], $row['question'], $row['answer'], $row['difficulty'] ?? 'Trung bình']);
    }
    $pdo->commit();
}

function all_categories(): array
{
    $pdo = get_db();
    $rows = $pdo->query("SELECT DISTINCT category FROM questions ORDER BY category ASC")->fetchAll();
    return array_column($rows, 'category');
}
