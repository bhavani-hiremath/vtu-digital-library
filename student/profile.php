<?php
session_start();
require "../php/db.php";

if (!isset($_SESSION['student_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

$usn = $_SESSION['student_usn'];
$student = $conn->query("SELECT * FROM students WHERE usn='$usn'")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h2>My Profile</h2>

    <p><b>Name:</b> <?= $student['fullname'] ?></p>
    <p><b>USN:</b> <?= $student['usn'] ?></p>
    <p><b>Branch:</b> <?= $student['branch'] ?></p>
    <p><b>Semester:</b> <?= $student['semester'] ?></p>

    <br>
    <a href="dashboard.php">⬅ Back to Dashboard</a>
</body>
</html>