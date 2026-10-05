<?php
session_start();
require "db.php"; // correct path

// Check login
if (!isset($_SESSION['student_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $book_id = intval($_POST['book_id']);
    $student_usn = trim($_POST['student_usn']);

    // Fetch the book
    $book = $conn->query("SELECT * FROM books WHERE id = $book_id");

    if ($book->num_rows === 0) {
        echo "Invalid book!";
        exit();
    }

    $book = $book->fetch_assoc();

    // Check availability
    if ($book['available_count'] <= 0) {
        echo "No copies available!";
        exit();
    }

    // Insert preorder entry
    $stmt = $conn->prepare("INSERT INTO preorders (book_id, student_usn) VALUES (?, ?)");
    $stmt->bind_param("is", $book_id, $student_usn);

    if ($stmt->execute()) {

        // Reduce available count
        $newCount = $book['available_count'] - 1;
        $conn->query("UPDATE books SET available_count = $newCount WHERE id = $book_id");

        header("Location: ../student/dashboard.php?success=preordered");
        exit();
    } 
    else {
        echo "Failed to preorder!";
        exit();
    }
}
?>