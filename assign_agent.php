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
    <title>Assign Agent - FootballAgent</title>
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
            <h2>Assign Agent to Player</h2>
            <p>Assign or reassign agents to players.</p>

            <form style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 10px; margin-top: 20px;">
                <div style="margin-bottom: 15px;">
                    <label style="color: #fff; display: block; margin-bottom: 5px;">Select Player:</label>
                    <select style="width: 100%; padding: 10px; border: none; border-radius: 5px; background: rgba(255,255,255,0.2); color: #fff;">
                        <option>Mohamed Kallon</option>
                        <option>Kai Kamara</option>
                        <option>Junior Kamara</option>
                    </select>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="color: #fff; display: block; margin-bottom: 5px;">Select Agent:</label>
                    <select style="width: 100%; padding: 10px; border: none; border-radius: 5px; background: rgba(255,255,255,0.2); color: #fff;">
                        <option>Agent 1</option>
                        <option>Agent 2</option>
                        <option>Unassigned</option>
                    </select>
                </div>
                <button type="submit" class="btn">Assign Agent</button>
            </form>

            <div style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 10px; margin-top: 20px;">
                <h3 style="color: #fff; margin-bottom: 15px;">Current Assignments</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: rgba(255,255,255,0.1);">
                            <th style="padding: 10px; text-align: left; color: #fff;">Player</th>
                            <th style="padding: 10px; text-align: left; color: #fff;">Current Agent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <td style="padding: 10px; color: #fff;">Mohamed Kallon</td>
                            <td style="padding: 10px; color: #fff;">Agent 1</td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <td style="padding: 10px; color: #fff;">Kai Kamara</td>
                            <td style="padding: 10px; color: #fff;">Agent 2</td>
                        </tr>
                    </tbody>
                </table>
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
    <style>
        select option {
            background: rgba(27, 94, 32, 0.9);
            color: #fff;
        }
    </style>
</body>
</html>