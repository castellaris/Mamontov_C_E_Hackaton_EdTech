<?php
session_start();
require_once 'db.php';
require_once 'includes/lang.php'; // подключаем мультиязычность

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action   = $_POST['action'] ?? '';
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $role     = $_POST['role'] ?? 'user'; // роль по умолчанию

    if ($action === 'login') {
        if ($username && $password) {
            $stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE username = :username LIMIT 1");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && $password === $user['password']) {
                $_SESSION['user_id']  = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role']     = $user['role'];
                header("Location: cabinet.php");
                exit;
            } else {
                $error = $translations[$lang]['error_invalid_login'];
            }
        } else {
            $error = $translations[$lang]['error_fill_fields'];
        }
    } elseif ($action === 'register') {
        if ($username && $password && $email) {
            if (strlen($password) < 6) {
                $error = $translations[$lang]['error_short_password'];
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = $translations[$lang]['error_invalid_email'];
            } else {
                $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
                $stmt->execute(['username' => $username]);
                if ($stmt->fetch()) {
                    $error = $translations[$lang]['error_user_exists'];
                } else {
                    $stmt = $pdo->prepare("INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)");
                    $stmt->execute([
                        'username' => $username,
                        'password' => $password,
                        'email'    => $email,
                        'role'     => $role
                    ]);

                    $_SESSION['user_id']  = $pdo->lastInsertId();
                    $_SESSION['username'] = $username;
                    $_SESSION['role']     = $role;

                    header("Location: cabinet.php");
                    exit;
                }
            }
        } else {
            $error = $translations[$lang]['error_fill_fields'];
        }
    }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
</nav></header>

<div class="container mt-5">
    <h2><?= $translations[$lang]['auth_title'] ?></h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" id="authForm">
        <div class="mb-3">
            <label class="form-label"><?= $translations[$lang]['username'] ?></label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label"><?= $translations[$lang]['password'] ?></label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <!-- Дополнительные поля для регистрации -->
        <div id="registerFields" style="display:none;">
            <div class="mb-3">
                <label class="form-label"><?= $translations[$lang]['email'] ?></label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label"><?= $translations[$lang]['role'] ?></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" value="user" checked>
                    <label class="form-check-label"><?= $translations[$lang]['role_user'] ?></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" value="psychologist">
                    <label class="form-check-label"><?= $translations[$lang]['role_psychologist'] ?></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" value="admin">
                    <label class="form-check-label"><?= $translations[$lang]['role_admin'] ?></label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label"><?= $translations[$lang]['action'] ?></label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="action" value="login" required onclick="toggleFields('login')">
                <label class="form-check-label"><?= $translations[$lang]['action_login'] ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="action" value="register" required onclick="toggleFields('register')">
                <label class="form-check-label"><?= $translations[$lang]['action_register'] ?></label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><?= $translations[$lang]['continue'] ?></button>
    </form>
</div>

<script>
function toggleFields(action) {
    const regFields = document.getElementById('registerFields');
    if (action === 'register') {
        regFields.style.display = 'block';
    } else {
        regFields.style.display = 'none';
    }
}
</script>

<?php include 'includes/footer.php'; ?>
