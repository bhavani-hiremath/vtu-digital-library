<?php
session_start();
require_once "../php/db.php";

if (!isset($_SESSION['teacher_id'])) {
    header("Location: ../teacher_login.php");
    exit();
}

$teacher_id = $_SESSION['teacher_id'];

$sql = "SELECT fullname, email, branch, created_at 
        FROM teachers WHERE id = $teacher_id";
$res = $conn->query($sql);
$data = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<!-- Top Navigation -->
<div class="top-nav">
    <div class="left">
        <img src="../assets/icons/menu.png" class="icon">
        <h2>Profile</h2>
    </div>
</div>

<!-- Profile Section -->
<div class="profile-container">

    <img src="../assets/icons/user.png" class="profile-img">

    <h2 class="profile-name">
        <?php echo $data['fullname']; ?>
    </h2>

    <p class="profile-email">
        <?php echo $data['email']; ?>
    </p>

    <p class="profile-branch">
        Branch: <?php echo $data['branch']; ?>
    </p>

    <p class="profile-date">
        Joined on: <?php echo date("d M Y", strtotime($data['created_at'])); ?>
    </p>

    <a href="logout.php">
        <button class="logout-btn">Logout</button>
    </a>

</div>

<!-- Bottom Navigation -->
<div class="bottom-nav">
    <div class="nav-item" onclick="window.location='dashboard.php'">
        <img src="../assets/icons/home.png" class="nav-icon">
        <p>Home</p>
    </div>

    <div class="nav-item" onclick="window.location='search.php'">
        <img src="../assets/icons/search.png" class="nav-icon">
        <p>Search</p>
    </div>

    <div class="nav-item active" onclick="window.location='profile.php'">
        <img src="../assets/icons/user.png" class="nav-icon">
        <p>Profile</p>
    </div>
</div>

</body>
</html>