<?php
session_start();
include 'config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT UserId, Password FROM Users WHERE UserName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $dbPassword);
        $stmt->fetch();

        // Use plain text comparison
        if ($password === $dbPassword) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Incorrect password.";
        }
    } else {
        $message = "User not found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cafe Camellia - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .login-container {
            max-width: 420px;
            margin: 100px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .login-header {
            text-align: center;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <div class="login-header">
            <h3 class="text-primary">☕ Café Camellia HR Login</h3>
            <p class="text-muted">Please enter your credentials</p>
        </div>

        <?php if ($message): ?>
            <div class="alert alert-danger text-center"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required placeholder="Enter your username">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Enter your password">
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>

</body>
</html>
