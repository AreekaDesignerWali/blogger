<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body { font-family: Arial; background: #e3f2fd; }
    .container {
      max-width: 700px; margin: auto; margin-top: 60px; padding: 30px;
      background: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 { color: #2196f3; }
    a {
      display: inline-block; margin-top: 20px; text-decoration: none;
      background: #2196f3; color: white; padding: 10px 15px; border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <p>You are logged in. Use the options below:</p>
    <a href="new-post.php">Create New Post</a>
    <a href="logout.php" style="background:#f44336; margin-left:10px;">Logout</a>
  </div>
</body>
</html>
