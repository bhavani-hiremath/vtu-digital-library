<?php
session_start();
require "../php/db.php";

// Only admin can access this script
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin_login.php");
    exit();
}

if (!isset($_GET['issue_id']) || !isset($_GET['book_id'])) {
    die("Invalid request.");
}

$issue_id = intval($_GET['issue_id']);
$book_id = intval($_GET['book_id']);

// Start Database Transactions (optional but safer for multi-step updates)
$conn->begin_transaction();

try {
    // 1. Update the issued_books record to mark as returned 
    // This assumes you have a 'status' or 'return_date' column.
    $sql_return = "UPDATE issued_books SET return_date = CURRENT_TIMESTAMP() WHERE issue_id = ?";
    $stmt_return = $conn->prepare($sql_return);
    $stmt_return->bind_param("i", $issue_id);
    $stmt_return->execute();

    // 2. Increment the available count in the books table
    $sql_increment = "UPDATE books SET available_count = available_count + 1 WHERE id = ?";
    $stmt_increment = $conn->prepare($sql_increment);
    $stmt_increment->bind_param("i", $book_id);
    $stmt_increment->execute();

    // Commit the changes
    $conn->commit();
    
    // Redirect back to the issued books list with a success message
    header("Location: view_issued_books.php?success=book_returned");
    exit();

} catch (mysqli_sql_exception $exception) {
    // Rollback changes if an error occurred
    $conn->rollback();
    header("Location: view_issued_books.php?error=db_error");
    exit();
}
?>
