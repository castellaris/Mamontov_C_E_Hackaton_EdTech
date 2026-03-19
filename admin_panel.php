<?php
session_start();
require_once 'db.php';
require_once 'includes/lang.php'; // подключаем мультиязычность

// Проверка роли
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Получаем список таблиц, исключая служебные
$tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);

// Убираем служебные таблицы (например, sqlite_sequence)
$tables = array_filter($tables, function($t) {
    return $t !== 'sqlite_sequence';
});
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
</nav>
</header>

<div class="container mt-5">
    <h2 class="mb-4"><?= $translations[$lang]['admin_panel'] ?></h2>

    <?php foreach ($tables as $table): ?>
        <div class="card mb-5">
            <div class="card-header bg-dark text-white">
                <?= $translations[$lang]['table'] ?>: <?= htmlspecialchars($table) ?>
            </div>
            <div class="card-body">
                <?php
                $rows = $pdo->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);
                if ($rows):
                ?>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <?php foreach (array_keys($rows[0]) as $col): ?>
                                <th><?= htmlspecialchars($col) ?></th>
                            <?php endforeach; ?>
                            <th><?= $translations[$lang]['actions'] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row): ?>
                            <tr>
                                <?php foreach ($row as $val): ?>
                                    <td><?= htmlspecialchars($val) ?></td>
                                <?php endforeach; ?>
                                <td>
                                    <a href="edit.php?table=<?= urlencode($table) ?>&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning"><?= $translations[$lang]['edit'] ?></a>
                                    <a href="delete.php?table=<?= urlencode($table) ?>&id=<?= $row['id'] ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('<?= $translations[$lang]['confirm_delete'] ?>')"><?= $translations[$lang]['delete'] ?></a>

                                    <?php
                                    if ($table === 'users' && $row['id'] == $_SESSION['user_id']) {
                                        echo "<script>
                                            document.querySelector('a[href=\"delete.php?table=users&id={$row['id']}\"]').addEventListener('click', function() {
                                                setTimeout(function() {
                                                    window.location.href = 'logout.php';
                                                }, 500);
                                            });
                                        </script>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p class="text-muted"><?= $translations[$lang]['no_data'] ?></p>
                <?php endif; ?>

                <a href="add.php?table=<?= urlencode($table) ?>" class="btn btn-sm btn-success"><?= $translations[$lang]['add_record'] ?></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>
