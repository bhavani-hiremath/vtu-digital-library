<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin_login.php");
    exit();
}
// Optional: Include message helper if you added it previously
// require '../php/message.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="dashboard-bg">
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo-container">
                <!-- UPDATED LOGO PATH -->
                <img src="/vtulibrary/assets/icons/images/logo.png" alt="VTU Logo" class="sidebar-logo">
            </div>
            <!-- Standard Navigation Links (Using 'nav-item' class from your existing CSS) -->
            <nav>
                <a href="admin_dashboard.php" class="nav-item active">
                    <!-- UPDATED ICON PATH -->
                    <img src="/vtulibrary/assets/icons/home.png" class="icon"> Dashboard
                </a>
                <a href="manage_books.php" class="nav-item">
                    <!-- UPDATED ICON PATH -->
                    <img src="/vtulibrary/assets/icons/book.png" class="icon"> Manage Books
                </a>
                <a href="view_students.php" class="nav-item">
                    <!-- UPDATED ICON PATH -->
                    <img src="/vtulibrary/assets/icons/user.png" class="icon"> Students
                </a>
                <a href="view_teachers.php" class="nav-item">
                    <!-- UPDATED ICON PATH -->
                    <img src="/vtulibrary/assets/icons/user.png" class="icon"> Teachers
                </a>
                <a href="view_preorders.php" class="nav-item">
                    <!-- UPDATED ICON PATH -->
                    <img src="/vtulibrary/assets/icons/search.png" class="icon"> Preorders
                </a>
                <!-- ADDED LINK FOR ISSUED BOOKS -->
                <a href="view_issued_books.php" class="nav-item">
                    <!-- UPDATED ICON PATH -->
                    <img src="/vtulibrary/assets/icons/book.png" class="icon"> Issued Books
                </a>
            </nav>
            <!-- END Navigation Links -->
            <a href="../php/logout.php" class="logout-btn">
                <!-- UPDATED ICON PATH -->
                <img src="/vtulibrary/assets/icons/logout.png" class="icon"> Logout
            </a>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <h1>Admin Panel Dashboard</h1>
            </header>
            <!-- Display messages if necessary -->
            <?php // display_message(); ?> 

            <section class="main-info">
                <h2>Welcome Admin!</h2>
                <p>Use the sidebar to manage library resources.</p>
                <a href="manage_books.php" class="btn-primary">Go to Book Management</a>
            </section>
        </main>
    </div>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin_login.php");
    exit();
}
// Optional: Include message helper if you added it previously
// require '../php/message.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="dashboard-bg">
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo-container">
                <!-- UPDATED LOGO PATH -->
                <img src="/vtulibrary/assets/icons/images/logo.png" alt="VTU Logo" class="sidebar-logo">
            </div>
            <!-- Standard Navigation Links (Using 'nav-item' class from your existing CSS) -->
            <nav>
                <a href="admin_dashboard.php" class="nav-item active">
                    <!-- UPDATED ICON PATH -->
                    <img src="/vtulibrary/assets/icons/home.png" class="icon"> Dashboard
                </a>
                <a href="manage_books.php" class="nav-item">
                    <!-- UPDATED ICON PATH -->
                    <img src="/vtulibrary/assets/icons/book.png" class="icon"> Manage Books
                </a>
                <a href="view_students.php" class="nav-item">
                    <!-- UPDATED ICON PATH -->
                    <img src="/vtulibrary/assets/icons/user.png" class="icon"> Students
                </a>
                <a href="view_teachers.php" class="nav-item">
                    <!-- UPDATED ICON PATH -->
                    <img src="/vtulibrary/assets/icons/user.png" class="icon"> Teachers
                </a>
                <a href="view_preorders.php" class="nav-item">
                    <!-- UPDATED ICON PATH -->
                    <img src="/vtulibrary/assets/icons/search.png" class="icon"> Preorders
                </a>
                <!-- ADDED LINK FOR ISSUED BOOKS -->
                <a href="view_issued_books.php" class="nav-item">
                    <!-- UPDATED ICON PATH -->
                    <img src="/vtulibrary/assets/icons/book.png" class="icon"> Issued Books
                </a>
            </nav>
            <!-- END Navigation Links -->
            <a href="../php/logout.php" class="logout-btn">
                <!-- UPDATED ICON PATH -->
                <img src="/vtulibrary/assets/icons/logout.png" class="icon"> Logout
            </a>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <h1>Admin Panel Dashboard</h1>
            </header>
            <!-- Display messages if necessary -->
            <?php // display_message(); ?> 

            <section class="main-info">
                <h2>Welcome Admin!</h2>
                <p>Use the sidebar to manage library resources.</p>
                <a href="manage_books.php" class="btn-primary">Go to Book Management</a>
            </section>
        </main>
    </div>
</body>
</html>


