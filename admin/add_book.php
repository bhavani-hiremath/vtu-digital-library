<?php
session_start();
require "../php/db.php";

// allow only admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="admin-body">

    <!-- Sidebar -->
    <div class="admin-sidebar">
        <h2 class="admin-title">VTU Library Admin</h2>

        <a href="admin_dashboard.php" class="sidebar-link">📊 Dashboard</a>
        <a href="manage_books.php" class="sidebar-link active">📚 Manage Books</a>
        <a href="view_students.php" class="sidebar-link">👨‍🎓 Students</a>
        <a href="view_teachers.php" class="sidebar-link">👩‍🏫 Teachers</a>
        <a href="view_preorders.php" class="sidebar-link">📝 Preorders</a>

        <a href="../php/logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="admin-main">
        <h1 class="dashboard-heading">Add New Book</h1>

        <form action="../php/add_book_process.php" method="POST" class="add-book-form">

            <!-- Book Title -->
            <label>Book Title</label>
            <input type="text" name="title" required placeholder="Enter book title">

            <!-- Author -->
            <label>Author</label>
            <input type="text" name="author" required placeholder="Enter author name">

            <!-- Branch Dropdown -->
            <label>Branch</label>
            <select name="branch" required>
                <option value="">Select Branch</option>
                <option value="CSE">CSE</option>
                <option value="ECE">ECE</option>
                <option value="AID">AID</option>
            </select>

            <!-- Available Count -->
            <label>Available Copies</label>
            <input type="number" name="available_count" min="0" required placeholder="Enter no. of copies">

            <!-- Ebook / Download link -->
            <label>E-Book Download Link (optional)</label>
            <input type="text" name="download_link" placeholder="Paste Google Drive / Govt site link">

            <button type="submit" class="submit-btn">Add Book</button>
        </form>

    </div>

</body>
</html>