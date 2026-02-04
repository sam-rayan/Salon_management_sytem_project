<?php
// Start the session
session_start();

// Include the database connection
include('db_connection.php');

// Define the correct access codes
$correct_access_code_owner = 'ADMIN-250-SALON';
$correct_access_code_cashier = 'TONTON-250-SALON';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $access_code = $_POST['access_code'];
    $access_code=$correct_access_code_owner;
    $access_code=$correct_access_code_cashier;

    // Check if the position is "Owner" or "Cashier" and validate the corresponding access code
    if (($position == 'owner' && $access_code !== $correct_access_code_owner) || 
        ($position == 'cashier' && $access_code !== $correct_access_code_cashier)) {
        
        // If the access code is incorrect for the specified position
        echo "Error: Incorrect access code for " . ucfirst($position) . ". You are not able to create an account.";
    } else {
        
            // Prepare the SQL statement for inserting the user into the database
            $stmt = $con->prepare("INSERT INTO users (name, position, password, access_code) 
                                   VALUES (?, ?, ?, ?)");
            // Bind parameters
            $stmt->bind_param("ssss", $name, $position, $password, $access_code); // "ssss" indicates 4 string parameters

            // Execute the statement
            $stmt->execute();

            // Redirect to the login page after successful registration
            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

?>
