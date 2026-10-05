<?php
session_start();
require 'db.php'; // Includes your configured database connection ($conn)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $usn = trim($_POST['usn']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if USN already exists
    $stmt_check = $conn->prepare("SELECT id FROM students WHERE usn = ?");
    $stmt_check->bind_param("s", $usn);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        header("Location: ../register.php?status=usn_exists");
        exit();
    }
    $stmt_check->close();

    // Hash the password securely
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new student record
    $sql = "INSERT INTO students (fullname, usn, email, password_hash) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fullname, $usn, $email, $password_hash);

    if ($stmt->execute()) {
        header("Location: ../register.php?status=success");
        exit();
    } else {
        // Handle database error
        header("Location: ../register.php?status=error");
        exit();
    }
    $stmt->close();
}
$conn->close();
?>
