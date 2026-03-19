<?php
session_start();
require_once 'db.php';
require_once 'includes/lang.php'; // подключаем мультиязычность

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Получаем список курсов
$stmt = $pdo->query("SELECT id, course FROM courses ORDER BY id ASC");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>

<div class="container courses-page">
    <h2 class="page-title"><?= $translations[$lang]['available_courses'] ?></h2>

    <?php if (!empty($courses)): ?>
        <ul class="list-group course-list">
            <?php foreach ($courses as $c): ?>
                <li class="list-group-item course-item">
                    <?= htmlspecialchars($c['course']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="alert alert-info no-courses"><?= $translations[$lang]['no_courses'] ?></div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
