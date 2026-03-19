<?php
session_start();
require_once 'db.php';
require_once 'includes/lang.php'; // подключаем словарь переводов
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
</nav>
</header>

<div class="container main-page">
    <div class="text-center welcome-block">
        <h1 class="page-title"><?= $translations[$lang]['welcome_title'] ?></h1>
        <p class="lead intro-text">
            <?= $translations[$lang]['welcome_text'] ?>
        </p>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="login.php" class="btn btn-primary btn-login"><?= $translations[$lang]['login_register'] ?></a>
        <?php else: ?>
            <a href="cabinet.php" class="btn btn-success btn-cabinet"><?= $translations[$lang]['go_to_cabinet'] ?></a>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
