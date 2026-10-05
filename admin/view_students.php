<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin_login.php");
    exit();
}
require '../php/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Students | Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="dashboard-bg">
<div class="dashboard-container">
     <aside class="sidebar">
        <!-- Sidebar content with updated paths -->
        <div class="sidebar-header">
            <img src="/vtulibrary/assets/icons/images/logo.png" alt="VTU Logo" class="sidebar-logo">
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="admin_dashboard.php"><img src="/vtulibrary/assets/icons/home.png" class="icon"> Dashboard</a></li>
                <li><a href="view_issued_books.php"><img src="/vtulibrary/assets/icons/book.png" class="icon"> Issued Books</a></li>
                <li><a href="view_preorders.php"><img src="/vtulibrary/assets/icons/book.png" class="icon"> Preorders</a></li>
                <li class="active"><a href="view_students.php"><img src="/vtulibrary/assets/icons/user.png" class="icon"> Students</a></li>
                <li><a href="view_teachers.php"><img src="/vtulibrary/assets/icons/user.png" class="icon"> Teachers</a></li>
                <li><a href="../php/admin_logout.php"><img src="/vtulibrary/assets/icons/logout.png" class="icon"> Logout</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <header class="main-header">
            <h1>Registered Students</h1>
        </header>

        <div class="book-list-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>USN</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Registered Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id, usn, fullname, email, created_at FROM students ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["usn"] . "</td>";
                            echo "<td>" . $row["fullname"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . date('Y-m-d', strtotime($row["created_at"])) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No students registered yet.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>
