<?php
// login.php – Student Login (UI Only)
$error = "";
if (isset($_GET['error'])) {
    $error = "Invalid Login Credentials!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | VTU Library</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="auth-bg">

<div class="auth-box">
    <h2>Welcome Back</h2>
    <p class="subtitle">Login to continue</p>
    
    <?php if (!empty($error)): ?>
        <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="php/student_login_process.php">
        <div class="input-group">
            <label>USN</label>
            <input type="text" name="usn" required placeholder="Enter your USN">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Enter your password">
        </div>

        <button type="submit" class="btn-primary">Login</button>
    </form>

    <p class="switch-text">
        Don't have an account?  
        <a href="register.php">Register</a>
    </p>
</div>

</body>
</html>
