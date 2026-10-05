<?php
session_start();
require '../php/db.php';

if (!isset($_SESSION['student_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['issue_id'])) {
    die("Invalid request.");
}

$issue_id = intval($_GET['issue_id']);
$student_usn = $_SESSION['student_usn'];

$verify = $conn->query("SELECT * FROM issued_books WHERE issue_id=$issue_id AND student_usn='$student_usn'");

if ($verify->num_rows == 0) {
    die("Unauthorized action.");
}

$new_due = date("Y-m-d", strtotime("+14 days"));

$conn->query("UPDATE issued_books SET due_date='$new_due', renewal_count = renewal_count + 1 WHERE issue_id=$issue_id");

header("Location: my_issued_books.php?success=renewed");
exit();
?>
