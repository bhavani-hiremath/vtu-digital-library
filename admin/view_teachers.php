<?php
session_start();
require "../php/db.php";

// Only admin can access
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin_login.php");
    exit();
}

// Fetch teachers
$result = $conn->query("SELECT * FROM teachers ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Teachers | Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="dashboard-bg">
<div class="dashboard-container">
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="/vtulibrary/assets/icons/images/logo.png" alt="VTU Logo" class="sidebar-logo">
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="admin_dashboard.php"><img src="/vtulibrary/assets/icons/home.png" class="icon"> Dashboard</a></li>
                <li><a href="view_issued_books.php"><img src="/vtulibrary/assets/icons/book.png" class="icon"> Issued Books</a></li>
                <li><a href="view_preorders.php"><img src="/vtulibrary/assets/icons/book.png" class="icon"> Preorders</a></li>
                <li><a href="view_students.php"><img src="/vtulibrary/assets/icons/user.png" class="icon"> Students</a></li>
                <li class="active"><a href="view_teachers.php"><img src="/vtulibrary/assets/icons/user.png" class="icon"> Teachers</a></li>
                <li><a href="../php/admin_logout.php"><img src="/vtulibrary/assets/icons/logout.png" class="icon"> Logout</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header class="main-header">
            <h1>All Teachers</h1>
        </header>

        <div class="book-list-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <!-- changed name -> fullname -->
                        <td><?= $row['fullname'] ?></td>
                        <td><?= $row['email'] ?></td>

                        <td>
                            <!-- fixed delete path -->
                            <a href="../php/delete_teacher_process.php?id=<?= $row['id'] ?>"
                               onclick="return confirm('Are you sure you want to delete this teacher?');"
                               class="action-delete">🗑️</a>
                        </td>
                    </tr>
                    <?php endwhile;
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>
