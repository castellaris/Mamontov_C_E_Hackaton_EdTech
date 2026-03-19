<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$table = $_GET['table'] ?? '';
$id = $_GET['id'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $columns = array_keys($_POST);
    $set = implode(',', array_map(fn($c) => "$c = :$c", $columns));
    $sql = "UPDATE $table SET $set WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $_POST['id'] = $id;
    $stmt->execute($_POST);
    header("Location: admin_panel.php");
    exit;
}

$row = $pdo->query("SELECT * FROM $table WHERE id = " . intval($id))->fetch(PDO::FETCH_ASSOC);
?>

<?php include '/includes/header.php'; ?>
<?php include '/includes/navigation.php'; ?>
</nav></header>

<div class="container mt-5">
    <h2>Редактировать запись в <?= htmlspecialchars($table) ?></h2>
    <form method="post" class="form">
        <?php foreach ($row as $col => $val): ?>
            <?php if ($col !== 'id'): ?>
                <div class="mb-3">
                    <label class="form-label"><?= htmlspecialchars($col) ?></label>
                    <input type="text" name="<?= htmlspecialchars($col) ?>" value="<?= htmlspecialchars($val) ?>" class="form-control">
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-warning">Обновить</button>
    </form>
</div>

<?php include '/includes/footer.php'; ?>
