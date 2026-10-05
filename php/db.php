<?php
// db.php - Database connection details

$servername = "localhost";
// Ensure these match your MySQL credentials (commonly 'root' and an empty password for local servers)
$username = "root"; 
$password = ""; 

// The corrected database name
$dbname = "vtulibrary"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
