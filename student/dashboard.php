<?php
session_start();

// Correct session check for students
if (!isset($_SESSION['student_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

require "../php/db.php";

$usn = $_SESSION['student_usn'] ?? "";

// Count total available books
$total_books = 0;
$sql_total = "SELECT COUNT(*) AS total FROM books WHERE available_count > 0";
$result_total = $conn->query($sql_total);
if ($result_total && $row_total = $result_total->fetch_assoc()) {
    $total_books = $row_total['total'];
}

// Count books issued to student
$issued_books = 0;
$res = $conn->query("SELECT COUNT(*) AS c FROM issued_books WHERE student_usn='$usn'");
if ($res && $row = $res->fetch_assoc()) {
    $issued_books = $row['c'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="dashboard-bg">
<div class="dashboard-container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo-container">
            <img src="../assets/icons/images/logo.png" class="sidebar-logo">
        </div>

        <nav>
            <a href="dashboard.php" class="nav-item active">Dashboard</a>
            <a href="view_books.php" class="nav-item">View Books</a>
            <a href="my_issued_books.php" class="nav-item">My Issued Books</a>
        </nav>

        <a href="../php/logout.php" class="logout-btn">Logout</a>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <header class="main-header">
            <h1>Welcome, <?= htmlspecialchars($_SESSION['student_name']) ?> (<?= htmlspecialchars($usn) ?>)</h1>
        </header>

        <section class="dashboard-widgets">
            <div class="widget">
                <h2>Total Books Available</h2>
                <p><?= $total_books ?></p>
            </div>

            <div class="widget">
                <h2>Books Issued</h2>
                <p><?= $issued_books ?></p>
            </div>
        </section>

    </main>

</div>
</body>
</html>
