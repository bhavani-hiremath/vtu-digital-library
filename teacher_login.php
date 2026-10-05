<?php
session_start();
// db.php require statement moved to the process file for cleaner UI file
$error = "";
if (isset($_GET['error'])) {
    $error = "Invalid Login Credentials!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Login | VTU Library</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="auth-bg">

<div class="auth-box">

    <h2>Teacher Login</h2>
    <p class="subtitle">Login using your registered email</p>

    <?php if (!empty($error)): ?>
        <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="php/teacher_login_process.php" method="POST">

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="Enter your email">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Enter password">
        </div>

        <button type="submit" class="btn-primary">Login</button>
    </form>

    <p class="switch-text">
        Not registered? 
        <a href="teacher_register.php">Create an account</a>
    </p>

    <p class="back-link">
        <a href="index.php">← Back to Home</a>
    </p>

</div>

</body>
</html>
