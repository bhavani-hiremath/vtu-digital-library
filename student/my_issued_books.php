<?php
session_start();

if (!isset($_SESSION['student_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

require "../php/db.php";

$usn = $_SESSION['student_usn'];

$sql = "
SELECT ib.*, b.title, b.author 
FROM issued_books ib
JOIN books b ON ib.book_id = b.id
WHERE ib.student_usn = '$usn'
ORDER BY ib.issue_id DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Issued Books</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>My Issued Books</h2>

<table>
    <tr>
        <th>Book</th>
        <th>Author</th>
        <th>Issued On</th>
        <th>Due Date</th>
        <th>Renew</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['title'] ?></td>
        <td><?= $row['author'] ?></td>
        <td><?= $row['issue_date'] ?></td>
        <td><?= $row['due_date'] ?></td>

        <td>
            <a href="renew_book_processs.php?issue_id=<?= $row['issue_id'] ?>" class="action-btn">Renew</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
