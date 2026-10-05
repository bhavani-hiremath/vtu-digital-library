<?php
session_start();
require "db.php";

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Fetch admin
    $stmt = $conn->prepare("SELECT id, fullname, email, password_hash FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();

    if ($admin && password_verify($password, $admin['password_hash'])) {

        // STORE SESSION
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['fullname'];

        header("Location: ../admin/admin_dashboard.php");
        exit();
    } 
    else {
        // LOGIN FAILED
        header("Location: ../admin_login.php?error=1");
        exit();
    }
}
?>