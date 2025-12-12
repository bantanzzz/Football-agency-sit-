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
    <title>Add Player - FootballAgent</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        select option {
            background: rgba(27, 94, 32, 0.9);
            color: #fff;
        }
    </style>
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
            <h2>Add New Player</h2>
            <p>Register a new player to your agency.</p>

            <form style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 10px; margin-top: 20px;">
                <div style="margin-bottom: 15px;">
                    <label style="color: #fff; display: block; margin-bottom: 5px;">Player Name:</label>
                    <input type="text" style="width: 100%; padding: 10px; border: none; border-radius: 5px; background: rgba(255,255,255,0.2); color: #fff;" placeholder="Enter player name">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="color: #fff; display: block; margin-bottom: 5px;">Email:</label>
                    <input type="email" style="width: 100%; padding: 10px; border: none; border-radius: 5px; background: rgba(255,255,255,0.2); color: #fff;" placeholder="Enter email">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="color: #fff; display: block; margin-bottom: 5px;">Position:</label>
                    <select style="width: 100%; padding: 10px; border: none; border-radius: 5px; background: rgba(255,255,255,0.2); color: #fff;">
                        <option>Forward</option>
                        <option>Midfielder</option>
                        <option>Defender</option>
                        <option>Goalkeeper</option>
                    </select>
                </div>
                <button type="submit" class="btn">Add Player</button>
            </form>

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