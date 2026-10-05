<?php
session_start();
require "../php/db.php";

if (!isset($_SESSION['student_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

// *** FIXED LINE: Get the numeric ID from the correct session variable ***
$student_id_from_session = $_SESSION['student_id']; 

if (!isset($_GET['id'])) {
    die("Invalid request");
}

$book_id = intval($_GET['id']);

// 1. Fetch book
$book = $conn->query("SELECT * FROM books WHERE id = $book_id")->fetch_assoc();
if (!$book) die("Book not found");

// 2. Check availability
if ($book['available_count'] <= 0) {
    header("Location: dashboard.php?error=no_copies");
    exit();
}

// 3. Calculate the due date in PHP (14 days from now)
$due_date_obj = new DateTime();
$due_date_obj->modify('+14 days');
$due_date = $due_date_obj->format('Y-m-d');

// 4. Insert into issued_books table (Using the correct numeric student_id)
$stmt = $conn->prepare("INSERT INTO issued_books (student_id, book_id, due_date) VALUES (?, ?, ?)");
// Parameter types: i (integer for student_id), i (integer for book_id), s (string for date)
$stmt->bind_param("iis", $student_id_from_session, $book_id, $due_date); 
$stmt->execute();

// 5. Reduce available count in books table
$newCount = $book['available_count'] - 1;
$conn->query("UPDATE books SET available_count=$newCount WHERE id=$book_id");

// 6. Done
header("Location: my_issued_books.php?success=issued");
exit();
?>
