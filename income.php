<?php
require('session.php');
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Sign up / Login Form</title>
  <link rel="stylesheet" href="./style1.css">
  <style>
  	P
  	{
  		color: white;
  		text-align: center;
  	}
  	.gender
  	{
  		text-align: center;
  		color: white;
  		font-size: 12px;
  		margin:auto;
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
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form method="POST" action="submit1.php">
					<label for="chk" aria-hidden="true">INCOME</label>
					<p>Name</p><input type="text" name="bname" placeholder="Name" required="">
					<p>Service</p><input type="text" name="service" placeholder="Service" required="">
					<p>Money</p><input type="number" name="money" placeholder="Money" required="">
					<p>Method</p>
					<div class="gender">	
					 MOMO
            <input type="radio" name="method" value="momo">
        CASH
            <input type="radio" name="method" value="cash">
        </div>
					<button>ADD</button>
				</form>
			</div>

			
	</div>
</body>
</html>
<!-- partial -->
  
</body>
</html>
