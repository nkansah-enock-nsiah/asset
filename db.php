<?php
$host = "localhost";
$user = "root";  // change if your MySQL username is different
$pass = "";      // add password if any
$dbname = "asset_management";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
