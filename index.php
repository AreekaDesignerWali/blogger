<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Blogger Clone</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f5f5f5; }
        header { background: #ff5722; padding: 20px; color: white; text-align: center; }
        .container { max-width: 900px; margin: auto; padding: 20px; }
        .post { background: white; margin-bottom: 20px; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .post h2 { margin: 0 0 10px; }
        .post p { color: #666; }
        .search-bar { margin-bottom: 20px; }
        input[type="text"] { padding: 10px; width: 80%; border: 1px solid #ccc; border-radius: 5px; }
        button { padding: 10px 15px; background: #ff5722; border: none; color: white; border-radius: 5px; cursor: pointer; }
        nav { margin-top: 20px; }
        nav a { margin: 0 10px; text-decoration: none; color: #333; }
    </style>
    <script>
        function goToPage(page) {
            window.location.href = page;
        }
    </script>
</head>
<body>
    <header>
        <h1>Blogger Clone</h1>
        <button onclick="goToPage('create.php')">Create Post</button>
    </header>
    <div class="container">
        <div class="search-bar">
            <input type="text" placeholder="Search posts..." oninput="searchPosts(this.value)">
        </div>
        <nav>
            <a href="#">Technology</a><a href="#">Lifestyle</a><a href="#">Business</a><a href="#">Travel</a>
        </nav>
        <?php
        $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
        while ($row = $stmt->fetch()) {
            echo "<div class='post'>";
            echo "<h2 onclick=\"goToPage('view.php?id={$row['id']}')\" style='cursor:pointer'>{$row['title']}</h2>";
            echo "<p>{$row['excerpt']}</p>";
            echo "<small>By {$row['author']} on " . date("F j, Y", strtotime($row['created_at'])) . "</small>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
