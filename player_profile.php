<?php
include 'includes/session.php';
include 'includes/auth.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit();
}

// Simulate getting player ID from query string
$player_id = $_GET['id'] ?? 1;

// Mock player data
$players = [
    1 => [
        'name' => 'Mohamed Kallon',
        'age' => 25,
        'position' => 'Forward',
        'club' => 'East End Lions',
        'agent' => 'Agent 1',
        'stats' => [
            'goals' => 15,
            'assists' => 8,
            'matches' => 22,
            'pass_accuracy' => '85%'
        ],
        'bio' => 'Talented forward with excellent finishing skills.'
    ],
    2 => [
        'name' => 'Kai Kamara',
        'age' => 23,
        'position' => 'Midfielder',
        'club' => 'Bo Rangers',
        'agent' => 'Agent 2',
        'stats' => [
            'goals' => 5,
            'assists' => 12,
            'matches' => 20,
            'pass_accuracy' => '88%'
        ],
        'bio' => 'Dynamic midfielder known for creativity.'
    ]
];

$player = $players[$player_id] ?? $players[1];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Profile - FootballAgent</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            Football Agent Sierra Leone - Player Profile
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="dashboard">
            <h2><?php echo htmlspecialchars($player['name']); ?>'s Profile</h2>

            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px; margin-top: 20px;">
                <div>
                    <div class="widget" style="text-align: center;">
                        <h3>Player Info</h3>
                        <p><strong>Age:</strong> <?php echo $player['age']; ?></p>
                        <p><strong>Position:</strong> <?php echo $player['position']; ?></p>
                        <p><strong>Club:</strong> <?php echo $player['club']; ?></p>
                        <p><strong>Agent:</strong> <?php echo $player['agent']; ?></p>
                    </div>

                    <div class="widget" style="margin-top: 20px;">
                        <h3>Bio</h3>
                        <p><?php echo htmlspecialchars($player['bio']); ?></p>
                    </div>
                </div>

                <div>
                    <div class="widgets" style="grid-template-columns: repeat(2, 1fr);">
                        <div class="widget">
                            <h3>Goals</h3>
                            <p><?php echo $player['stats']['goals']; ?></p>
                        </div>
                        <div class="widget">
                            <h3>Assists</h3>
                            <p><?php echo $player['stats']['assists']; ?></p>
                        </div>
                        <div class="widget">
                            <h3>Matches</h3>
                            <p><?php echo $player['stats']['matches']; ?></p>
                        </div>
                        <div class="widget">
                            <h3>Pass Accuracy</h3>
                            <p><?php echo $player['stats']['pass_accuracy']; ?></p>
                        </div>
                    </div>

                    <div class="activities" style="margin-top: 20px;">
                        <h3>Recent Performance</h3>
                        <div class="activity">Scored 2 goals in last match</div>
                        <div class="activity">Assisted 1 goal vs Bo Rangers</div>
                        <div class="activity">Training attendance: 95%</div>
                    </div>
                </div>
            </div>

            <div class="nav-links" style="margin-top: 20px;">
                <a href="javascript:history.back()">Back</a>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Football Agent Sierra Leone. All rights reserved.</p>
        <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
    </footer>
</body>
</html>