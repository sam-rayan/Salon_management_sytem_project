<?php
require('session.php');

check_access('admin');
// Include the database connection
include('db_connection.php');

// Define variables for filtering by name and date
$searchName = isset($_POST['search_name']) ? $_POST['search_name'] : '';
$selectedDate = isset($_POST['selected_date']) ? $_POST['selected_date'] : '';

// Get today's date in 'Y-m-d' format and current month in 'Y-m' format
$today = date('Y-m-d');
$currentMonth = date('Y-m');

// SQL to fetch records, optionally filtered by name
$sql = "SELECT * FROM eupdated WHERE bname LIKE '%$searchName%'";
$result = $con->query($sql);

// Calculate the total money
$totalMoney = 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $totalMoney += $row['money'];
    }
}

// HTML to display the report
echo "<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <title>Changed Expenses Report</title>
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

    .search-container {
      margin: 20px 0;
      text-align: center;
    }

    .total {
      font-size: 20px;
      font-weight: bold;
      text-align: center;
      margin-top: 20px;
    }
     .tabs {
      text-align: center;
      margin-top: 20px;
    }

    .tabs a {
      margin: 0 15px;
      padding: 15px 20px;
      background-color: #4CAF50;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

    .tabs a:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class='report-container'>
    <h2>Changed Expenses Report</h2>";

    // Search and Date Selection Form
    echo "<div class='search-container'>
            <form method='POST' action=''>
              <input type='text' name='search_name' placeholder='Search by name' value='$searchName'>
              <input type='date' name='selected_date' value='$selectedDate'>
              <button type='submit'>Search</button>
            </form>
          </div>";
    echo "<div class='tabs'>
            <a href='e_monthly_report.php'>Monthly Report</a>
          </div>";

    // Heading showing today's date and the name being searched
    $todayFormatted = date('F j, Y'); // E.g., December 20, 2024

    // If a specific date is selected, use that date in the heading
    if ($selectedDate) {
        echo "<h3>Report for $selectedDate</h3>";
    } elseif ($searchName) {
        echo "<h3>Report for $searchName on $todayFormatted</h3>";
    } else {
        echo "<h3>Full Report</h3>";
    }

    // Display the full-time report (all records)
    $sql_all = "SELECT * FROM eupdated WHERE bname LIKE '%$searchName%'";
    $result_all = $con->query($sql_all);

    if ($result_all->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Service/Product</th>
                    <th>Money</th>
                    <th>Method</th>
                    <th>Date</th>
                    
                </tr>";

        while($row = $result_all->fetch_assoc()) {
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
    } else {
        echo "<p>No records found.</p>";
    }

    // Close the database connection
    $con->close();

    echo "</div></body></html>";
?>
