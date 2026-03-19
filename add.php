<?php
session_start();
require_once 'db.php';

// Проверка роли администратора
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$table = $_GET['table'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Берём только те поля, что пришли из формы (без question_id)
    $columns = array_keys($_POST);
    $placeholders = array_map(fn($c) => ':' . $c, $columns);

    $sql = "INSERT INTO $table (" . implode(',', $columns) . ") VALUES (" . implode(',', $placeholders) . ")";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($_POST);

    header("Location: admin_panel.php");
    exit;
}

// Получаем список колонок таблицы
$columns = $pdo->query("PRAGMA table_info($table)")->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '/includes/header.php'; ?>
<?php include '/includes/navigation.php'; ?>
</nav></header>

<div class="container mt-5">
    <h2>Добавить запись в <?= htmlspecialchars($table) ?></h2>
    <form method="post" class="form">
        <?php foreach ($columns as $col): ?>
            <?php 
            // Исключаем id и question_id (они автогенерируются)
            if ($col['name'] !== 'id' && $col['name'] !== 'question_id'): 
            ?>
                <div class="mb-3">
                    <label class="form-label"><?= htmlspecialchars($col['name']) ?></label>
                    <input type="text" name="<?= htmlspecialchars($col['name']) ?>" class="form-control">
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
</div>

<?php include '/includes/footer.php'; ?>
