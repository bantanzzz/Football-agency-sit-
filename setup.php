<?php
$serverName = "localhost";
$userName = "root";
$pass = "";
$dbName = "FOOTBALLAGENTSERIALEONE";

$conn = mysqli_connect($serverName, $userName, $pass);
if (!$conn) {
    die('Connection error: ' . mysqli_connect_error());
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Select database
mysqli_select_db($conn, $dbName);

// Create User table
$userTable = "CREATE TABLE IF NOT EXISTS User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'agent', 'player', 'clubmanager') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $userTable)) {
    echo "User table created successfully<br>";
} else {
    echo "Error creating User table: " . mysqli_error($conn) . "<br>";
}

// Create Player table
$playerTable = "CREATE TABLE IF NOT EXISTS Player (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    age INT,
    position VARCHAR(50),
    nationality VARCHAR(100),
    height INT,
    weight INT,
    preferred_foot VARCHAR(20),
    club VARCHAR(100),
    current_club VARCHAR(100),
    stats JSON,
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE
)";

if (mysqli_query($conn, $playerTable)) {
    echo "Player table created successfully<br>";
} else {
    echo "Error creating Player table: " . mysqli_error($conn) . "<br>";
}

// Create Agent table
$agentTable = "CREATE TABLE IF NOT EXISTS Agent (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    name VARCHAR(100),
    commission_rate DECIMAL(5, 2) DEFAULT 10.00,
    contact_phone VARCHAR(20),
    contact_email VARCHAR(100),
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE
)";

if (mysqli_query($conn, $agentTable)) {
    echo "Agent table created successfully<br>";
} else {
    echo "Error creating Agent table: " . mysqli_error($conn) . "<br>";
}

// Create Club table
$clubTable = "CREATE TABLE IF NOT EXISTS Club (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    manager_name VARCHAR(100),
    city VARCHAR(100),
    founded_year INT,
    stadium VARCHAR(100),
    contact_phone VARCHAR(20),
    contact_email VARCHAR(100),
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE
)";

if (mysqli_query($conn, $clubTable)) {
    echo "Club table created successfully<br>";
} else {
    echo "Error creating Club table: " . mysqli_error($conn) . "<br>";
}

// Create Contract table
$contractTable = "CREATE TABLE IF NOT EXISTS Contract (
    id INT AUTO_INCREMENT PRIMARY KEY,
    player_id INT NOT NULL,
    club_id INT,
    agent_id INT,
    start_date DATE,
    end_date DATE,
    salary DECIMAL(12, 2),
    status ENUM('pending', 'active', 'expired', 'terminated') DEFAULT 'pending',
    contract_type VARCHAR(100),
    terms TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (player_id) REFERENCES Player(id) ON DELETE CASCADE
)";

if (mysqli_query($conn, $contractTable)) {
    echo "Contract table created successfully<br>";
} else {
    echo "Error creating Contract table: " . mysqli_error($conn) . "<br>";
}

// Create Match table
$matchTable = "CREATE TABLE IF NOT EXISTS Match (
    id INT AUTO_INCREMENT PRIMARY KEY,
    club_id INT,
    opponent VARCHAR(100),
    match_date DATETIME,
    location VARCHAR(100),
    result VARCHAR(50),
    goals_for INT,
    goals_against INT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (club_id) REFERENCES Club(id) ON DELETE CASCADE
)";

if (mysqli_query($conn, $matchTable)) {
    echo "Match table created successfully<br>";
} else {
    echo "Error creating Match table: " . mysqli_error($conn) . "<br>";
}


$adminPassword = password_hash('admin123', PASSWORD_DEFAULT);
$insertAdmin = "INSERT IGNORE INTO User (username, email, password, role) VALUES ('admin', 'admin@footballagent.com', '$adminPassword', 'admin')";

if (mysqli_query($conn, $insertAdmin)) {
    echo "Default admin user created<br>";
} else {
    echo "Error creating admin user: " . mysqli_error($conn) . "<br>";
}

echo "Setup completed!";
?>