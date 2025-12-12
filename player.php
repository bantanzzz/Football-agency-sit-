<?php
include 'includes/session.php';
include 'includes/auth.php';
include 'includes/db.php';

if (!is_logged_in() || $_SESSION['role'] !== 'player') {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$player_data = [];

// Check if database connection exists
if ($conn) {
    $query = "SELECT * FROM Player WHERE user_id = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $player_data = mysqli_fetch_assoc($result) ?? [];
        mysqli_stmt_close($stmt);
    }
}

$current_club = $player_data['current_club'] ?? 'Not assigned';
$position = $player_data['position'] ?? 'Not specified';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Dashboard - FootballAgent</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            Football Agent Sierra Leone - Player
        </div>
        <nav>
            <ul>
                <li><a href="player.php">Dashboard</a></li>
                <li><a href="update_profile.php">Update Profile</a></li>
                <li><a href="view_stats.php">View Stats</a></li>
                <li><a href="contact_agent.php">Contact Agent</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="dashboard">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Player'); ?>!</h2>
                <a href="index.php" style="padding: 10px 20px; background: #66bb6a; color: #fff; text-decoration: none; border-radius: 5px; transition: all 0.3s ease;" onmouseover="this.style.background='#43a047'; this.style.transform='scale(1.05)';" onmouseout="this.style.background='#66bb6a'; this.style.transform='scale(1)';">🏠 Home</a>
            </div>

            <div class="widgets">
                <div class="widget">
                    <h3>Current Club</h3>
                    <p><?php echo htmlspecialchars($current_club); ?></p>
                </div>
                <div class="widget">
                    <h3>Position</h3>
                    <p><?php echo htmlspecialchars($position); ?></p>
                </div>
                <div class="widget">
                    <h3>Contract Status</h3>
                    <p>Active</p>
                </div>
                <div class="widget">
                    <h3>Profile Completion</h3>
                    <p>75%</p>
                </div>
            </div>

            <div class="activities">
                <h3>Quick Actions</h3>
                <div style="display: grid; gap: 10px;">
                    <div style="color: #f0f0f0; padding: 10px; background: rgba(255,255,255,0.05); border-radius: 5px;">
                        ✓ Profile is 75% complete. <a href="update_profile.php" style="color: #66bb6a; text-decoration: none;">Complete your profile</a>
                    </div>
                    <div style="color: #f0f0f0; padding: 10px; background: rgba(255,255,255,0.05); border-radius: 5px;">
                        ✓ View your performance statistics and match history.
                    </div>
                    <div style="color: #f0f0f0; padding: 10px; background: rgba(255,255,255,0.05); border-radius: 5px;">
                        ✓ Contact your assigned agent for guidance and support.
                    </div>
                </div>
            </div>

            <div class="nav-links">
                <a href="update_profile.php">Update Profile</a>
                <a href="view_stats.php">View Detailed Stats</a>
                <a href="contact_agent.php">Contact Agent</a>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Football Agent Sierra Leone. All rights reserved.</p>
        <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
    </footer>
</body>
</html>