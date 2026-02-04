<?php
session_start();

// Set session lifetime (in seconds). For example, 10 minutes = 600 seconds.
$session_lifetime = 600;  // 10 minutes

// Check if the session variable 'last_activity' is set and handle session expiry
if (isset($_SESSION['last_activity'])) {
    $session_duration = time() - $_SESSION['last_activity'];  // Time since last activity
    if ($session_duration > $session_lifetime) {
        // Session has expired, log the user out
        session_unset();
        session_destroy();
        header('Location: index.php');  // Redirect to login page
        exit;  // Ensure no further script execution
    }
}

// Update last activity time for session timeout tracking
$_SESSION['last_activity'] = time();

// Function to check if the user is logged in and has the required role
function check_access($required_role = null) {
    // Check if the session is not set (user is not logged in)
    if (!isset($_SESSION['username'])) {
        // Redirect to login page if not logged in
        header('Location: index.php');
        exit;
    }

    // If a specific role is required, check if the user's role matches
    if ($required_role && $_SESSION['role'] !== $required_role) {
        echo "<script>alert('Access denied: You do not have permission to view this page.');</script>";
        
        // Redirect to a safe page (e.g., home) after alert
        echo "<script>setTimeout(function() { window.location.href = 'home.php'; }, 100);</script>";
        exit;
    }
}

// Logout functionality (moves to a separate logout file)
function logout() {
    session_unset();  // Unset all session variables
    session_destroy();  // Destroy the session
    header('Location: index.php');  // Redirect to login page
    exit;  // Ensure no further script execution
}

// Optionally, prevent page caching after logout (helps to avoid the back button issue)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

?>
