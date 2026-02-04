<?php
// Include the database connection file
include('db_connection.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $bname = mysqli_real_escape_string($con, $_POST['bname']);
    $service = mysqli_real_escape_string($con, $_POST['service']);
    $money = mysqli_real_escape_string($con, $_POST['money']);
    $method = mysqli_real_escape_string($con, $_POST['method']); // Momo or Cash

    // Validate inputs
    if (empty($bname) || empty($service) || empty($money) || empty($method)) {
        echo "All fields are required!";
    } else {
        // Prepare the SQL query to insert data into the database
        $sql = "INSERT INTO expense_details (bname, service, money, method) 
                VALUES ('$bname', '$service', '$money', '$method')";

       if ($con->query($sql) === TRUE) {
    // Output JavaScript for the alert
    echo "<script>alert('Record added successfully!');</script>";
    
    // Redirect after a short delay (e.g., 2 seconds)
    echo "<script>setTimeout(function() { window.location.href = 'home.php'; }, 100);</script>";
} else {
    // In case of error, display the error message
    echo "Error: " . $sql . "<br>" . $con->error;
}
    }
}

// Close the database connection (optional, but good practice)
$con->close();
?>
