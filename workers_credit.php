<?php
// Insert worker credit details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connection.php'; // Include your database connection

    $worker_name = $_POST['worker_name'];
    $amount = $_POST['amount'];
    $phone_number = $_POST['phone_number'];
    $date = $_POST['date'];
    $rate_per_month = $_POST['rate_per_month'];
    $notes = $_POST['notes'];

    // Insert the new worker credit into the database
    $sql = "INSERT INTO worker_credits (worker_name, amount, phone_number, date, rate_per_month, balance, notes)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssssss", $worker_name, $amount, $phone_number, $date, $rate_per_month, $amount, $notes);
    if ($stmt->execute()) {
        
        echo "<script>window.alert('Worker credit added successfully!')</script>";
        echo "<script>setTimeout(function() { window.location.href = 'home.php'; }, 1000);</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style5.css">
    <title>Credit for Workers</title>
</head>
<body>
    <h1>Insert Credit for Workers</h1>
    <form method="POST" action="">
        <label for="worker_name">Worker Name:</label>
        <input type="text" id="worker_name" name="worker_name" required><br><br>
        
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" step="0.01" required><br><br>
        
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required><br><br>
        
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>
        
        <label for="rate_per_month">Rate per Month:</label>
        <input type="number" id="rate_per_month" name="rate_per_month" step="0.01" required><br><br>
        
        <label for="notes">Notes (Optional):</label>
        <textarea id="notes" name="notes"></textarea><br><br>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
