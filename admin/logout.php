<?php
session_start();

// Destroy admin session only
unset($_SESSION['admin_logged_in']);
unset($_SESSION['admin_email']);

session_destroy();

// Redirect to admin login
header("Location: ../admin_login.php");
exit();
?>