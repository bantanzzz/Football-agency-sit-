<?php
include 'includes/session.php';
include 'includes/auth.php';

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
    <title>View Matches - FootballAgent</title>
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
            <h2>Match Schedule</h2>
            <p>Upcoming and recent matches for your club.</p>

            <div style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 10px; margin-top: 20px;">
                <h3 style="color: #fff; margin-bottom: 15px;">Upcoming Matches</h3>
                <div style="margin-bottom: 10px; padding: 10px; background: rgba(255,255,255,0.1); border-radius: 5px;">
                    <strong style="color: #fff;">East End Lions vs Bo Rangers</strong> - Dec 15, 2025, 3:00 PM
                </div>
                <div style="margin-bottom: 10px; padding: 10px; background: rgba(255,255,255,0.1); border-radius: 5px;">
                    <strong style="color: #fff;">East End Lions vs Mighty Blackpool</strong> - Dec 22, 2025, 5:00 PM
                </div>
            </div>

            <div style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 10px; margin-top: 20px;">
                <h3 style="color: #fff; margin-bottom: 15px;">Recent Results</h3>
                <div style="margin-bottom: 10px; padding: 10px; background: rgba(255,255,255,0.1); border-radius: 5px;">
                    <strong style="color: #fff;">East End Lions 2-1 Bo Rangers</strong> - Dec 8, 2025 (Won)
                </div>
                <div style="margin-bottom: 10px; padding: 10px; background: rgba(255,255,255,0.1); border-radius: 5px;">
                    <strong style="color: #fff;">Mighty Blackpool 1-1 East End Lions</strong> - Dec 1, 2025 (Draw)
                </div>
            </div>

            <div class="nav-links" style="margin-top: 20px;">
                <a href="clubManager.php">Back to Dashboard</a>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Football Agent Sierra Leone. All rights reserved.</p>
        <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
    </footer>
</body>
</html>