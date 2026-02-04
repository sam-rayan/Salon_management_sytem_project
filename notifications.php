<?php
// notifications.php

function checkOverdueNotifications($con) {
    // Fetch all clients
    $clients = $con->query("SELECT * FROM clients");

    // Initialize an array for notifications
    $notifications = [];

    // Loop through each client to calculate totals and check for overdue payments
    while ($row = $clients->fetch_assoc()) {
        // Check if the payback date has passed and balance is greater than 0
        $due_date = new DateTime($row['payback_date']);
        $today = new DateTime();
        if ($due_date <= $today && $row['balance'] > 0) {
            $notifications[] = "Payment overdue for client: {$row['name']} Tel: {$row['phone']} (Due Date: {$row['payback_date']})";
        }
    }

    // Return the array of notifications
    return $notifications;
}
