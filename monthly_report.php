<?php
require('session.php');
// Include the database connection
include('db_connection.php');

// Get the current month and year in 'Y-m' format (e.g., '2024-12')
$currentMonth = date('Y-m');

// Define variables for filtering by name
$searchName = isset($_POST['search_name']) ? $_POST['search_name'] : '';

// SQL to fetch records for the current month
$sql = "SELECT * FROM income_details WHERE DATE_FORMAT(dte, '%Y-%m') = '$currentMonth'";
$result = $con->query($sql);

// Calculate the total money for the current month
$totalMoney = 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $totalMoney += $row['money'];
    }
}

// HTML to display the monthly report
echo "<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <title>Monthly Report</title>
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
    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }
    th, td {
      text-align: center;
      padding: 12px;
      border: 1px solid #ddd;
    }
    th {
      background-color: #4CAF50;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    tr:hover {
      background-color: #ddd;
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
    <h2>Monthly Report for " . date('F Y') . "</h2>";

       // Search Form
    echo "<div class='search-container'>
            <form method='POST' action=''>
              <input type='text' name='search_name' placeholder='Search by name' value='$searchName'>
              <button type='submit'>Search</button>
            </form>
          </div>";

    if ($result->num_rows > 0) {
        // Display the data in a table
        echo "<table border='1' cellpadding='10'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Service</th>
                    <th>Money</th>
                    <th>Method</th>
                    <th>Date</th>
                </tr>";

        // Reset the result pointer to fetch all records again for display
        $result->data_seek(0);
        
        // Output data for each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['bname'] . "</td>
                    <td>" . $row['service'] . "</td>
                    <td>" . $row['money'] . "</td>
                    <td>" . $row['method'] . "</td>
                    <td>" . $row['dte'] . "</td>
                  </tr>";
        }
        echo "</table>";

        // Display the total money for the month
        echo "</table>
              <div class='total'>Total Money for the Month: " . number_format($totalMoney, 2) . "</div>";
    } else {
        echo "<p>No records found for this month.</p>";
    }

    // Close the database connection
    $con->close();

    echo "</div>
    </body>
    </html>";
?>
