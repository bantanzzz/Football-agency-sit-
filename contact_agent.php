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
    <title>Contact Agent - FootballAgent</title>
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
            <h2>Contact Your Agent</h2>
            <p>Send a message to your assigned agent.</p>

            <form style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 10px; margin-top: 20px;">
                <div style="margin-bottom: 15px;">
                    <label style="color: #fff; display: block; margin-bottom: 5px;">Subject:</label>
                    <input type="text" style="width: 100%; padding: 10px; border: none; border-radius: 5px; background: rgba(255,255,255,0.2); color: #fff;" placeholder="Enter subject">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="color: #fff; display: block; margin-bottom: 5px;">Message:</label>
                    <textarea rows="5" style="width: 100%; padding: 10px; border: none; border-radius: 5px; background: rgba(255,255,255,0.2); color: #fff; resize: vertical;" placeholder="Enter your message"></textarea>
                </div>
                <button type="submit" class="btn">Send Message</button>
            </form>

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