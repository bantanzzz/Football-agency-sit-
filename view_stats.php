<?php
include 'includes/session.php';
include 'includes/auth.php';

if (!is_logged_in() || $_SESSION['role'] !== 'player') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Stats - FootballAgent</title>
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
            <h2>Detailed Statistics</h2>
            <p>Your comprehensive performance statistics.</p>

            <div class="widgets">
                <div class="widget">
                    <h3>Goals</h3>
                    <p>15</p>
                </div>
                <div class="widget">
                    <h3>Assists</h3>
                    <p>8</p>
                </div>
                <div class="widget">
                    <h3>Matches Played</h3>
                    <p>22</p>
                </div>
                <div class="widget">
                    <h3>Minutes Played</h3>
                    <p>1980</p>
                </div>
                <div class="widget">
                    <h3>Pass Accuracy</h3>
                    <p>85%</p>
                </div>
                <div class="widget">
                    <h3>Tackles Won</h3>
                    <p>45</p>
                </div>
            </div>

            <div class="nav-links" style="margin-top: 20px;">
                <a href="player.php">Back to Dashboard</a>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Football Agent Sierra Leone. All rights reserved.</p>
        <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
    </footer>
</body>
</html>