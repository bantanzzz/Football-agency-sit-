<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include 'includes/session.php';
include 'includes/auth.php';
include 'includes/functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verify CSRF token
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $message = 'Invalid request. Please try again.';
    } else {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        if (login_user($username, $password)) {
            // Redirect based on role
            $role = $_SESSION['role'];
            switch ($role) {
                case 'admin':
                    header('Location: admin.php');
                    break;
                case 'agent':
                    header('Location: agent.php');
                    break;
                case 'clubmanager':
                    header('Location: clubManager.php');
                    break;
                case 'player':
                    header('Location: player.php');
                    break;
                default:
                    header('Location: index.php');
            }
            exit();
        } else {
            $message = 'Invalid username or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FootballAgent</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #fff;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }
        .form-group input::placeholder {
            color: #ddd;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #66bb6a;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background: #43a047;
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .message {
            text-align: center;
            margin-bottom: 20px;
            color: #ff6b6b;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        .register-link a {
            color: #66bb6a;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
            color: #43a047;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            <div class="form-group">
                <label for="username">Username or Email:</label>
                <input type="text" id="username" name="username" required placeholder="Enter your username or email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>