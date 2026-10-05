<?php
session_start();
require "../php/db.php";

// Allow only logged-in students
if (!isset($_SESSION['student_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

$search_result = [];

if (isset($_GET['q'])) {
    $q = $conn->real_escape_string($_GET['q']);
    $search_result = $conn->query("
        SELECT * FROM books 
        WHERE title LIKE '%$q%' 
        OR author LIKE '%$q%'
        OR branch LIKE '%$q%'
    ");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Books</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h2>Search Books</h2>

    <form method="GET">
        <input type="text" name="q" placeholder="Search by title, author, or branch" required>
        <button type="submit">Search</button>
    </form>

    <hr>

    <?php if (isset($_GET['q'])): ?>
        <h3>Results for "<?= htmlspecialchars($_GET['q']) ?>"</h3>

        <?php if ($search_result->num_rows > 0): ?>
            <ul>
                <?php while($row = $search_result->fetch_assoc()): ?>
                    <li>
                        <b><?= $row['title'] ?></b> — <?= $row['author'] ?>  
                        (<?= $row['branch'] ?> Branch)<br>

                        Available: <?= $row['available_count'] ?><br>

                        <?php if ($row['available_count'] > 0): ?>
                            <form action="../php/preorder_process.php" method="POST" style="margin-top:5px;">
                                <input type="hidden" name="book_id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="student_usn" value="<?= $_SESSION['student_usn'] ?>">
                                <button type="submit">Preorder</button>
                            </form>
                        <?php else: ?>
                            <span style="color:red;">Not available</span>
                        <?php endif; ?>

                        <?php if ($row['download_link']): ?>
                            <br><a href="<?= $row['download_link'] ?>" target="_blank">📘 Free Ebook</a>
                        <?php endif; ?>
                    </li>
                    <hr>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No matching books found.</p>
        <?php endif; ?>

    <?php endif; ?>

</body>
</html>