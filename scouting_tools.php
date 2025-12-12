<?php
include 'includes/session.php';
include 'includes/auth.php';

if (!is_logged_in() || $_SESSION['role'] !== 'agent') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scouting Tools - FootballAgent</title>
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
            <h2>Scouting Tools</h2>
            <p>Tools and resources for scouting new talent.</p>

            <div class="widgets">
                <div class="widget">
                    <h3>Scouting Database</h3>
                    <p>Access player profiles</p>
                    <button class="btn" style="margin-top: 10px;">Browse</button>
                </div>
                <div class="widget">
                    <h3>Report Generator</h3>
                    <p>Create scouting reports</p>
                    <button class="btn" style="margin-top: 10px;">Generate</button>
                </div>
                <div class="widget">
                    <h3>Match Analytics</h3>
                    <p>Analyze player performance</p>
                    <button class="btn" style="margin-top: 10px;">Analyze</button>
                </div>
                <div class="widget">
                    <h3>Network Contacts</h3>
                    <p>Connect with scouts</p>
                    <button class="btn" style="margin-top: 10px;">View</button>
                </div>
            </div>

            <div class="nav-links" style="margin-top: 20px;">
                <a href="agent.php">Back to Dashboard</a>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Football Agent Sierra Leone. All rights reserved.</p>
        <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
    </footer>
</body>
</html>