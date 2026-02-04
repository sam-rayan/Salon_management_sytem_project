<?php
session_start();

// Include the database connection
require_once('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate user input
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $access_code = isset($_POST['access_code']) ? trim($_POST['access_code']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Check if any field is empty
    if (empty($username) || empty($email) || empty($access_code) || empty($password)) {
        echo "All fields are required!";
        exit;
    }

    // Query to find the user by username and email
    $sql = "SELECT * FROM user WHERE username = ? AND email = ?";
    $stmt = $con->prepare($sql);
    
    if ($stmt === false) {
        echo "Error preparing statement: " . $con->error;
        exit;
    }
    
    $stmt->bind_param("ss", $username, $email);

    if (!$stmt->execute()) {
        echo "Error executing query: " . $stmt->error;
        exit;
    }
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify if the password matches the hashed one in the database
        if (password_verify($password, $user['password'])) {

            // Check the access code to determine the role
            if ($access_code === '@0787511711') {
                $_SESSION['role'] = 'admin';
            } elseif ($access_code === '?tonton250') {
                $_SESSION['role'] = 'cashier';
            } else {
                echo "<script>window.alert('Invalid access code!')</script>";
                echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 100);</script>";
                exit;
            }

            // Store other user details in the session
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['last_activity'] = time(); 

            // Regenerate session ID to prevent session fixation
            session_regenerate_id(true);

            // Redirect based on the role
            if ($_SESSION['role'] == 'admin') {
                header('Location: home.php');
            } elseif ($_SESSION['role'] == 'cashier') {
                header('Location: home.php');
            }
            exit;
        } else {
            echo "<script>window.alert('Invalid password!')</script>";
            echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 100);</script>";
        }
    } else {
        echo "<script>window.alert('User not found!')</script>";
        echo "<script>setTimeout(function() { window.location.href = 'signup1.php'; }, 100);</script>";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
