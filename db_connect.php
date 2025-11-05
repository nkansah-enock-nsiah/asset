<?php
$host = "localhost";  // Database server
$user = "root";       // Database username (default root)
$pass = "";           // Database password (leave empty if none)
$dbname = "asset_db";  // Your database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
