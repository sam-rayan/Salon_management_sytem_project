<?php
$servername = "localhost";
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "salon"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
