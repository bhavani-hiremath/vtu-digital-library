<?php
session_start();
// *** REQUIRE STATEMENT MOVED TO THE TOP ***
require '../php/db.php'; 

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
             <!-- Sidebar content with updated paths -->
            <div class="sidebar-header">
                <img src="/vtulibrary/assets/icons/images/logo.png" alt="VTU Logo" class="sidebar-logo">
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li class="active"><a href="dashboard.php"><img src="/vtulibrary/assets/icons/home.png" class="icon"> Dashboard</a></li>
                    <li><a href="../student/view_books.php"><img src="/vtulibrary/assets/icons/search.png" class="icon"> View Books</a></li>
                    <li><a href="../php/logout.php"><img src="/vtulibrary/assets/icons/logout.png" class="icon"> Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION['teacher_name']); ?> (Teacher Panel)</h1>
            </header>
            
            <!-- START OF COMMENTED OUT SECTION -->
            <!--
            <h2>Current Issued Books Overview</h2>
             <table>
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>USN</th>
                        <th>Student Name</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Select all issued books information from the database
                    // Ensure issue_id and book_id are selected for the return link
                    $sql = "SELECT ib.issue_id, ib.book_id, ib.issue_date, ib.due_date, ib.status, b.title AS book_title, s.usn, s.fullname 
                            FROM issued_books ib
                            JOIN books b ON ib.book_id = b.id
                            JOIN students s ON ib.student_id = s.id
                            ORDER BY ib.issue_date DESC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["book_title"] . "</td>";
                            echo "<td>" . $row["usn"] . "</td>";
                            echo "<td>" . $row["fullname"] . "</td>";
                            echo "<td>" . $row["issue_date"] . "</td>";
                            echo "<td>" . $row["due_date"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            // ADDED ACTION BUTTON
                            echo "<td>
                                    <a href='../admin/return_book_process.php?issue_id=" . $row['issue_id'] . "&book_id=" . $row['book_id'] . "'
                                       class='action-return'
                                       onclick='return confirm(\"Mark this book as returned?\");'>🔙 Return</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No books are currently issued.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            -->
            <!-- END OF COMMENTED OUT SECTION -->
        </main>
    </div>
</body>
</html>

<?php
// Note: Closing the connection should be done outside the commented section if you leave the require statement at the top.
// Make sure you close the connection if it's still open.
if (isset($conn)) {
    $conn->close();
}
?>
