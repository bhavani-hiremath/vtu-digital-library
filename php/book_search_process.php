<?php
require "db.php";

header("Content-Type: application/json");

// If no query or empty → return blank
if (!isset($_GET['q']) || trim($_GET['q']) === "") {
    echo json_encode([]);
    exit();
}

$q = trim($_GET['q']);
$search = "%".$q."%";

// Prepared search query
$stmt = $conn->prepare(
    "SELECT id, title, author, branch, available_count, download_link 
     FROM books 
     WHERE title LIKE ?
        OR author LIKE ?
        OR branch LIKE ?"
);
$stmt->bind_param("sss", $search, $search, $search);
$stmt->execute();

$result = $stmt->get_result();
$books = [];

while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

echo json_encode($books);
?>