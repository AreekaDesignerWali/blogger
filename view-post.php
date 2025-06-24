<?php
include "config.php";
session_start();

if (!isset($_GET['id'])) {
    die("❌ Post ID not found in URL.");
}

$id = $_GET['id'];

if (!is_numeric($id)) {
    die("❌ Post ID is not numeric.");
}

// Now fetch post
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    die("❌ Post not found for ID = $id");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo htmlspecialchars($post['title']); ?></title>
  <style>
    body { font-family: sans-serif; background: #f4f4f4; padding: 30px; }
    .post {
      background: #fff; padding: 20px; border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 800px; margin: auto;
    }
    .post h1 { color: #333; }
    .meta { font-size: 14px; color: #999; margin-bottom: 20px; }
    .content { font-size: 16px; color: #444; }
  </style>
</head>
<body>
  <div class="post">
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <div class="meta">
      Author: <b><?php echo htmlspecialchars($post['author']); ?></b><br>
      Category: <i><?php echo htmlspecialchars($post['category']); ?></i><br>
      Posted on: <?php echo htmlspecialchars($post['created_at']); ?>
    </div>
    <div class="content">
      <?php echo nl2br(htmlspecialchars($post['content'])); ?>
    </div>
  </div>
</body>
</html>
