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
    <title>Manage Clubs - FootballAgent</title>
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
                <li><a href="assign_agent.php">Assign Agent</a></li>
                <li><a href="manage_clubs.php">Manage Clubs</a></li>
                <li><a href="view_reports.php">View Reports</a></li>
                <li><a href="system_logs.php">System Logs</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="dashboard">
            <h2>Manage Clubs</h2>
            <p>View and manage football clubs in the system.</p>

            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background: rgba(255,255,255,0.1);">
                        <th style="padding: 10px; text-align: left; color: #fff;">Club Name</th>
                        <th style="padding: 10px; text-align: left; color: #fff;">Location</th>
                        <th style="padding: 10px; text-align: left; color: #fff;">Manager</th>
                        <th style="padding: 10px; text-align: left; color: #fff;">Players</th>
                        <th style="padding: 10px; text-align: left; color: #fff;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <td style="padding: 10px; color: #fff;">East End Lions</td>
                        <td style="padding: 10px; color: #fff;">Freetown</td>
                        <td style="padding: 10px; color: #fff;">John Smith</td>
                        <td style="padding: 10px; color: #fff;">22</td>
                        <td style="padding: 10px;"><button class="btn" style="padding: 5px 10px; font-size: 12px;">Edit</button></td>
                    </tr>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <td style="padding: 10px; color: #fff;">Bo Rangers</td>
                        <td style="padding: 10px; color: #fff;">Bo</td>
                        <td style="padding: 10px; color: #fff;">Mike Johnson</td>
                        <td style="padding: 10px; color: #fff;">20</td>
                        <td style="padding: 10px;"><button class="btn" style="padding: 5px 10px; font-size: 12px;">Edit</button></td>
                    </tr>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <td style="padding: 10px; color: #fff;">Mighty Blackpool</td>
                        <td style="padding: 10px; color: #fff;">Freetown</td>
                        <td style="padding: 10px; color: #fff;">David Wilson</td>
                        <td style="padding: 10px; color: #fff;">18</td>
                        <td style="padding: 10px;"><button class="btn" style="padding: 5px 10px; font-size: 12px;">Edit</button></td>
                    </tr>
                </tbody>
            </table>

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