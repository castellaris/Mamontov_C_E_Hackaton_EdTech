<?php
session_start();
require_once 'db.php';
require_once 'lang.php'; // общий словарь переводов

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'] ?? 'user';
$username = $_SESSION['username'] ?? 'Гость';
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
</nav>
</header>

<div class="container mt-5">
    <h2>
        <?= $translations[$lang]['profile'] ?>: 
        <?= htmlspecialchars($username) ?> 
        (<?= htmlspecialchars($role) ?>)
    </h2>

    <p class="lead">
        <?= ($role === 'user') 
            ? "Добро пожаловать! Здесь вы можете пройти тесты, получить рекомендации и обучающие курсы." 
            : (($role === 'psychologist') 
                ? "Добро пожаловать! Здесь вы можете просматривать результаты тестов и добавлять курсы и рекомендации." 
                : "Добро пожаловать! Здесь вы можете управлять платформой и пользователями."); ?>
    </p>

    <nav class="nav flex-column mt-4">
        <?php if ($role === 'user'): ?>
            <a class="nav-link" href="tests.php"><?= $translations[$lang]['tests'] ?></a>
            <a class="nav-link" href="recomendation_results.php"><?= $translations[$lang]['results'] ?></a>
            <a class="nav-link" href="courses.php"><?= $translations[$lang]['courses'] ?></a>
        <?php elseif ($role === 'psychologist'): ?>
            <a class="nav-link" href="test_results.php"><?= $translations[$lang]['results'] ?></a>
            <a class="nav-link" href="add_course.php"><?= $translations[$lang]['add'] ?> <?= $translations[$lang]['courses'] ?></a>
            <a class="nav-link" href="recomendations_add.php"><?= $translations[$lang]['add'] ?> <?= $translations[$lang]['results'] ?></a>
        <?php elseif ($role === 'admin'): ?>
            <a class="nav-link" href="admin_panel.php"><?= $translations[$lang]['admin'] ?></a>
        <?php endif; ?>
    </nav>

    <!-- Пример кнопок с мультиязычностью -->
    <div class="btn-group mt-4">
        <button class="btn btn-success"><?= $translations[$lang]['add'] ?></button>
        <button class="btn btn-danger"><?= $translations[$lang]['delete'] ?></button>
        <button class="btn btn-warning"><?= $translations[$lang]['edit'] ?></button>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
