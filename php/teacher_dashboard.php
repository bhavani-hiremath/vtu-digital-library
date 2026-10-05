<?php
session_start();
if (!isset($_SESSION['teacher_id'])) {
    header("Location: ../teacher_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="dashboard-bg">
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo-container">
                <img src="/vtulibrary/assets/icons/images/logo.png" alt="VTU Logo" class="sidebar-logo">>
            </div>
            <nav>
                <a href="teacher_dashboard.php" class="nav-item active">
                    <img src="/vtulibrary/assets/icons/home.png" class="icon"> Dashboard
                </a>
                <!-- Teachers might need access to view all books too -->
                 <a href="../student/view_books.php" class="nav-item"> 
                     <img src="vtulibrary/assets/icons/search.png" class="nav-icon"> View Books
                </a>
            </nav>
            <a href="../php/logout.php" class="logout-btn">Logout</a>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION['teacher_name']); ?> (Teacher Panel)</h1>
            </header>
            <section class="main-info">
                <h2>Library Access</h2>
                <p>You have full access to view all available library resources.</p>
            </section>
        </main>
    </div>
</body>
</html>
