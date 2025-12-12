<?php
include 'includes/session.php';
include 'includes/auth.php';
include 'includes/db.php';

if (!is_logged_in() || $_SESSION['role'] !== 'player') {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$player_data = [];
$success_msg = '';
$error_msg = '';

// Fetch current player data
$query = "SELECT * FROM Player WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$player_data = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['full_name'] ?? '');
    $height = trim($_POST['height'] ?? '');
    $weight = trim($_POST['weight'] ?? '');
    $position = trim($_POST['position'] ?? '');
    $nationality = trim($_POST['nationality'] ?? '');

    if (!empty($name)) {
        $query = "UPDATE Player SET name = ?, height = ?, weight = ?, position = ?, nationality = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssi", $name, $height, $weight, $position, $nationality, $user_id);
        
        if (mysqli_stmt_execute($stmt)) {
            $success_msg = "Profile updated successfully!";
            // Refresh player data
            $query = "SELECT * FROM Player WHERE user_id = ?";
            $stmt2 = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt2, "i", $user_id);
            mysqli_stmt_execute($stmt2);
            $result = mysqli_stmt_get_result($stmt2);
            $player_data = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt2);
        } else {
            $error_msg = "Error updating profile: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        $error_msg = "Name is required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - FootballAgent</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        select option { background: rgba(27, 94, 32, 0.9); color: #fff; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .alert-success { background: rgba(76, 175, 80, 0.3); color: #fff; border: 1px solid #66bb6a; }
        .alert-danger { background: rgba(244, 67, 54, 0.3); color: #fff; border: 1px solid #ef5350; }
    </style>
</head>
<body>
    <header>
        <div class="logo">Football Agent Sierra Leone - Player</div>
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
            <h2>Update Profile</h2>
            <p>Keep your profile information up to date.</p>

            <?php if ($success_msg): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success_msg); ?></div>
            <?php endif; ?>
            <?php if ($error_msg): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error_msg); ?></div>
            <?php endif; ?>

            <form method="POST" style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 10px; margin-top: 20px;">
                <div style="margin-bottom: 15px;">
                    <label style="color: #fff; display: block; margin-bottom: 5px;">Full Name:</label>
                    <input type="text" name="full_name" value="<?php echo htmlspecialchars($player_data['name'] ?? ''); ?>" style="width: 100%; padding: 10px; border: none; border-radius: 5px; background: rgba(255,255,255,0.2); color: #fff;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="color: #fff; display: block; margin-bottom: 5px;">Position:</label>
                    <select name="position" style="width: 100%; padding: 10px; border: none; border-radius: 5px; background: rgba(255,255,255,0.2); color: #fff;">
                        <option value="">Select Position</option>
                        <option value="Forward" <?php echo ($player_data['position'] === 'Forward' ? 'selected' : ''); ?>>Forward</option>
                        <option value="Midfielder" <?php echo ($player_data['position'] === 'Midfielder' ? 'selected' : ''); ?>>Midfielder</option>
                        <option value="Defender" <?php echo ($player_data['position'] === 'Defender' ? 'selected' : ''); ?>>Defender</option>
                        <option value="Goalkeeper" <?php echo ($player_data['position'] === 'Goalkeeper' ? 'selected' : ''); ?>>Goalkeeper</option>
                    </select>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="color: #fff; display: block; margin-bottom: 5px;">Nationality:</label>
                    <input type="text" name="nationality" value="<?php echo htmlspecialchars($player_data['nationality'] ?? ''); ?>" style="width: 100%; padding: 10px; border: none; border-radius: 5px; background: rgba(255,255,255,0.2); color: #fff;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="color: #fff; display: block; margin-bottom: 5px;">Height (cm):</label>
                    <input type="text" name="height" value="<?php echo htmlspecialchars($player_data['height'] ?? ''); ?>" style="width: 100%; padding: 10px; border: none; border-radius: 5px; background: rgba(255,255,255,0.2); color: #fff;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="color: #fff; display: block; margin-bottom: 5px;">Weight (kg):</label>
                    <input type="text" name="weight" value="<?php echo htmlspecialchars($player_data['weight'] ?? ''); ?>" style="width: 100%; padding: 10px; border: none; border-radius: 5px; background: rgba(255,255,255,0.2); color: #fff;">
                </div>
                <button type="submit" class="btn">Update Profile</button>
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