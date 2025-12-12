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
    <title>Scout Players - FootballAgent</title>
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
            <h2>Scout Players</h2>
            <p>Browse available players and send contract offers.</p>

            <div style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 10px; margin-top: 20px;">
                <h3 style="color: #fff; margin-bottom: 15px;">Available Players</h3>
                <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                    <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px; flex: 1; min-width: 200px;">
                        <h4 style="color: #fff; margin: 0;">Junior Kamara</h4>
                        <p style="color: #f0f0f0; margin: 5px 0;">Forward, Age 22</p>
                        <button class="btn" style="padding: 5px 10px; font-size: 12px;">Send Offer</button>
                    </div>
                    <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px; flex: 1; min-width: 200px;">
                        <h4 style="color: #fff; margin: 0;">Samuel Conteh</h4>
                        <p style="color: #f0f0f0; margin: 5px 0;">Midfielder, Age 20</p>
                        <button class="btn" style="padding: 5px 10px; font-size: 12px;">Send Offer</button>
                    </div>
                    <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px; flex: 1; min-width: 200px;">
                        <h4 style="color: #fff; margin: 0;">Abdul Sesay</h4>
                        <p style="color: #f0f0f0; margin: 5px 0;">Defender, Age 24</p>
                        <button class="btn" style="padding: 5px 10px; font-size: 12px;">Send Offer</button>
                    </div>
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