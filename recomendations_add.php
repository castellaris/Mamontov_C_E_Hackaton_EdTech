<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Проверка роли (только психолог может добавлять рекомендации)
$role = $_SESSION['role'] ?? 'user';
if ($role !== 'psychologist') {
    die("У вас нет прав для добавления рекомендаций.");
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to_user = trim($_POST['to_user']);
    $recomendation = trim($_POST['recomendation']);
    $from_user = $_SESSION['username'];

    if (!empty($to_user) && !empty($recomendation)) {
        // Проверим, существует ли пользователь, которому адресована рекомендация
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->execute(['username' => $to_user]);
        $user_exists = $stmt->fetch();

        if ($user_exists) {
            $stmt = $pdo->prepare("INSERT INTO recomendations (from_user, recomendation, to_user) 
                                   VALUES (:from_user, :recomendation, :to_user)");
            try {
                $stmt->execute([
                    'from_user' => $from_user,
                    'recomendation' => $recomendation,
                    'to_user' => $to_user
                ]);
                $success = "Рекомендация успешно добавлена.";
            } catch (Exception $e) {
                $error = "Ошибка при добавлении: " . $e->getMessage();
            }
        } else {
            $error = "Пользователь с таким именем не найден.";
        }
    } else {
        $error = "Заполните все поля.";
    }
}
?>

<?php include '/includes/header.php'; ?>
<?php include '/includes/navigation.php'; ?>
</nav>
</header>

<div class="container mt-5">
    <h2>Добавить рекомендацию</h2>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="to_user" class="form-label">Кому (логин пользователя)</label>
            <input type="text" name="to_user" id="to_user" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="recomendation" class="form-label">Текст рекомендации</label>
            <textarea name="recomendation" id="recomendation" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>

<?php include '/includes/footer.php'; ?>
