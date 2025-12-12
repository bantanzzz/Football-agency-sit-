<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to regenerate session ID for security
function regenerate_session() {
    session_regenerate_id(true);
}

// Function to destroy session
function destroy_session() {
    session_unset();
    session_destroy();
}
?>