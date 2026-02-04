<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['amount_paid'])) {
    $id = $_POST['id'];
    $amount_paid = $_POST['amount_paid'];

    // Fetch the current balance
    $result = $con->query("SELECT balance FROM clients WHERE id = $id");
    $client = $result->fetch_assoc();

    if ($client) {
        $new_balance = max(0, $client['balance'] - $amount_paid); // Ensure balance doesn't go below zero
        $paid_date = date('Y-m-d');

        // Update the client's record
        $stmt = $con->prepare("UPDATE clients SET balance = ?, paid_date = ? WHERE id = ?");
        $stmt->bind_param("dsi", $new_balance, $paid_date, $id);
        if ($stmt->execute()) {
            echo "Payment confirmed and balance updated successfully.";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Client not found.";
    }
} else {
    echo "Invalid request.";
}

header("Location: client_credit_report.php");
exit();
?>
