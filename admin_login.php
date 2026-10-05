<?php
session_start();

if (isset($_GET["error"])) {
    $error = "Invalid admin email or password!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="auth-bg">

<div class="auth-box">
    <h2>Admin Login</h2>

    <?php if (!empty($error)) : ?>
        <p class="error-message" style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="php/admin_login_process.php">
        <div class="input-group">
            <label>Admin Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn-primary">Login</button>
    </form>

    <p class="back-link">
        <a href="index.php">← Back to Home</a>
    </p>
</div>

</body>
</html>