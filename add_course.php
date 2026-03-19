<?php
session_start();
require_once 'db.php';
require_once 'includes/lang.php'; // подключаем мультиязычность

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Проверка роли (только админ или психолог могут добавлять курсы)
$role = $_SESSION['role'] ?? 'user';
if ($role !== 'admin' && $role !== 'psychologist') {
    die($translations[$lang]['no_permission']);
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course = trim($_POST['course']);

    if (!empty($course)) {
        $stmt = $pdo->prepare("INSERT INTO courses (course) VALUES (:course)");
        try {
            $stmt->execute(['course' => $course]);
            $success = $translations[$lang]['course_added'];
        } catch (Exception $e) {
            $error = $translations[$lang]['course_add_error'] . " " . $e->getMessage();
        }
    } else {
        $error = $translations[$lang]['enter_course_name'];
    }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
</nav>
</header>

<div class="container mt-5">
    <h2><?= $translations[$lang]['add_course_title'] ?></h2>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="course" class="form-label"><?= $translations[$lang]['course_name'] ?></label>
            <input type="text" name="course" id="course" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary"><?= $translations[$lang]['add'] ?></button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
