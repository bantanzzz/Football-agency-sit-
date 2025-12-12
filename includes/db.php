<?php
$serverName = "localhost";
$userName = "root";
$pass = "";
$dbName = "footballagentserialeone";

$conn = mysqli_connect($serverName, $userName, $pass, $dbName);

if (!$conn) {
    die("Database Connection Error: " . mysqli_connect_error());
}

// Set charset to utf8mb4
mysqli_set_charset($conn, "utf8mb4");
?>