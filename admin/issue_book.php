<?php
session_start();
require "../php/db.php";

// Only admin can issue
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "Invalid request!";
    exit();
}

$preorder_id = intval($_GET['id']);

// Fetch preorder details
$query = "
SELECT p.*, b.available_count 
FROM preorders p
JOIN books b ON p.book_id = b.id
WHERE p.id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $preorder_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Preorder not found!";
    exit();
}

$data = $result->fetch_assoc();
$student_usn = $data['student_usn'];
$book_id = $data['book_id'];
$available = $data['available_count'];


// Check available copies
if ($available <= 0) {
    echo "No copies left to issue!";
    exit();
}


// 1) Insert into issued_books table
$issue = $conn->prepare("INSERT INTO issued_books (student_usn, book_id) VALUES (?, ?)");
$issue->bind_param("si", $student_usn, $book_id);
$issue->execute();

// 2) Reduce available_count
$newCount = $available - 1;
$conn->query("UPDATE books SET available_count = $newCount WHERE id = $book_id");

// 3) Remove preorder
$conn->query("DELETE FROM preorders WHERE id = $preorder_id");

header("Location: view_preorders.php?success=issued");
exit();

?>