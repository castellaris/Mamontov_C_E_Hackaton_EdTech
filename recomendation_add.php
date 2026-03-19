<?php
session_start();
require_once 'db.php';
require_once 'includes/lang.php'; // подключаем мультиязычность

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Получаем рекомендации для текущего пользователя
$stmt = $pdo->prepare("SELECT id, from_user, recomendation, to_user 
                       FROM recomendations 
                       WHERE to_user = :username 
                       ORDER BY id DESC");
$stmt->execute(['username' => $username]);
$recomendations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
</nav>
</header>

<div class="container mt-5">
    <h2><?= $translations[$lang]['your_recommendations'] ?></h2>

    <?php if (!empty($recomendations)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th><?= $translations[$lang]['from_user'] ?></th>
                    <th><?= $translations[$lang]['recommendation'] ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recomendations as $rec): ?>
                    <tr>
                        <td><?= htmlspecialchars($rec['id']) ?></td>
                        <td><?= htmlspecialchars($rec['from_user']) ?></td>
                        <td><?= nl2br(htmlspecialchars($rec['recomendation'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info"><?= $translations[$lang]['no_recommendations'] ?></div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
