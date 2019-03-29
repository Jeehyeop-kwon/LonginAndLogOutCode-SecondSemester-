<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title> Project One </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="cssFile/main.css">
</head>
<body class="w3-container w3-center">
	<header class="w3-container w3-center">

		<div class="w3-bar w3-text-white w3-margin-top w3-align-left">

		<?php 
			if (!empty($_SESSION['user_id'])) { 
		?>
		  <a href="movies.php" class="w3-bar-item w3-button w3-mobile">Movies</a>
		  <a href="books.php" class="w3-bar-item w3-button w3-mobile">Books</a>
		  <a href="logout.php" class="w3-bar-item w3-button w3-mobile">Log out</a>
		

		<?php 
			} else { 
		?>			
			<a href="register.php" class="w3-bar-item w3-button w3-mobile">Register</a>
			<a href="login.php" class="w3-bar-item w3-button w3-mobile" >Login</a>
		<?php 
			} 
		?>
		</div>

		<h1 class="w3-text-white"> <?php echo $page_title ?>	</h1>

	</header>
	<main class="w3-container">
		<div class="w3-card-4 w3-blue w3-padding-top w3-center">