<?php
include 'includes/session.php';
include 'includes/auth.php';

if (!is_logged_in() || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Logs - FootballAgent</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            Football Agent Sierra Leone - Admin
        </div>
        <nav>
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="view_reports.php">View Reports</a></li>
                <li><a href="system_logs.php">System Logs</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="dashboard">
            <h2>System Logs</h2>
            <p>Recent system activities and logs.</p>

            <div class="activities">
                <h3>Log Entries</h3>
                <div class="activity">[2025-12-06 20:00] User admin logged in</div>
                <div class="activity">[2025-12-06 19:45] New user registered: player1</div>
                <div class="activity">[2025-12-06 19:30] Contract updated for Mohamed Kallon</div>
                <div class="activity">[2025-12-06 19:15] System backup completed</div>
                <div class="activity">[2025-12-06 19:00] Scouting report submitted</div>
            </div>

            <div class="nav-links" style="margin-top: 20px;">
                <a href="admin.php">Back to Dashboard</a>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Football Agent Sierra Leone. All rights reserved.</p>
        <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
    </footer>
</body>
</html>