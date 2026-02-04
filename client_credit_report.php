<?php
include 'db_connection.php';


// Fetch all clients
$clients = $con->query("SELECT * FROM clients");

// Initialize variables for totals
$total_amount_to_be_paid = 0;
$total_amount_paid = 0;

// Check for notifications and calculate totals
$notifications = [];
while ($row = $clients->fetch_assoc()) {
    // Calculate the total amount to be paid (sum of amounts)
    $total_amount_to_be_paid += $row['amount'];

    // Calculate the total amount paid (amount - balance)
    $total_amount_paid += ($row['amount'] - $row['balance']);

    // Check if the payback date has passed and balance is greater than 0
    $due_date = new DateTime($row['payback_date']);
    $today = new DateTime();
    if ($due_date <= $today && $row['balance'] > 0) {
        $notifications[] = "Payment overdue for client: {$row['name']} Tel: {$row['phone']} (Due Date: {$row['payback_date']})";
    }
}

// Reset the result for table display
$clients->data_seek(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style5.css">
    <title>Client Credit Report</title>
</head>
<body>
<div style="margin-top: 20px;">
        <a href="home.php">
            <button style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px;">Go to Home Page</button>
        </a>
    </div>
    <h1>Client Credit Report</h1>
 

    <!-- Display Notifications if there are any -->
    <?php if (!empty($notifications)): ?>
        <div class="notifications" style="background-color: #ffcccc; padding: 10px; border: 1px solid #cc0000; margin: 20px; border-radius: 5px;">
            <h3>Overdue Payment Notifications</h3>
            <ul>
                <?php foreach ($notifications as $note): ?>
                    <li><?= htmlspecialchars($note) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Display Total Amounts -->
    <div class="totals" style="margin: 20px; padding: 10px; border: 1px solid #333; border-radius: 5px;">
        <h3>Total Amount Report</h3>
        <p><strong>Total Amount to Be Paid: </strong><?= number_format($total_amount_to_be_paid, 2) ?> </p>
        <p><strong>Total Amount Paid: </strong><?= number_format($total_amount_paid, 2) ?></p>
    </div>

    <!-- Client Table Display -->
    <table>
        <tr>
            <th>Client Name</th>
            <th>Service</th>
            <th>Amount</th>
            <th>Balance</th>
            <th>Phone</th>
            <th>Payback Date</th>
            <th>Paid Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $clients->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['service']) ?></td>
            <td><?= htmlspecialchars($row['amount']) ?></td>
            <td><?= htmlspecialchars($row['balance']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['payback_date']) ?></td>
            <td><?= htmlspecialchars($row['paid_date'] ?? 'Not Paid') ?></td>
            <td>
                <form method="POST" action="process_payment.php">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                    <input type="number" name="amount_paid" placeholder="Amount Paid" required>
                    <button type="submit">Confirm Payment</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Button to go to Home Page -->
 
</body>
</html>
