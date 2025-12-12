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
                <li><a href="#my-players">My Players</a></li>
                <li><a href="#contracts">Contracts</a></li>
                <li><a href="#scouting">Scouting</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="dashboard">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Agent'); ?>!</h2>

            <div class="widgets">
                <div class="widget">
                    <h3>Managed Players</h3>
                    <p>12</p>
                </div>
                <div class="widget">
                    <h3>Active Contracts</h3>
                    <p>8</p>
                </div>
                <div class="widget">
                    <h3>Pending Offers</h3>
                    <p>3</p>
                </div>
                <div class="widget">
                    <h3>Scouting Reports</h3>
                    <p>5</p>
                </div>
            </div>

            <div class="activities">
                <h3>Recent Activities</h3>
                <div class="activity">Contract signed with East End Lions for Mohamed Kallon</div>
                <div class="activity">New player added: Junior Kamara</div>
                <div class="activity">Scouting report submitted for promising talent</div>
                <div class="activity">Contract renewal negotiation started for Kai Kamara</div>
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