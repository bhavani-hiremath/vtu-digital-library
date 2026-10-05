<?php
session_start();
require "../php/db.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: view_students.php?error=missing_id");
    exit();
}

$student_id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
$stmt->bind_param("i", $student_id);

if ($stmt->execute()) {
    header("Location: view_students.php?deleted=1");
} else {
    header("Location: view_students.php?error=1");
}

$stmt->close();
$conn->close();
?>