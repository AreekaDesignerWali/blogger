<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog Home</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .header { background: #ff5722; color: white; padding: 20px; text-align: center; }
        .container { max-width: 1000px; margin: auto; padding: 20px; }
        .post { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .post h2 { margin: 0 0 10px; }
        .meta { color: #777; font-size: 14px; margin-bottom: 10px; }
        .excerpt { color: #333; }
        .filters { margin-bottom: 20px; }
        select, input[type="text"] {
            padding: 8px; margin-right: 10px; border-radius: 5px; border: 1px solid #ccc;
        }
        button {
            padding: 8px 12px; background: #ff5722; border: none; color: white; border-radius: 5px;
        }
        a.readmore {
            color: #ff5722; text-decoration: none; font-weight: bold; display: inline-block; margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>My Blog</h1>
    <p>Welcome to our Blogger.com Clone</p>
</div>

<div class="container">
    <form method="GET" class="filters">
        <select name="category">
            <option value="">All Categories</option>
            <option <?= isset($_GET['category']) && $_GET['category'] === 'Technology' ? 'selected' : '' ?>>Technology</option>
            <option <?= isset($_GET['category']) && $_GET['category'] === 'Lifestyle' ? 'selected' : '' ?>>Lifestyle</option>
            <option <?= isset($_GET['category']) && $_GET['category'] === 'Business' ? 'selected' : '' ?>>Business</option>
            <option <?= isset($_GET['category']) && $_GET['category'] === 'Travel' ? 'selected' : '' ?>>Travel</option>
        </select>
        <input type="text" name="search" placeholder="Search posts..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit">Filter</button>
    </form>

    <?php
    $where = [];
    $params = [];

    if (!empty($_GET['category'])) {
        $where[] = "category = ?";
        $params[] = $_GET['category'];
    }

    if (!empty($_GET['search'])) {
        $where[] = "(title LIKE ? OR content LIKE ?)";
        $searchTerm = '%' . $_GET['search'] . '%';
        $params[] = $searchTerm;
        $params[] = $searchTerm;
    }

    $sql = "SELECT * FROM posts";
    if (!empty($where)) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }
    $sql .= " ORDER BY created_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $posts = $stmt->fetchAll();

    if ($posts) {
        foreach ($posts as $post) {
            echo "<div class='post'>
                    <h2>" . htmlspecialchars($post['title']) . "</h2>
                    <div class='meta'>By <strong>" . htmlspecialchars($post['author']) . "</strong> in <em>" . $post['category'] . "</em> | " . date('F j, Y', strtotime($post['created_at'])) . "</div>
                    <div class='excerpt'>" . substr(strip_tags($post['content']), 0, 200) . "...</div>
                    <a class='readmore' href='view-post.php?id={$post['id']}'>Read More →</a>
                  </div>";
        }
    } else {
        echo "<p>No posts found.</p>";
    }
    ?>
</div>
</body>
</html>
