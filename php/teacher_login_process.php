<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        header("Location: ../teacher_login.php?error=empty_fields");
        exit();
    }

    $sql = "SELECT id, fullname, email, password_hash FROM teachers WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password_hash'])) {
            // Success: Set session variables and redirect
            $_SESSION['teacher_logged_in'] = true;
            $_SESSION['teacher_id'] = $row['id'];
            $_SESSION['teacher_email'] = $row['email'];
            $_SESSION['teacher_name'] = $row['fullname'];

            header("Location: ../teacher/dashboard.php"); 
            exit();
        }
    }
    // If login fails
    header("Location: ../teacher_login.php?error=invalid_credentials");
    exit();
}
?>
