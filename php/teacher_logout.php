<?php
session_start();

// Remove ONLY teacher session
unset($_SESSION['teacher_logged_in']);
unset($_SESSION['teacher_id']);
unset($_SESSION['teacher_name']);

// Destroy whole session (optional but safe)
session_destroy();

// Redirect to teacher login
header("Location: ../teacher_login.php");
exit();
?>