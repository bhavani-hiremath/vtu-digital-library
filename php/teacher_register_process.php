<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Hash the password securely
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the statement
    $sql = "INSERT INTO teachers (fullname, email, password_hash) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $fullname, $email, $password_hash);

    if ($stmt->execute()) {
        // Redirect to login page with success message
        header("Location: ../teacher_login.php?registration=success");
        exit();
    } else {
        // Redirect back to registration with an error
        header("Location: ../teacher_register.php?error=registration_failed");
        exit();
    }
    $stmt->close();
}
$conn->close();
?>
