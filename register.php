<?php
session_start();
include 'includes/session.php';
include 'includes/auth.php';
include 'includes/functions.php';

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $message = 'Invalid request. Please try again.';
        $message_type = 'error';
    } else {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $role = $_POST['role'];

        $full_name = trim($_POST['full_name'] ?? '');
        $position = $_POST['position'] ?? '';
        $age = $_POST['age'] ?? '';
        $nationality = trim($_POST['nationality'] ?? '');
        $height = $_POST['height'] ?? '';
        $weight = $_POST['weight'] ?? '';
        $preferred_foot = $_POST['preferred_foot'] ?? '';

        if (empty($username) || empty($email) || empty($password) || empty($role)) {
            $message = 'All fields are required.';
            $message_type = 'error';
        } elseif ($role === 'player' && (empty($full_name) || empty($position) || empty($age) || empty($nationality))) {
            $message = 'Please fill in all player information fields.';
            $message_type = 'error';
        } elseif ($password !== $confirm_password) {
            $message = 'Passwords do not match.';
            $message_type = 'error';
        } elseif (strlen($password) < 6) {
            $message = 'Password must be at least 6 characters long.';
            $message_type = 'error';
        } elseif (!in_array($role, ['admin', 'agent', 'player', 'clubmanager'])) {
            $message = 'Invalid role selected.';
            $message_type = 'error';
        } else {
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => $role
            ];

            if ($role === 'player') {
                $data['full_name'] = $full_name;
                $data['position'] = $position;
                $data['age'] = $age;
                $data['nationality'] = $nationality;
                $data['height'] = $height;
                $data['weight'] = $weight;
                $data['preferred_foot'] = $preferred_foot;
            }

            if (register_user($data)) {
                $message = 'Registration successful! Redirecting to login...';
                $message_type = 'success';
                header('Refresh: 2; url=login.php');
            } else {
                $message = 'Registration failed. Username or email may already exist.';
                $message_type = 'error';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Football Agent Sierra Leone</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .register-wrapper {
            width: 100%;
            max-width: 900px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-info {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 50%, #1b5e20 100%);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .register-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 50%, rgba(255,255,255,0.1) 0%, transparent 70%);
            z-index: 0;
        }

        .register-info > * {
            position: relative;
            z-index: 1;
        }

        .register-info h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            font-weight: 800;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .register-info p {
            font-size: 1.1em;
            line-height: 1.6;
            margin-bottom: 30px;
            color: rgba(255,255,255,0.95);
        }

        .register-benefits {
            list-style: none;
            margin-top: 30px;
        }

        .register-benefits li {
            margin: 15px 0;
            padding-left: 35px;
            position: relative;
            font-size: 1em;
        }

        .register-benefits li::before {
            content: '✓';
            position: absolute;
            left: 0;
            font-size: 1.5em;
            color: #66bb6a;
            font-weight: bold;
        }

        .register-form-container {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            backdrop-filter: blur(15px);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-form-container h2 {
            color: #fff;
            font-size: 2em;
            margin-bottom: 10px;
            text-align: center;
        }

        .register-subtitle {
            text-align: center;
            color: #ddd;
            margin-bottom: 30px;
            font-size: 0.95em;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #fff;
            font-weight: 600;
            font-size: 0.95em;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            font-size: 0.95em;
            transition: all 0.3s ease;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.2);
            border-color: #66bb6a;
            box-shadow: 0 0 12px rgba(102, 187, 106, 0.3);
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-group select option {
            background: #1b5e20;
            color: #fff;
            padding: 10px;
        }

        .password-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .player-fields {
            display: none;
            border-top: 2px solid rgba(255, 255, 255, 0.2);
            padding-top: 25px;
            margin-top: 25px;
        }

        .player-fields.active {
            display: block;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .player-fields h3 {
            color: #fff;
            font-size: 1.2em;
            margin-bottom: 20px;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(102, 187, 106, 0.3);
        }

        .form-row-three {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 12px;
        }

        .register-btn {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #66bb6a 0%, #43a047 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 187, 106, 0.4);
            margin-top: 15px;
        }

        .register-btn:hover {
            background: linear-gradient(135deg, #43a047 0%, #2e7d32 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 187, 106, 0.5);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #ddd;
        }

        .login-link a {
            color: #66bb6a;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: #43a047;
            text-decoration: underline;
        }

        .message {
            padding: 14px 16px;
            margin-bottom: 20px;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            animation: slideDown 0.4s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message.success {
            background: rgba(76, 175, 80, 0.3);
            color: #66bb6a;
            border: 2px solid #66bb6a;
        }

        .message.error {
            background: rgba(244, 67, 54, 0.3);
            color: #ef5350;
            border: 2px solid #ef5350;
        }

        .back-home {
            position: fixed;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 0.9em;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
            z-index: 1000;
        }

        .back-home:hover {
            background: #66bb6a;
            border-color: #66bb6a;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .register-wrapper {
                grid-template-columns: 1fr;
            }

            .register-info {
                padding: 40px 30px;
            }

            .register-info h1 {
                font-size: 2em;
            }

            .register-form-container {
                padding: 40px 30px;
            }

            .password-row,
            .form-row,
            .form-row-three {
                grid-template-columns: 1fr;
            }

            .back-home {
                padding: 8px 15px;
                font-size: 0.85em;
            }
        }
    </style>
</head>
<body>
    <a href="index.php" class="back-home">← Back to Home</a>

    <div class="register-wrapper">
        <!-- Info Section -->
        <div class="register-info">
            <h1>Join Our Team</h1>
            <p>Become part of Football Agent Sierra Leone and take your football career to the next level.</p>
            
            <ul class="register-benefits">
                <li>Professional player representation</li>
                <li>Contract management services</li>
                <li>Talent scouting opportunities</li>
                <li>Career development guidance</li>
                <li>Network with clubs and agents</li>
                <li>Competitive salary negotiations</li>
            </ul>
        </div>

        <!-- Form Section -->
        <div class="register-form-container">
            <h2>Create Account</h2>
            <p class="register-subtitle">Fill in your details below</p>

            <?php if ($message): ?>
                <div class="message <?php echo $message_type; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" id="registerForm">
                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                
                <!-- Basic Info -->
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required placeholder="Choose a username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required placeholder="your@email.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>
                
                <div class="password-row">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required placeholder="Min. 6 characters">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required placeholder="Re-enter password">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="role">Select Your Role:</label>
                    <select id="role" name="role" required onchange="togglePlayerFields()">
                        <option value="">-- Choose Your Role --</option>
                        <option value="player">🏃 Player</option>
                        <option value="agent">👔 Agent</option>
                        <option value="clubmanager">🏟️ Club Manager</option>
                        <option value="admin">👨‍💼 Admin</option>
                    </select>
                </div>

                <!-- Player-specific fields -->
                <div id="playerFields" class="player-fields">
                    <h3>⚽ Player Information</h3>
                    
                    <div class="form-group">
                        <label for="full_name">Full Name:</label>
                        <input type="text" id="full_name" name="full_name" placeholder="Your full name" value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="position">Position:</label>
                            <select id="position" name="position">
                                <option value="">Select position</option>
                                <option value="Goalkeeper">Goalkeeper</option>
                                <option value="Defender">Defender</option>
                                <option value="Midfielder">Midfielder</option>
                                <option value="Forward">Forward</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" id="age" name="age" min="15" max="50" placeholder="Your age" value="<?php echo htmlspecialchars($_POST['age'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nationality">Nationality:</label>
                        <input type="text" id="nationality" name="nationality" placeholder="e.g., Sierra Leone" value="<?php echo htmlspecialchars($_POST['nationality'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-row-three">
                        <div class="form-group">
                            <label for="height">Height (cm):</label>
                            <input type="number" id="height" name="height" min="150" max="220" placeholder="e.g., 185" value="<?php echo htmlspecialchars($_POST['height'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight (kg):</label>
                            <input type="number" id="weight" name="weight" min="50" max="120" placeholder="e.g., 75" value="<?php echo htmlspecialchars($_POST['weight'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="preferred_foot">Preferred Foot:</label>
                            <select id="preferred_foot" name="preferred_foot">
                                <option value="">Select</option>
                                <option value="Right">Right</option>
                                <option value="Left">Left</option>
                                <option value="Both">Both</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="register-btn">🌟 Create Account</button>
            </form>

            <div class="login-link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>

    <script>
        function togglePlayerFields() {
            const role = document.getElementById('role').value;
            const playerFields = document.getElementById('playerFields');
            const playerInputs = playerFields.querySelectorAll('input, select');
            
            if (role === 'player') {
                playerFields.classList.add('active');
                playerInputs.forEach(input => {
                    if (['full_name', 'position', 'age', 'nationality'].includes(input.name)) {
                        input.required = true;
                    }
                });
            } else {
                playerFields.classList.remove('active');
                playerInputs.forEach(input => {
                    input.required = false;
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            togglePlayerFields();
        });
    </script>
</body>
</html>