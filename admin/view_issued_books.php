<?php
session_start();
// Ensure the path to the database connection file is correct
require "../php/db.php"; 

if (!isset($conn) || !$conn) {
    die("Error: Database connection variable not available.");
}

// Only admin can view
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin_login.php");
    exit();
}

$sql = "
SELECT 
    ib.issue_id AS id, 
    ib.book_id,
    ib.student_id,     
    ib.issue_date,
    ib.due_date,       
    ib.renewal_count,  
    s.fullname AS student_name,
    s.usn AS student_usn, 
    b.title AS book_title,
    b.author
FROM issued_books ib
LEFT JOIN students s ON ib.student_id = s.id
LEFT JOIN books b ON ib.book_id = b.id
ORDER BY ib.issue_id DESC
";

$issued = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<title>Issued Books</title>
<link rel='stylesheet' href='../css/style.css'>
</head>

<body class='admin-body'>

<div class='admin-sidebar'>
    <h2 class='admin-title'>VTU Library Admin</h2>
    <!-- UPDATED ICON PATHS -->
    <a href='admin_dashboard.php' class='sidebar-link'>Dashboard</a>
    <a href='manage_books.php' class='sidebar-link'>Manage Books</a>
    <a href='view_students.php' class='sidebar-link'>Students</a>
    <a href='view_teachers.php' class='sidebar-link'>Teachers</a>
    <a href='view_preorders.php' class='sidebar-link'>Preorders</a>
    <a href='view_issued_books.php' class='sidebar-link active'>Issued Books</a>
    <a href='../php/logout.php' class='logout-btn'>Logout</a>
</div>

<div class='admin-main'>
    <h1 class='dashboard-heading'>Issued Books</h1>

    <table class='admin-table'>
        <tr>
            <th>ID</th>
            <th>Student</th>
            <th>USN</th>
            <th>Book</th>
            <th>Author</th>
            <th>Issued On</th>
            <th>Due Date</th>
            <th>Renewals</th>
            <th>Action</th> <!-- The combined Action column -->
        </tr>

        <?php while($row = $issued->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['student_name'] ?></td>
            <td><?= $row['student_usn'] ?></td>
            <td><?= $row['book_title'] ?></td>
            <td><?= $row['author'] ?></td>
            <td><?= $row['issue_date'] ?></td>
            <td><?= $row['due_date'] ?></td>
            <td><?= $row['renewal_count'] ?></td>
            <td>
                <!-- ADDED RENEW BUTTON FOR ADMIN -->
                <a href="../student/renew_book_process.php?issue_id=<?= $row['id'] ?>"
                   class="action-renew"
                   onclick="return confirm('Renew this book for the student?');">Renew</a>
                   
                <!-- Return Button -->
                <a href="return_book_process.php?issue_id=<?= $row['id'] ?>&book_id=<?= $row['book_id'] ?>"
                   class="action-return"
                   onclick="return confirm('Mark this book as returned?');">🔙 Return</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
