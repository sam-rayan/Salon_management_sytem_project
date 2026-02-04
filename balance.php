<?php

require('session.php');
check_access('admin');

// Include the database connection
require('db_connection.php');

// Initialize balance to 0
$balance = 0;

// Calculate total income
$income_sql = "SELECT SUM(money) as total_income FROM income_details";
$income_result = $con->query($income_sql);
if ($income_result->num_rows > 0) {
    $income_data = $income_result->fetch_assoc();
    $totalIncome = $income_data['total_income'];
    $balance += $totalIncome;  // Add income to balance
}

// Calculate total expense
$expense_sql = "SELECT SUM(money) as total_expense FROM expense_details";
$expense_result = $con->query($expense_sql);
if ($expense_result->num_rows > 0) {
    $expense_data = $expense_result->fetch_assoc();
    $totalExpense = $expense_data['total_expense'];
    $balance -= $totalExpense;  // Subtract expense from balance
}

// Calculate client payments (money paid)
$clients = $con->query("SELECT * FROM clients");

$total_amount_paid = 0; // Initialize total amount paid
while ($row = $clients->fetch_assoc()) {
    // Add the amount paid to the total
    $total_amount_paid += ($row['amount'] - $row['balance']); // Amount paid is 'amount' - 'balance'
}

// Add the total amount paid by clients to the balance
$balance += $total_amount_paid;

// Display the balance report
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Balance Report</title>
    <link rel='stylesheet' href='style.css'>
    <style>
        body {
            font-family: 'Jost', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }
        .report-container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .balance {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
        .total {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class='report-container'>
        <h2>Balance Report</h2>
       
        <div class='total'>
            <p style='color:green;'>Total Income: " . number_format($totalIncome, 2) . "Frw</p>
            <p style='color:red;'>Total Expense: " . number_format($totalExpense, 2) . "Frw</p>
            <p style='color:blue;'>Total Client Credits Payments: " . number_format($total_amount_paid, 2) . "Frw</p>
        </div>
         <div class='balance'>
            <p><b>Final Balance: " . number_format($balance, 2) . "Frw</b></p>
        </div>
        <div style='margin-top: 20px;'>
        <a href='home.php'>
            <button style='padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px;'>Go to Home Page</button>
        </a>
    </div>
    </div>
</body>
</html>";

$con->close();

?>
