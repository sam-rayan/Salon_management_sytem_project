<?php
// Include database connection
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $service = $_POST['service'];
    $amount = $_POST['amount'];
    $phone = $_POST['phone'];
    $date = $_POST['payback_date'];
    $balance = $amount; // Balance is set as the initial amount

    // Prepare the SQL query (Traditional SQL query without prepared statements)
    $query = "INSERT INTO clients (name, service, amount, phone, payback_date, balance) 
              VALUES ('$name', '$service', '$amount', '$phone', '$date', '$balance')";

    // Execute the query
    if ($con->query($query) === TRUE) {
      
        echo "<script>window.alert('Client credit record added successfully.')</script>";
        echo "<script>setTimeout(function() { window.location.href = 'home.php'; }, 1500);</script>";
    } else {
        echo "Error: " . $query . "<br>" . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style5.css">
    <title>Client Credit</title>
</head>
<body>
    <h1>Client Credit</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Client Name" required autocomplete="off">
        <input type="text" name="service" placeholder="Service" required>
        <input type="number" name="amount" placeholder="Amount" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <input type="date" name="payback_date" required>
        <button type="submit">Add Client</button>
    </form>
</body>
</html>
