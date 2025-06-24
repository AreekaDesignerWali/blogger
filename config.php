<?php
$host = 'localhost';
$dbname = 'db8lv3j8h8ynyk';
$user = 'uc7ggok7oyoza';
$pass = 'gqypavorhbbc';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
