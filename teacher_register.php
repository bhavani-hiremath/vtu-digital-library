<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="auth-box"> <!-- Used auth-box for consistent styling -->
    <h2>Teacher Registration</h2>

    <form action="php/teacher_register_process.php" method="POST">

        <!-- NAME -->
        <div class="input-group">
            <label>Full Name</label>
            <input type="text" name="fullname" required>
        </div>

        <!-- EMAIL -->
        <div class="input-group">
            <label>Email (login username)</label>
            <input type="email" name="email" required>
        </div>

        <!-- PASSWORD -->
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn-primary">Register</button>

        <p class="back-link">
            Already registered? <a href="teacher_login.php">Teacher Login</a>
        </p>

        <p class="back-link">
            <a href="index.php">← Back to Home</a>
        </p>

    </form>
</div>

</body>
</html>
