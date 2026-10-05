<?php
session_start();
require "db.php";

// Only admin can update books
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin_login.php");
    exit();
}

// Check required fields
if (!isset($_POST['id'], $_POST['title'], $_POST['author'], $_POST['branch'], $_POST['available_count'])) {
    die("Missing fields");
}

$book_id = intval($_POST['id']);
$title = trim($_POST['title']);
$author = trim($_POST['author']);
$branch = trim($_POST['branch']);
$available_count = intval($_POST['available_count']);
$download_link = trim($_POST['download_link'] ?? "");

// Prepare update query
$stmt = $conn->prepare("UPDATE books SET title=?, author=?, branch=?, available_count=?, download_link=? WHERE id=?");
$stmt->bind_param("sssisi", $title, $author, $branch, $available_count, $download_link, $book_id);

if ($stmt->execute()) {
    // Redirect back to manage books page
    header("Location: ../admin/manage_books.php?updated=1");
    exit();
} else {
    echo "Error updating book: " . $conn->error;
}

?>