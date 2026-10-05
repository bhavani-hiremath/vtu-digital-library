<?php
session_start();
require "../php/db.php";

// Only admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin_login.php");
    exit();
}

$query = "
SELECT p.id, p.student_usn, p.book_id, p.date,
       s.fullname AS student_name,
       b.title AS book_title
FROM preorders p
LEFT JOIN students s ON p.student_usn = s.usn
LEFT JOIN books b ON p.book_id = b.id
ORDER BY p.id DESC
";

$preorders = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Preorders</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="admin-body">

    <!-- Sidebar -->
    <div class="admin-sidebar">
        <h2 class="admin-title">VTU Library Admin</h2>

        <!-- UPDATED ICON PATHS -->
        <a href="admin_dashboard.php" class="sidebar-link">📊 Dashboard</a>
        <a href="manage_books.php" class="sidebar-link">📚 Manage Books</a>
        <a href="view_students.php" class="sidebar-link">👨‍🎓 Students</a>
        <a href="view_teachers.php" class="sidebar-link">👩‍🏫 Teachers</a>
        <a href="view_preorders.php" class="sidebar-link active">📝 Preorders</a>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="admin-main">
        <h1 class="dashboard-heading">Student Preorders</h1>

        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>USN</th>
                <th>Book</th>
                <th>Date</th>
                <th>Action</th>
            </tr>

            <?php while ($row = $preorders->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['student_name'] ?></td>
                <td><?= $row['student_usn'] ?></td>
                <td><?= $row['book_title'] ?></td>
                <td><?= $row['date'] ?></td>
                <td>
                    <!-- ✔ FIXED DELETE LINK -->
                    <a href="../php/delete_preorder_process.php?id=<?= $row['id'] ?>"
                       class="action-delete"
                       onclick="return confirm('Delete this preorder?');">🗑️</a>
                </td>
            </tr>
            <?php endwhile; ?>

        </table>
    </div>

</body>
</html>
