
<?php
// index.php or any other pag('session.php');
include 'session.php';

check_access();

include 'db_connection.php';  // Include your DB connection
include 'notifications.php';  // Include the notification logic

// Get overdue notifications
$notifications = checkOverdueNotifications($con);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML and CSS Dropdown Menu Examples</title>
    <style>
        /* Base styles */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-image: url(1.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            color: #232323;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: white;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1300px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #232323;
        }

        nav {
            display: flex;
            align-items: center;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            position: relative;
            margin: 0 12px;
        }

        nav ul li a {
            text-decoration: none;
            color: #232323;
            font-weight: bold;
            padding: 5px 10px;
        }

        nav ul li:hover > ul {
            display: block;
        }

        /* Dropdown menu */
        nav ul li ul {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            list-style: none;
            margin: 0;
            padding: 10px 0;
        }

        nav ul li ul li {
            margin: 0;
        }

        nav ul li ul li a {
            display: block;
            padding: 20px 30px;
            white-space: nowrap;
        }

        nav ul li ul li a:hover {
            background: #f0f0f0;
        }

        .hero {
            text-align: center;
            padding: 50px 20px;
            flex-grow: 1;
        }

        .hero h1 {
            font-size: 36px;
            margin-bottom: 50px;
            color: white;
        }

        .hero p {
            font-size: 18px;
            color: #555555;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #00c0ff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-left: 0.5cm;
        }

        .btn:hover {
            background: #009fcf;
        }

        footer {
            color: white;
            background-color: #0B1124;
            text-align: center;
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">Tonton Natural Hair Saloon</div>
            <nav>
                <ul>
                    <li><a href="admin_dashboard.php" class="btn">Home</a></li>
                    <li><a href="income.php" class="btn">Income</a></li>
                    <li><a href="expense.php" class="btn">Expenses</a></li>
                    <li>
                        <a  class="btn">Credit</a>
                        <ul>
                            <li><a class="dropdown-item" href="client_credit.php">Clients Credits</a></li>
                    <li><a href="Workers_credit.php">Workers Credits</a></li>
                    <li><a href="client_credit_report.php">Client Credit Report</a></li>
                    <li><a href="workers_credit_report.php">Workers Credit Report</a></li>
                    
                        </ul>
                    </li>
                    <li>
                        <a  class="btn">Reports</a>
                        <ul>
                            <li><a class="dropdown-item" href="income_report.php">INCOME</a></li>
                    <li><a href="expense_report.php">EXPENSE</a></li>
                    <li><a href="update_income_report.php">CHANGED INCOME REPORT</a></li>
                    <li><a href="update_expense_report.php">CHANGED EXPENSE REPORT</a></li>
                    <li><a href="balance.php">BALANCE</a></li>
                        </ul>
                    </li>
                    <li><a href="logout.php" class="btn">Log out</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="hero">
        <h1><br><br><br>WELCOME</h1>

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
         
    </div>
    <footer>
        &copy; 2024 IT SAM. &copy; POWERED BY SAM.
    </footer>
</body>
</html>

