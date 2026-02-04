<?php
require('session.php');
include('db_connection.php');

// Check if ID is passed
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Fetch the current data from expense_details
    $sql = "SELECT * FROM expense_details WHERE id = $id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Save the current record to the 'updated' table
        $sql_insert = "INSERT INTO eupdated (bname, service, money, method, dte)
                       VALUES ('" . $row['bname'] . "', '" . $row['service'] . "', " . $row['money'] . ", '" . $row['method'] . "', '" . $row['dte'] . "')";
        $con->query($sql_insert);

        // Now update the record in the original table (example: changing the name or money)
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_bname'])) {
            $new_bname = $_POST['new_bname'];
            $new_money = $_POST['new_money'];
            $new_method = $_POST['new_method'];

            // Update the record in expense_details table
            $sql_update = "UPDATE expense_details SET bname = '$new_bname', money = '$new_money', method = '$new_method' WHERE id = $id";
            $con->query($sql_update);

            // Redirect back to the report page
            echo "<script>window.location.href = 'cashier_dashboard.php';</script>";
        }

        // Display update form
        echo "<form method='POST'>
                <input type='hidden' name='id' value='" . $row['id'] . "'>
                Name: <input type='text' name='new_bname' value='" . $row['bname'] . "'><br>
                Money: <input type='number' name='new_money' value='" . $row['money'] . "'><br>
                Method: <input type='text' name='new_method' value='" . $row['method'] . "'><br>
                <button type='submit' name='submit'>Update</button>
              </form>";

    } else {
        echo "No record found.";
    }
}

$con->close();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Sign up / Login Form</title>
  <link rel="stylesheet" href="./style1.css">
  <style>
  	body
  	{
  		color: white;
  		text-align: center;
  	}
  	
  	button
    {
        color:white;
        background-color:chocolate;
    }
  </style>

</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
</body></html