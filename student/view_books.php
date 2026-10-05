<?php
session_start();

if (!isset($_SESSION['student_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

require "../php/db.php";

$search_term = "";
$search_query = "";

if (isset($_GET['search']) && trim($_GET['search']) !== "") {
    $search_term = $conn->real_escape_string(trim($_GET['search']));
    $search_query = "WHERE title LIKE '%$search_term%' OR author LIKE '%$search_term%' OR branch LIKE '%$search_term%'";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Books</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="dashboard-bg">

<div class="dashboard-container">

    <aside class="sidebar">
        <img src="../assets/icons/images/logo.png" class="sidebar-logo">

        <nav>
            <a href="dashboard.php" class="nav-item">Dashboard</a>
            <a href="view_books.php" class="nav-item active">View Books</a>
            <a href="my_issued_books.php" class="nav-item">My Issued Books</a>
        </nav>

        <a href="../php/logout.php" class="logout-btn">Logout</a>
    </aside>

    <main class="main-content">
        <header class="main-header">
            <h1>Available Books</h1>
        </header>

        <form method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Search by Title, Author or Branch" value="<?= htmlspecialchars($search_term) ?>">
            <button type="submit">Search</button>
        </form>

        <table>
            <thead>
            <tr>
                <th>ID</th><th>Title</th><th>Author</th><th>Shelf</th><th>Branch</th><th>Available</th><th>Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $sql = "SELECT * FROM books $search_query ORDER BY title ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['author'] ?></td>
                    <td><?= $row['shelf_location'] ?></td>
                    <td><?= $row['branch'] ?></td>
                    <td><?= $row['available_count'] ?></td>

                    <td>
                        <a href="preorder.php?id=<?= $row['id'] ?>" class="action-btn primary-action">Preorder</a>
                    </td>
                </tr>

            <?php endwhile; else: ?>

                <tr><td colspan="7">No books found.</td></tr>

            <?php endif; ?>

            </tbody>
        </table>
    </main>

</div>

</body>
</html>
