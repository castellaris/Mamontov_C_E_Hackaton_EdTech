<?php
session_start();
require_once 'db.php';

// Проверка роли
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$table = $_GET['table'] ?? '';
$id    = $_GET['id'] ?? '';

if ($table && $id) {
    // Удаляем запись
    $stmt = $pdo->prepare("DELETE FROM $table WHERE id = :id");
    $stmt->execute(['id' => $id]);

    // Если удаляется текущий админ из таблицы users
    if ($table === 'users' && $id == $_SESSION['user_id']) {
        // Сразу выходим через logout.php
        header("Location: logout.php");
        exit;
    }

    // Возврат обратно в админ-панель
    header("Location: admin_panel.php");
    exit;
} else {
    echo "Некорректный запрос.";
}
