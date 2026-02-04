<?php
session_start();
require('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $position = $_POST['position'];
    $password = $_POST['password'];

    try {
        $stmt = $con->prepare("SELECT * FROM users WHERE position = ?");
        $stmt->bind_param("s", $position);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['position'] = $user['position'];

            session_regenerate_id(true);

            // Redirect based on position
            header("Location: home.php");
            exit();
        } else {
            echo "<script>window.alert('Incorrect position or password.')</script>";
            echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 1000);</script>";
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo "An error occurred. Please try again later.";
    }
}
?>
