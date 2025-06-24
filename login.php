<?php include "config.php"; session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    body { font-family: Arial; background: #f5f5f5; }
    .box {
      max-width: 400px; margin: auto; background: white;
      padding: 30px; border-radius: 10px; margin-top: 80px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 { color: #2196F3; text-align: center; }
    input {
      width: 100%; padding: 10px; margin: 10px 0;
      border: 1px solid #ccc; border-radius: 5px;
    }
    button {
      width: 100%; padding: 10px; background: #2196F3;
      color: white; border: none; border-radius: 5px;
    }
    .msg { color: red; text-align: center; }
  </style>
</head>
<body>
<div class="box">
  <h2>Login</h2>
  <form method="POST">
    <input type="text" name="username" placeholder="Username or Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
  <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo "<script>window.location.href='dashboard.php';</script>";
        } else {
            echo "<div class='msg'>Invalid username or password.</div>";
        }
    }
  ?>
</div>
</body>
</html>
