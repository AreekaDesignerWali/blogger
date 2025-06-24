<?php
include "db.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('No post ID provided.'); window.location.href = 'index.php';</script>";
    exit;
}

$id = intval($_GET['id']);
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$id]);

echo "<script>window.location.href = 'index.php';</script>";
?>
