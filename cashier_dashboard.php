<?php
// Include session management to check user authentication and role
require('session.php');

// Ensure the user has the 'cashier' role
check_access('cashier');

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
            max-width: 1200px;
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
            margin: 0 15px;
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
            margin-left: 1cm;
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
                    <li><a href="cashier_dashboard.php" class="btn">Home</a></li>
                    <li><a href="income.php" class="btn">Income</a></li>
                    <li><a href="expense.php" class="btn">Expenses</a></li>
                    <li>
                        <a  class="btn">Reports</a>
                        <ul>
                            <li><a class="dropdown-item" href="income_report.php">INCOME</a></li>
                    <li><a href="expense_report.php">EXPENSE</a></li>
                    
                        </ul>
                    </li>
                    <li><a href="logout.php" class="btn">Log out</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="hero">
        <h1><br><br><br>WELCOME</h1>
         
    </div>
    <footer>
        &copy; 2024 IT SAM. &copy; POWERED BY SAM.
    </footer>
</body>
</html>
