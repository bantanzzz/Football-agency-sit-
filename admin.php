<?php
include 'includes/session.php';
include 'includes/auth.php';
include 'includes/db.php';

if (!is_logged_in() || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$admin_id = $_SESSION['user_id']; // Remove the duplicate declaration
$agent_id = $admin_id; // Use admin_id for the queries

$stats = [
    'players' => 0,
    'contracts' => 0,
    'pending' => 0,
    'reports' => 0
];

// Get agent statistics - players
$query = "SELECT COUNT(*) as total FROM Player WHERE agent_id = ?";
$stmt = mysqli_prepare($conn, $query);
if ($stmt === false) {
    error_log("Prepare failed (players): " . mysqli_error($conn));
    $stats['players'] = 0;
} else {
    mysqli_stmt_bind_param($stmt, "i", $agent_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $stats['players'] = mysqli_fetch_assoc($result)['total'] ?? 0;
    mysqli_stmt_close($stmt);
}

// Get agent statistics - active contracts
$query = "SELECT COUNT(*) as total FROM Contract WHERE status = 'active' AND player_id IN (SELECT player_id FROM Player WHERE agent_id = ?)";
$stmt = mysqli_prepare($conn, $query);
if ($stmt === false) {
    error_log("Prepare failed (contracts): " . mysqli_error($conn));
    $stats['contracts'] = 0;
} else {
    mysqli_stmt_bind_param($stmt, "i", $agent_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $stats['contracts'] = mysqli_fetch_assoc($result)['total'] ?? 0;
    mysqli_stmt_close($stmt);
}

$stats['pending'] = 3;
$stats['reports'] = 5;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Dashboard - FootballAgent</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            Football Agent Sierra Leone - Agent
        </div>
        <nav>
            <ul>
                <li><a href="agent.php">Dashboard</a></li>
                <li><a href="add_player.php">Add Player</a></li>
                <li><a href="view_contracts.php">View Contracts</a></li>
                <li><a href="scouting_tools.php">Scouting Tools</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="dashboard">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Agent'); ?>!</h2>
                <a href="index.php" style="padding: 10px 20px; background: #66bb6a; color: #fff; text-decoration: none; border-radius: 5px; transition: all 0.3s ease;" onmouseover="this.style.background='#43a047'; this.style.transform='scale(1.05)';" onmouseout="this.style.background='#66bb6a'; this.style.transform='scale(1)';">🏠 Home</a>
            </div>

            <div class="widgets">
                <div class="widget">
                    <h3>Managed Players</h3>
                    <p><?php echo $stats['players']; ?></p>
                </div>
                <div class="widget">
                    <h3>Active Contracts</h3>
                    <p><?php echo $stats['contracts']; ?></p>
                </div>
                <div class="widget">
                    <h3>Pending Offers</h3>
                    <p><?php echo $stats['pending']; ?></p>
                </div>
                <div class="widget">
                    <h3>Scouting Reports</h3>
                    <p><?php echo $stats['reports']; ?></p>
                </div>
            </div>

            <div class="activities">
                <h3>Recent Activities</h3>
                <div class="activity">✓ Contract signed with East End Lions for Mohamed Kallon</div>
                <div class="activity">✓ New player added: Junior Kamara</div>
                <div class="activity">✓ Scouting report submitted for promising talent</div>
                <div class="activity">✓ Contract renewal negotiation started for Kai Kamara</div>
            </div>

            <div class="nav-links">
                <a href="add_player.php">Add New Player</a>
                <a href="view_contracts.php">View Contracts</a>
                <a href="scouting_tools.php">Scouting Tools</a>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Football Agent Sierra Leone. All rights reserved.</p>
        <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
    </footer>
</body>
</html>