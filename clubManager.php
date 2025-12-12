<?php
include 'includes/session.php';
include 'includes/auth.php';
include 'includes/db.php';

if (!is_logged_in() || $_SESSION['role'] !== 'clubmanager') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Manager Dashboard - FootballAgent</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            Football Agent Sierra Leone - Club Manager
        </div>
        <nav>
            <ul>
                <li><a href="clubManager.php">Dashboard</a></li>
                <li><a href="scout_players.php">Scout Players</a></li>
                <li><a href="manage_contracts.php">Manage Contracts</a></li>
                <li><a href="view_matches.php">View Matches</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="dashboard">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Club Manager'); ?>!</h2>
                <a href="index.php" style="padding: 10px 20px; background: #66bb6a; color: #fff; text-decoration: none; border-radius: 5px; transition: all 0.3s ease;" onmouseover="this.style.background='#43a047'; this.style.transform='scale(1.05)';" onmouseout="this.style.background='#66bb6a'; this.style.transform='scale(1)';">🏠 Home</a>
            </div>

            <div class="widgets">
                <div class="widget">
                    <h3>Team Size</h3>
                    <p>22</p>
                </div>
                <div class="widget">
                    <h3>Active Players</h3>
                    <p>18</p>
                </div>
                <div class="widget">
                    <h3>Pending Offers</h3>
                    <p>4</p>
                </div>
                <div class="widget">
                    <h3>League Position</h3>
                    <p>3rd</p>
                </div>
            </div>

            <div class="activities">
                <h3>Recent Activities</h3>
                <div class="activity">✓ New player signed: Junior Kamara from Bo Rangers</div>
                <div class="activity">✓ Contract offer sent to Mohamed Kallon</div>
                <div class="activity">✓ Match won 2-1 against Mighty Blackpool</div>
                <div class="activity">✓ Training camp scheduled for next week</div>
            </div>

            <div class="nav-links">
                <a href="scout_players.php">Scout Players</a>
                <a href="manage_contracts.php">Manage Contracts</a>
                <a href="view_matches.php">View Match Schedule</a>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Football Agent Sierra Leone. All rights reserved.</p>
        <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
    </footer>
</body>
</html>