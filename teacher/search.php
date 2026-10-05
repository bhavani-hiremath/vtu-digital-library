<?php
session_start();
require_once "../php/db.php";

if (!isset($_SESSION['teacher_id'])) {
    header("Location: ../teacher_login.php");
    exit();
}

$searchResults = [];
$keyword = "";

if (isset($_GET['q'])) {
    $keyword = trim($_GET['q']);

    $sql = "SELECT * FROM books 
            WHERE title LIKE '%$keyword%' 
               OR author LIKE '%$keyword%' 
               OR branch LIKE '%$keyword%'";

    $searchResults = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Books</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- TOP NAV -->
<div class="top-nav">
    <div class="left">
        <img src="../assets/icons/menu.png" class="icon">
        <h2>Search</h2>
    </div>
    <div class="right">
        <img src="../assets/icons/user.png" class="icon" onclick="window.location='profile.php'">
    </div>
</div>

<!-- SEARCH BAR -->
<div class="search-container">
    <form action="" method="GET">
        <input type="text" name="q" class="search-input"
            placeholder="Search by title, author, branch..."
            value="<?php echo $keyword; ?>" required>
        <button class="search-btn">Search</button>
    </form>
</div>

<!-- RESULTS SECTION -->
<div class="section">
    <h3 class="section-title">Search Results</h3>

    <?php if ($keyword != "" && $searchResults->num_rows == 0): ?>
        <p class="no-result">No books found for “<?php echo $keyword; ?>”.</p>
    <?php endif; ?>

    <div class="book-row">
        <?php while ($b = $searchResults->fetch_assoc()) { ?>
            <div class="book-card">
                <img src="../assets/images/default_book.jpg" class="book-img">

                <p class="book-title"><?php echo $b['title']; ?></p>
                <p class="book-author"><?php echo $b['author']; ?></p>
                <p class="book-branch">Branch: <?php echo $b['branch']; ?></p>
                <p class="book-availability">
                    Available: <?php echo $b['available_count']; ?>
                </p>

                <?php if (!empty($b['download_link'])) { ?>
                    <a href="<?php echo $b['download_link']; ?>" target="_blank">
                        <button class="small-btn">Open e-Book</button>
                    </a>
                <?php } else { ?>
                    <button class="small-btn disabled">No e-Book</button>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

</div>

<!-- BOTTOM NAV -->
<div class="bottom-nav">
    <div class="nav-item" onclick="window.location='dashboard.php'">
        <img src="../assets/icons/home.png" class="nav-icon">
        <p>Home</p>
    </div>

    <div class="nav-item active" onclick="window.location='search.php'">
        <img src="../assets/icons/search.png" class="nav-icon">
        <p>Search</p>
    </div>

    <div class="nav-item" onclick="window.location='profile.php'">
        <img src="../assets/icons/user.png" class="nav-icon">
        <p>Profile</p>
    </div>
</div>

</body>
</html>