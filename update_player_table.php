<?php
$serverName = "localhost";
$userName = "root";
$pass = "";
$dbName = "FOOTBALLAGENTSERIALEONE";

$conn = mysqli_connect($serverName, $userName, $pass, $dbName);
if (!$conn) {
    die('Connection error: ' . mysqli_connect_error());
}

echo "Adding missing columns to Player table...<br>";

// Add nationality column
$sql1 = "ALTER TABLE Player ADD COLUMN IF NOT EXISTS nationality VARCHAR(100)";
if (mysqli_query($conn, $sql1)) {
    echo "Nationality column added successfully<br>";
} else {
    echo "Note: " . mysqli_error($conn) . "<br>";
}

// Add height column
$sql2 = "ALTER TABLE Player ADD COLUMN IF NOT EXISTS height INT";
if (mysqli_query($conn, $sql2)) {
    echo "Height column added successfully<br>";
} else {
    echo "Note: " . mysqli_error($conn) . "<br>";
}

// Add weight column
$sql3 = "ALTER TABLE Player ADD COLUMN IF NOT EXISTS weight INT";
if (mysqli_query($conn, $sql3)) {
    echo "Weight column added successfully<br>";
} else {
    echo "Note: " . mysqli_error($conn) . "<br>";
}

// Add preferred_foot column
$sql4 = "ALTER TABLE Player ADD COLUMN IF NOT EXISTS preferred_foot VARCHAR(20)";
if (mysqli_query($conn, $sql4)) {
    echo "Preferred_foot column added successfully<br>";
} else {
    echo "Note: " . mysqli_error($conn) . "<br>";
}

echo "<br>Update completed! You can now register players with all fields.";
mysqli_close($conn);
?>