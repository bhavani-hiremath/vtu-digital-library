<?php
session_start();
require "../php/db.php";

// Block access if admin is not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin_login.php");
    exit();
}

// Fetch all books
$books = $conn->query("SELECT * FROM books ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Books</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="dashboard-bg">

<div class="dashboard-container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo-container">
            <img src="../assets/images/logo.png" class="sidebar-logo">
        </div>

        <nav>
            <a href="admin_dashboard.php" class="nav-item">
                <img src="../assets/icons/home.png" class="icon"> Dashboard
            </a>

            <a href="manage_books.php" class="nav-item active">
                <img src="../assets/icons/book.png" class="icon"> Manage Books
            </a>

            <a href="view_students.php" class="nav-item">
                <img src="../assets/icons/user.png" class="icon"> Students
            </a>

            <a href="view_teachers.php" class="nav-item">
                <img src="../assets/icons/user.png" class="icon"> Teachers
            </a>

            <a href="view_preorders.php" class="nav-item">
                <img src="../assets/icons/search.png" class="icon"> Preorders
            </a>
        </nav>

        <a href="../php/logout.php" class="logout-btn">
            <img src="../assets/icons/logout.png" class="icon"> Logout
        </a>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        
        <header class="main-header">
            <h1>Manage Books</h1>
        </header>

        <a href="add_book.php" class="btn-primary">+ Add New Book</a>

        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Branch</th>
                <th>Available</th>
                <th>Actions</th>
            </tr>

            <?php while($b = $books->fetch_assoc()) { ?>
                <tr>
                    <td><?= $b['id'] ?></td>
                    <td><?= $b['title'] ?></td>
                    <td><?= $b['author'] ?></td>
                    <td><?= $b['branch'] ?></td>
                    <td><?= $b['available_count'] ?></td>

                    <td>
                        <!-- EDIT BUTTON -->
                        <a href="edit_book.php?id=<?= $b['id'] ?>" class="action-edit">Edit</a>

                        <!-- DELETE BUTTON (FIXED) -->
                        <a href="../php/delete_book_process.php?id=<?= $b['id'] ?>" 
                           class="action-delete"
                           onclick="return confirm('Are you sure you want to delete this book?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>

        </table>

    </main>
</div>

</body>
</html>
