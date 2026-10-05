<?php
session_start();

// Destroy only teacher session
unset($_SESSION['teacher_logged_in']);
unset($_SESSION['teacher_email']);

session_destroy();

// Redirect to teacher login
header("Location: ../teacher_login.php");
exit();
?>