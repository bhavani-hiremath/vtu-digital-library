<?php
session_start();
require "db.php";  // Correct path

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usn = trim($_POST['usn']);
    $password = trim($_POST['password']);

    if (empty($usn) || empty($password)) {
        header("Location: ../login.php?error=empty_fields");
        exit();
    }

    // Fetch student by USN
    $sql = "SELECT id, fullname, usn, password_hash 
            FROM students 
            WHERE usn = ? 
            LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usn);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $student = $result->fetch_assoc();

        // Verify password with stored hash
        if (password_verify($password, $student['password_hash'])) {

            // Set session variables
            $_SESSION['student_logged_in'] = true;
            $_SESSION['student_id'] = $student['id'];
            $_SESSION['student_usn'] = $student['usn'];
            $_SESSION['student_name'] = $student['fullname'];

            header("Location: ../student/dashboard.php");
            exit();
        }
    }

    // If login fails
    header("Location: ../login.php?error=invalid_credentials");
    exit();
}
?>