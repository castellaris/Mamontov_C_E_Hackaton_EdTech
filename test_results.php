<?php
session_start();
require_once 'db.php';
require_once 'includes/lang.php'; // подключаем мультиязычность

if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}

// Словарь: ключ = идентификатор теста, значение = таблица
$testsMap = [
    'anxiety'   => 'anxiety_test',
    'burnout'   => 'burnout_test',
    'emotional' => 'emotional_state_test',
    'motivation'=> 'motivation_test',
    'stress'    => 'stress_test'
];

// Получаем выбранный тест
$selectedTest = $_GET['test'] ?? '';
$table = $testsMap[$selectedTest] ?? '';

$data = [];
$columns = [];
$error = '';

if ($table) {
    try {
        $stmt = $pdo->query("SELECT * FROM $table");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $columns = $pdo->query("PRAGMA table_info($table)")->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $error = $translations[$lang]['error_general'] . " " . $e->getMessage();
    }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
</nav></header>

<div class="container mt-5">
    <h2 class="mb-4"><?= $translations[$lang]['test_results'] ?></h2>

    <!-- Форма выбора теста -->
    <form method="get" class="mb-4">
        <label for="test" class="form-label"><?= $translations[$lang]['choose_test'] ?></label>
        <select name="test" id="test" class="form-select" onchange="this.form.submit()">
            <option value=""><?= $translations[$lang]['select_placeholder'] ?></option>
            <option value="anxiety"   <?= ($selectedTest==='anxiety')?'selected':'' ?>><?= $translations[$lang]['test_anxiety'] ?></option>
            <option value="burnout"   <?= ($selectedTest==='burnout')?'selected':'' ?>><?= $translations[$lang]['test_burnout'] ?></option>
            <option value="emotional" <?= ($selectedTest==='emotional')?'selected':'' ?>><?= $translations[$lang]['test_emotional'] ?></option>
            <option value="motivation"<?= ($selectedTest==='motivation')?'selected':'' ?>><?= $translations[$lang]['test_motivation'] ?></option>
            <option value="stress"    <?= ($selectedTest==='stress')?'selected':'' ?>><?= $translations[$lang]['test_stress'] ?></option>
        </select>
    </form>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($table && $data): ?>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <?php foreach ($columns as $col): ?>
                        <th><?= htmlspecialchars($col['name']) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <?php if (!empty($row['response']) && !empty($row['who_responsed'])): ?>
                        <tr>
                            <?php foreach ($row as $val): ?>
                                <td><?= htmlspecialchars($val) ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($selectedTest): ?>
        <p class="text-muted"><?= $translations[$lang]['no_data'] ?></p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
