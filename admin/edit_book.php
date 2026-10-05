<?php
session_start();

// OPTIONAL: protect with admin login
// if (!isset($_SESSION['admin_id'])) {
//     header("Location: login.php");
//     exit();
// }

require '../php/db.php'; // change path if your db.php is elsewhere

// ---------- 1. Validate & get book id ----------
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Invalid book ID.");
}
$book_id = (int) $_GET['id'];

$error = "";
$success = "";

// ---------- 2. Handle form submission ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title          = trim($_POST['title']);
    $author         = trim($_POST['author']);
    $source_link    = trim($_POST['source_link']);
    $shelf_location = trim($_POST['shelf_location']);
    $branch         = trim($_POST['branch']);
    $available_count = isset($_POST['available_count']) ? (int)$_POST['available_count'] : 0;
    $download_link  = trim($_POST['download_link']);
    $row_number     = trim($_POST['row_number']);

    // Basic validation (you can add more)
    if ($title === "" || $author === "") {
        $error = "Title and Author are required.";
    } else {

        $sql = "UPDATE books SET
                    title = ?,
                    author = ?,
                    source_link = ?,
                    shelf_location = ?,
                    branch = ?,
                    available_count = ?,
                    download_link = ?,
                    row_number = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        // 9 params: s,s,s,s,s,i,s,s,i
        $stmt->bind_param(
            "sssssissi",
            $title,
            $author,
            $source_link,
            $shelf_location,
            $branch,
            $available_count,
            $download_link,
            $row_number,
            $book_id
        );

        if ($stmt->execute()) {
            $success = "Book details updated successfully.";
        } else {
            $error = "Update failed: " . $stmt->error;
        }

        $stmt->close();
    }
}

// ---------- 3. Fetch current book data to show in form ----------
$stmt = $conn->prepare("SELECT id, title, author, source_link, shelf_location, branch, available_count, download_link, row_number FROM books WHERE id = ?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();
$stmt->close();

if (!$book) {
    die("Book not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book | Admin</title>
    <link rel="stylesheet" href="../css/style.css"><!-- optional -->
</head>
<body class="dashboard-bg">

<div class="dashboard-container">
    <main class="main-content">
        <h1>Edit Book</h1>

        <?php if ($error): ?>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label>Title</label><br>
            <input type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required><br><br>

            <label>Author</label><br>
            <input type="text" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required><br><br>

            <label>Source Link</label><br>
            <input type="text" name="source_link" value="<?php echo htmlspecialchars($book['source_link']); ?>"><br><br>

            <label>Shelf Location</label><br>
            <input type="text" name="shelf_location" value="<?php echo htmlspecialchars($book['shelf_location']); ?>"><br><br>

            <label>Branch</label><br>
            <input type="text" name="branch" value="<?php echo htmlspecialchars($book['branch']); ?>"><br><br>

            <label>Available Count</label><br>
            <input type="number" name="available_count" min="0"
                   value="<?php echo (int)$book['available_count']; ?>"><br><br>

            <label>Download Link</label><br>
            <input type="text" name="download_link" value="<?php echo htmlspecialchars($book['download_link']); ?>"><br><br>

            <label>Row Number</label><br>
            <input type="text" name="row_number" value="<?php echo htmlspecialchars($book['row_number']); ?>"><br><br>

            <button type="submit" class="btn-primary">Update Book</button>
            <a href="manage_books.php" class="btn-secondary">Back to List</a>
        </form>
    </main>
</div>

</body>
</html>
