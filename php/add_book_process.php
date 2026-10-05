<?php
session_start();
require "db.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin_login.php");
    exit();
}

$title = $_POST['title'];
$author = $_POST['author'];
$branch = $_POST['branch'];
$available_count = $_POST['available_count'];
$download_link = $_POST['download_link'];

$sql = "INSERT INTO books (title, author, branch, available_count, download_link) 
        VALUES ('$title', '$author', '$branch', '$available_count', '$download_link')";

if ($conn->query($sql)) {
    header("Location: ../admin/manage_books.php?added=1");
} else {
    echo "Error: " . $conn->error;
}
?>