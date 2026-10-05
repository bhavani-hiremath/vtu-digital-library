<?php
session_start();
require "../php/db.php";

// Only logged-in students
if (!isset($_SESSION['student_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

$student_usn = $_SESSION['student_usn'];

// Book ID from URL
if (!isset($_GET['id'])) {
    echo "Invalid request!";
    exit();
}

$book_id = $_GET['id'];

$book = $conn->query("SELECT * FROM books WHERE id='$book_id'");

if ($book->num_rows === 0) {
    echo "Book not found!";
    exit();
}

$book = $book->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Preorder Book</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body class="netflix-body">

<div class="preorder-container">

    <h2 class="preorder-title">Preorder Confirmation</h2>

    <div class="preorder-card">
        <img src="../assets/images/default_book.jpg" class="preorder-img">

        <div class="preorder-info">
            <h3><?= $book['title'] ?></h3>
            <p><strong>Author:</strong> <?= $book['author'] ?></p>
            <p><strong>Branch:</strong> <?= $book['branch'] ?></p>
            <p><strong>Available Copies:</strong> <?= $book['available_count'] ?></p>

            <?php if ($book['available_count'] > 0): ?>
                <form action="../php/preorder_process.php" method="POST">
                    <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                    <input type="hidden" name="student_usn" value="<?= $student_usn ?>">

                    <button class="confirm-btn">Confirm Preorder</button>
                </form>
            <?php else: ?>
                <p class="out-of-stock">❌ No copies available</p>

                <?php if ($book['download_link']): ?>
                    <a href="<?= $book['download_link'] ?>" target="_blank" class="ebook-btn">
                        📘 Read Free eBook
                    </a>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    </div>

</div>

</body>
</html>