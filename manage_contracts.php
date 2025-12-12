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
    <title>Manage Contracts - FootballAgent</title>
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
            <h2>Manage Contracts</h2>
            <p>Handle player contracts and negotiations.</p>

            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background: rgba(255,255,255,0.1);">
                        <th style="padding: 10px; text-align: left; color: #fff;">Player</th>
                        <th style="padding: 10px; text-align: left; color: #fff;">Contract Type</th>
                        <th style="padding: 10px; text-align: left; color: #fff;">Duration</th>
                        <th style="padding: 10px; text-align: left; color: #fff;">Status</th>
                        <th style="padding: 10px; text-align: left; color: #fff;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <td style="padding: 10px; color: #fff;">Mohamed Kallon</td>
                        <td style="padding: 10px; color: #fff;">Professional</td>
                        <td style="padding: 10px; color: #fff;">2 years</td>
                        <td style="padding: 10px; color: #fff;">Active</td>
                        <td style="padding: 10px;"><a href="player_profile.php?id=1" class="btn" style="padding: 5px 10px; font-size: 12px; text-decoration: none;">View</a></td>
                    </tr>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <td style="padding: 10px; color: #fff;">Kai Kamara</td>
                        <td style="padding: 10px; color: #fff;">Professional</td>
                        <td style="padding: 10px; color: #fff;">1.5 years</td>
                        <td style="padding: 10px; color: #fff;">Pending</td>
                        <td style="padding: 10px;"><a href="player_profile.php?id=2" class="btn" style="padding: 5px 10px; font-size: 12px; text-decoration: none;">View</a></td>
                    </tr>
                </tbody>
            </table>

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