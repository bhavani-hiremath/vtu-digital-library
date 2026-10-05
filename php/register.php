<?php
// register.php – Student Registration (UI Only)
$message = "";
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    $message = "<p style='color:green;'>Registration successful! You can now log in.</p>";
} else if (isset($_GET['status']) && $_GET['status'] == 'usn_exists') {
    $message = "<p style='color:red;'>Error: This USN is already registered.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | VTU Library</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="auth-bg">

<div class="auth-box">
    <h2>Student Registration</h2>
    <?php echo $message; ?>

    <form method="POST" action="php/student_register_process.php">
        <div class="input-group">
            <label>Full Name</label>
            <input type="text" name="fullname" required>
        </div>
        <div class="input-group">
            <label>USN</label>
            <input type="text" name="usn" required placeholder="e.g., 1PE21CS001">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn-primary">Register</button>
    </form>

    <p class="switch-text">
        Already have an account?  
        <a href="login.php">Login</a>
    </p>
</div>

</body>
</html>
