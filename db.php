<?php
// db.php — подключение к SQLite

try {
    // Указываем путь к файлу базы данных
    $pdo = new PDO('sqlite:' . __DIR__ . '/mydatabase.db');

    // Включаем режим ошибок и исключений
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Включаем поддержку внешних ключей
    $pdo->exec("PRAGMA foreign_keys = ON");

} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
