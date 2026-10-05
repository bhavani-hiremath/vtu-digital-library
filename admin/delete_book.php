<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin_login.php");
    exit();
}
require '../php/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Check if the book is currently issued (if you implement that logic fully later)
    // For now, simple delete:
    $sql = "DELETE FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: manage_books.php?msg=deleted_success");
    } else {
        // If deletion fails (e.g., integrity constraint if issued books reference it)
        header("Location: manage_books.php?msg=deleted_error");
    }
    $stmt->close();
} else {
    header("Location: manage_books.php");
}
$conn->close();
exit();
?>
