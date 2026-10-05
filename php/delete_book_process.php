<?php
session_start();
require "db.php";

// Ensure only admin can delete
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin_login.php");
    exit();
}

// Check book ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../admin/manage_books.php?error=missing_id");
    exit();
}

$book_id = intval($_GET['id']);


// 1) Delete related preorders first (to avoid foreign key issues)
$del_preorders = $conn->prepare("DELETE FROM preorders WHERE book_id = ?");
$del_preorders->bind_param("i", $book_id);
$del_preorders->execute();


// 2) Delete the book
$stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
$stmt->bind_param("i", $book_id);

if ($stmt->execute()) {
    header("Location: ../admin/manage_books.php?success=book_deleted");
    exit();
} else {
    header("Location: ../admin/manage_books.php?error=delete_failed");
    exit();
}

?>