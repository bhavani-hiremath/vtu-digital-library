<?php
session_start();
require "db.php";   // file is inside php/, so path is correct

// 1️⃣ Ensure only admin can delete preorders
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin_login.php");
    exit();
}

// 2️⃣ Validate preorder ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../admin/view_preorders.php?error=missing_id");
    exit();
}

$preorder_id = intval($_GET['id']);

// 3️⃣ Get the book_id from preorder
$get = $conn->prepare("SELECT book_id FROM preorders WHERE id = ?");
$get->bind_param("i", $preorder_id);
$get->execute();
$res = $get->get_result();

if ($res->num_rows === 0) {
    header("Location: ../admin/view_preorders.php?error=not_found");
    exit();
}

$row = $res->fetch_assoc();
$book_id = $row['book_id'];

// 4️⃣ Delete the preorder
$del = $conn->prepare("DELETE FROM preorders WHERE id = ?");
$del->bind_param("i", $preorder_id);
$del->execute();

// 5️⃣ Restore book stock
$update = $conn->prepare("UPDATE books SET available_count = available_count + 1 WHERE id = ?");
$update->bind_param("i", $book_id);
$update->execute();

// 6️⃣ Redirect back to admin page with success
header("Location: ../admin/view_preorders.php?success=preorder_deleted");
exit();
?>
