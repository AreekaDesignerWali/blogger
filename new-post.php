<?php
include "config.php";
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>New Post</title>
  <style>
    body { font-family: Arial; background: #f9f9f9; }
    .box {
      max-width: 700px; margin: auto; background: white;
      padding: 30px; margin-top: 50px; border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 { color: #4CAF50; text-align: center; }
    input, textarea, select {
      width: 100%; padding: 10px; margin-top: 10px;
      border: 1px solid #ccc; border-radius: 5px;
    }
    button {
      padding: 10px 20px; margin-top: 20px; background: #4CAF50;
      border: none; color: white; border-radius: 5px;
    }
  </style>
</head>
<body>
<div class="box">
  <h2>Create New Blog Post</h2>
  <form method="POST">
    <input type="text" name="title" placeholder="Post Title" required>
    <select name="category" required>
      <option value="">Select Category</option>
      <option value="Technology">Technology</option>
      <option value="Lifestyle">Lifestyle</option>
      <option value="Business">Business</option>
      <option value="Travel">Travel</option>
    </select>
    <textarea name="content" placeholder="Write your post here..." rows="10" required></textarea>
    <button type="submit">Publish</button>
  </form>

  <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title']);
        $category = $_POST['category'];
        $content = $_POST['content'];
        $author = $_SESSION['username'];

        $stmt = $pdo->prepare("INSERT INTO posts (title, category, content, author) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $category, $content, $author]);
        echo "<script>alert('Blog published successfully!'); window.location.href='blog.php';</script>";
    }
  ?>
</div>
</body>
</html>
