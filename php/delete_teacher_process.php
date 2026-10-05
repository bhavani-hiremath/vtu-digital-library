<?php
session_start();
require "../php/db.php";

// Only admin can delete teachers
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin_login.php");
    exit();
}

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../admin/view_teachers.php?error=missing_id");
    exit();
}

$teacher_id = intval($_GET['id']);

// --- OPTIONAL ---
// If teacher is related to books in future, delete assigned books here
// Example: DELETE FROM assigned_books WHERE teacher_id = ?

// Delete teacher
$stmt = $conn->prepare("DELETE FROM teachers WHERE id = ?");
$stmt->bind_param("i", $teacher_id);

if ($stmt->execute()) {
    header("Location: ../admin/view_teachers.php?success=teacher_deleted");
    exit();
} else {
    header("Location: ../admin/view_teachers.php?error=delete_failed");
    exit();
}

?>