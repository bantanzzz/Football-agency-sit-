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
    <title>View Reports - FootballAgent</title>
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
            <h2>View Reports</h2>
            <p>System reports and analytics.</p>

            <div class="widgets">
                <div class="widget">
                    <h3>Monthly Registrations</h3>
                    <p>45</p>
                </div>
                <div class="widget">
                    <h3>Active Contracts</h3>
                    <p>23</p>
                </div>
                <div class="widget">
                    <h3>Revenue</h3>
                    <p>$12,500</p>
                </div>
                <div class="widget">
                    <h3>Scouting Activities</h3>
                    <p>67</p>
                </div>
                <div class="widget">
                    <h3>Total Players</h3>
                    <p>120</p>
                </div>
                <div class="widget">
                    <h3>Active Agents</h3>
                    <p>25</p>
                </div>
                <div class="widget">
                    <h3>Club Managers</h3>
                    <p>5</p>
                </div>
                <div class="widget">
                    <h3>System Users</h3>
                    <p>150</p>
                </div>
            </div>

            <div style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 10px; margin-top: 20px;">
                <h3 style="color: #fff; margin-bottom: 15px;">Performance Metrics</h3>
                <p style="color: #f0f0f0;">Average goals per match: 2.3</p>
                <p style="color: #f0f0f0;">Player satisfaction rate: 92%</p>
                <p style="color: #f0f0f0;">Contract renewal rate: 78%</p>
                <p style="color: #f0f0f0;">Scouting success rate: 65%</p>
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