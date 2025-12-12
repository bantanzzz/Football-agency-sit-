<?php

$base_dir = dirname(__FILE__);


if (file_exists($base_dir . '/db.php')) {
    include $base_dir . '/db.php';
} else {
    die("Database connection file not found.");
}


function login_user($username, $password) {
    global $conn;

    if (!$conn) {
        return false;
    }

    try {
        $stmt = mysqli_prepare($conn, "SELECT id, username, password, role FROM User WHERE username = ? OR email = ? LIMIT 1");
        
        if ($stmt === false) {
            return false;
        }
        
        mysqli_stmt_bind_param($stmt, "ss", $username, $username);
        
        if (!mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            return false;
        }
        
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                
                if (function_exists('regenerate_session')) {
                    regenerate_session();
                } else {
                    session_regenerate_id(true);
                }
                
                mysqli_stmt_close($stmt);
                return true;
            }
        }
        
        mysqli_stmt_close($stmt);
        return false;
    } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage());
        return false;
    }
}


function register_user($data) {
    global $conn;

    if (!$conn) {
        return false;
    }

    try {
        $username = mysqli_real_escape_string($conn, $data['username']);
        $email = mysqli_real_escape_string($conn, $data['email']);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $role = mysqli_real_escape_string($conn, $data['role']);

        
        $check_stmt = mysqli_prepare($conn, "SELECT id FROM User WHERE username = ? OR email = ? LIMIT 1");
        mysqli_stmt_bind_param($check_stmt, "ss", $username, $email);
        mysqli_stmt_execute($check_stmt);
        $check_result = mysqli_stmt_get_result($check_stmt);
        
        if (mysqli_num_rows($check_result) > 0) {
            mysqli_stmt_close($check_stmt);
            return false; 
        }
        mysqli_stmt_close($check_stmt);

        
        $stmt = mysqli_prepare($conn, "INSERT INTO User (username, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())");
        
        if ($stmt === false) {
            return false;
        }
        
        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $password, $role);

        if (mysqli_stmt_execute($stmt)) {
            $user_id = mysqli_insert_id($conn);

        
            if ($role === 'player' && isset($data['full_name'])) {
                $full_name = mysqli_real_escape_string($conn, $data['full_name']);
                $position = isset($data['position']) ? mysqli_real_escape_string($conn, $data['position']) : null;
                $age = isset($data['age']) ? intval($data['age']) : null;
                $nationality = isset($data['nationality']) ? mysqli_real_escape_string($conn, $data['nationality']) : null;
                $height = isset($data['height']) ? intval($data['height']) : null;
                $weight = isset($data['weight']) ? intval($data['weight']) : null;
                $preferred_foot = isset($data['preferred_foot']) ? mysqli_real_escape_string($conn, $data['preferred_foot']) : null;
                
                $player_stmt = mysqli_prepare($conn, "INSERT INTO Player (user_id, name, position, age, nationality, height, weight, preferred_foot, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                
                if ($player_stmt !== false) {
                    mysqli_stmt_bind_param($player_stmt, "issisiis", $user_id, $full_name, $position, $age, $nationality, $height, $weight, $preferred_foot);
                    mysqli_stmt_execute($player_stmt);
                    mysqli_stmt_close($player_stmt);
                }
            }
            
            
            if ($role === 'agent') {
                $agent_name = isset($data['full_name']) ? mysqli_real_escape_string($conn, $data['full_name']) : $username;
                $agent_stmt = mysqli_prepare($conn, "INSERT INTO Agent (user_id, name, created_at) VALUES (?, ?, NOW())");
                
                if ($agent_stmt !== false) {
                    mysqli_stmt_bind_param($agent_stmt, "is", $user_id, $agent_name);
                    mysqli_stmt_execute($agent_stmt);
                    mysqli_stmt_close($agent_stmt);
                }
            }
            
          
            if ($role === 'clubmanager') {
                $club_name = isset($data['club_name']) ? mysqli_real_escape_string($conn, $data['club_name']) : $username;
                $club_stmt = mysqli_prepare($conn, "INSERT INTO Club (user_id, name, manager_name, created_at) VALUES (?, ?, ?, NOW())");
                
                if ($club_stmt !== false) {
                    mysqli_stmt_bind_param($club_stmt, "iss", $user_id, $club_name, $club_name);
                    mysqli_stmt_execute($club_stmt);
                    mysqli_stmt_close($club_stmt);
                }
            }
            
            mysqli_stmt_close($stmt);
            return true;
        }
        
        mysqli_stmt_close($stmt);
        return false;
    } catch (Exception $e) {
        error_log("Registration error: " . $e->getMessage());
        return false;
    }
}


function logout_user() {
    if (isset($_SESSION['user_id'])) {
        unset($_SESSION['user_id']);
    }
    if (isset($_SESSION['username'])) {
        unset($_SESSION['username']);
    }
    if (isset($_SESSION['role'])) {
        unset($_SESSION['role']);
    }
    
    if (function_exists('destroy_session')) {
        destroy_session();
    } else {
        session_unset();
        session_destroy();
    }
}


function is_logged_in() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}


function check_role($required_role) {
    if (!is_logged_in()) {
        return false;
    }
    return isset($_SESSION['role']) && $_SESSION['role'] === $required_role;
}


function get_user_id() {
    return $_SESSION['user_id'] ?? null;
}


function get_user_role() {
    return $_SESSION['role'] ?? null;
}


function get_username() {
    return $_SESSION['username'] ?? null;
}


function get_user_data($user_id) {
    global $conn;

    if (!$conn) {
        return null;
    }

    try {
        $stmt = mysqli_prepare($conn, "SELECT id, username, email, role, created_at FROM User WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        
        return $user;
    } catch (Exception $e) {
        error_log("Get user error: " . $e->getMessage());
        return null;
    }
}

/**
 * Update user email
 * @param int $user_id User ID
 * @param string $email New email
 * @return bool True if update successful, false otherwise
 */
function update_user_email($user_id, $email) {
    global $conn;

    if (!$conn) {
        return false;
    }

    try {
        $email = mysqli_real_escape_string($conn, $email);
        $stmt = mysqli_prepare($conn, "UPDATE User SET email = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $email, $user_id);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        return $result;
    } catch (Exception $e) {
        error_log("Update email error: " . $e->getMessage());
        return false;
    }
}


function change_password($user_id, $old_password, $new_password) {
    global $conn;

    if (!$conn) {
        return false;
    }

    try {
     
        $stmt = mysqli_prepare($conn, "SELECT password FROM User WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            mysqli_stmt_close($stmt);
            
            
            if (password_verify($old_password, $row['password'])) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                
                $update_stmt = mysqli_prepare($conn, "UPDATE User SET password = ? WHERE id = ?");
                mysqli_stmt_bind_param($update_stmt, "si", $hashed_password, $user_id);
                $update_result = mysqli_stmt_execute($update_stmt);
                mysqli_stmt_close($update_stmt);
                
                return $update_result;
            }
        }
        
        mysqli_stmt_close($stmt);
        return false;
    } catch (Exception $e) {
        error_log("Change password error: " . $e->getMessage());
        return false;
    }
}

/**
 * Get player profile
 * @param int $user_id User ID
 * @return array|null Player data or null if not found
 */
function get_player_profile($user_id) {
    global $conn;

    if (!$conn) {
        return null;
    }

    try {
        $stmt = mysqli_prepare($conn, "SELECT * FROM Player WHERE user_id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $player = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        
        return $player;
    } catch (Exception $e) {
        error_log("Get player profile error: " . $e->getMessage());
        return null;
    }
}

/**
 * Update player profile
 * @param int $user_id User ID
 * @param array $data Player data to update
 * @return bool True if update successful, false otherwise
 */
function update_player_profile($user_id, $data) {
    global $conn;

    if (!$conn) {
        return false;
    }

    try {
        $name = isset($data['name']) ? mysqli_real_escape_string($conn, $data['name']) : null;
        $position = isset($data['position']) ? mysqli_real_escape_string($conn, $data['position']) : null;
        $age = isset($data['age']) ? intval($data['age']) : null;
        $nationality = isset($data['nationality']) ? mysqli_real_escape_string($conn, $data['nationality']) : null;
        $height = isset($data['height']) ? intval($data['height']) : null;
        $weight = isset($data['weight']) ? intval($data['weight']) : null;
        $preferred_foot = isset($data['preferred_foot']) ? mysqli_real_escape_string($conn, $data['preferred_foot']) : null;
        $club = isset($data['club']) ? mysqli_real_escape_string($conn, $data['club']) : null;
        
        $stmt = mysqli_prepare($conn, "UPDATE Player SET name = ?, position = ?, age = ?, nationality = ?, height = ?, weight = ?, preferred_foot = ?, club = ? WHERE user_id = ?");
        
        if ($stmt !== false) {
            mysqli_stmt_bind_param($stmt, "ssisissi", $name, $position, $age, $nationality, $height, $weight, $preferred_foot, $club, $user_id);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            
            return $result;
        }
        
        return false;
    } catch (Exception $e) {
        error_log("Update player profile error: " . $e->getMessage());
        return false;
    }
}

/**
 * Get agent data
 * @param int $user_id User ID
 * @return array|null Agent data or null if not found
 */
function get_agent_data($user_id) {
    global $conn;

    if (!$conn) {
        return null;
    }

    try {
        $stmt = mysqli_prepare($conn, "SELECT * FROM Agent WHERE user_id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $agent = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        
        return $agent;
    } catch (Exception $e) {
        error_log("Get agent data error: " . $e->getMessage());
        return null;
    }
}

/**
 * Get club data
 * @param int $user_id User ID
 * @return array|null Club data or null if not found
 */
function get_club_data($user_id) {
    global $conn;

    if (!$conn) {
        return null;
    }

    try {
        $stmt = mysqli_prepare($conn, "SELECT * FROM Club WHERE user_id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $club = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        
        return $club;
    } catch (Exception $e) {
        error_log("Get club data error: " . $e->getMessage());
        return null;
    }
}
?>