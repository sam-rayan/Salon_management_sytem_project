<?php
// Fetch worker credit details
include 'db_connection.php'; 
require('session.php');

check_access('admin'); // Ensure the user has admin access

// Fetch worker credit details
$sql = "SELECT * FROM worker_credits";
$result = $con->query($sql);

// Handle payment confirmation (automatically set amount paid to rate per month)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_payment'])) {
    $id = $_POST['id'];
    
    // Fetch the worker's rate per month and balance
    $stmt = $con->prepare("SELECT rate_per_month, balance FROM worker_credits WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($rate_per_month, $balance);
    $stmt->fetch();

    // Set the amount paid to the rate per month (if balance is greater than rate)
    $amount_paid = min($rate_per_month, $balance);  // Ensure the payment does not exceed the remaining balance

    // Close the first prepared statement
    $stmt->close();

    // Update the worker credit record
    $sql_update = "UPDATE worker_credits SET balance = balance - ?, paid_date = NOW() WHERE id = ?";
    $stmt_update = $con->prepare($sql_update);
    $stmt_update->bind_param("di", $amount_paid, $id);

    if ($stmt_update->execute()) {
        
        echo "<script>window.alert('Payment confirmed successfully!')</script>";
                echo "<script>setTimeout(function()
                 { window.location.href = 'workers_credit_report.php'; }, 100);</script>";
    } else {
        echo "Error: " . $stmt_update->error;
    }

    // Close the second prepared statement
    $stmt_update->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style5.css">
    <title>Worker Credit Report</title>
</head>
<body>
<div style="margin-top: 20px;">
    <a href="home.php">
        <button style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px;">Go to Home Page</button>
    </a>
</div>

<h1>Worker Credit Report</h1>

<table border="1">
    <tr>
        <th>Worker Name</th>
        <th>Amount</th>
        <th>Phone Number</th>
        <th>Date Issued</th>
        <th>Rate per Month</th>
        <th>Balance</th>
        <th>Action</th>
    </tr>
    
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['worker_name']) ?></td>
        <td><?= number_format($row['amount'], 2) ?></td>
        <td><?= htmlspecialchars($row['phone_number']) ?></td>
        <td><?= htmlspecialchars($row['date']) ?></td>
        <td><?= number_format($row['rate_per_month'], 2) ?></td>
        <td><?= number_format($row['balance'], 2) ?></td>
        <td>
            <!-- Form to confirm payment -->
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button type="submit" name="confirm_payment">Confirm Payment (<?= number_format($row['rate_per_month'], 2) ?>)</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
