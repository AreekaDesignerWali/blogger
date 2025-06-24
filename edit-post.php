<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; }
        .container { max-width: 700px; margin: auto; margin-top: 50px; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #ff5722; }
        input, textarea, select {
            width: 100%; padding: 10px; margin-top: 10px; border: 1px solid #ccc; border-radius: 5px;
        }
        button {
            margin-top: 15px; padding: 10px 20px; background: #ff5722; color: white; border: none; border-radius: 5px; cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Blog Post</h2>
<?php
if (!isset($_GET['id'])) {
    echo "<p>No post ID provided.</p>";
    exit;
}
$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    echo "<p>Post not found.</p>";
    exit;
}
?>
    <form method="POST">
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
        <input type="text" name="author" value="<?= htmlspecialchars($post['author']) ?>" required>
        <select name="category" required>
            <option <?= $post['category'] === 'Technology' ? 'selected' : '' ?>>Technology</option>
            <option <?= $post['category'] === 'Lifestyle' ? 'selected' : '' ?>>Lifestyle</option>
            <option <?= $post['category'] === 'Business' ? 'selected' : '' ?>>Business</option>
            <option <?= $post['category'] === 'Travel' ? 'selected' : '' ?>>Travel</option>
        </select>
        <textarea name="content" rows="10" required><?= htmlspecialchars($post['content']) ?></textarea>
        <button type="submit">Update Post</button>
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title']);
    $author = htmlspecialchars($_POST['author']);
    $category = htmlspecialchars($_POST['category']);
    $content = htmlspecialchars($_POST['content']);

    $stmt = $pdo->prepare("UPDATE posts SET title = ?, author = ?, category = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $author, $category, $content, $id]);

    echo "<script>window.location.href = 'view-post.php?id=$id';</script>";
}
?>
</div>
</body>
</html>
