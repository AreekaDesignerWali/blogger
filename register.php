<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Register</title>
    <style>
        body { font-family: Arial; background: #f7f7f7; }
        .box {
            max-width: 400px; margin: auto; background: white;
            padding: 30px; border-radius: 8px; margin-top: 60px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 { color: #ff5722; text-align: center; }
        input {
            width: 100%; padding: 10px; margin: 10px 0;
            border: 1px solid #ccc; border-radius: 5px;
        }
        button {
            width: 100%; padding: 10px; background: #ff5722;
            color: white; border: none; border-radius: 5px;
        }
        .msg { color: red; text-align: center; }
    </style>
</head>
<body>
<div class="box">
    <h2>Register</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $password]);
            echo "<script>alert('Registration successful'); window.location.href='login.php';</script>";
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                echo "<div class='msg'>Username or email already exists.</div>";
            } else {
                echo "<div class='msg'>Error: " . $e->getMessage() . "</div>";
            }
        }
    }
    ?>
</div>
</body>
</html>
