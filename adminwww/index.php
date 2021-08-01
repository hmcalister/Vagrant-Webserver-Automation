<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Basic Page metadata -->
	<meta charset="utf-8">
	<title>Admin - Login</title>
	<meta name="description" content="COSC349 Assignment 1">
	<meta name="author" content="Hayden McAlister">

	<!-- CSS references: from SkeletonCSS -->
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">

</head>

<body>
	<?php $page_name = "Login";
	include 'header.php'; ?>
	<form action="authenticate.php" method="post">
		<div class="container">
			<div class="row">
				<div class="five columns">
					<input type="text" name="username" placeholder="Username" id="username" required>
				</div>
				<div class="offset-by-two columns five columns">
					<input type="password" name="password" placeholder="Password" id="password" required>
				</div>
			</div>
			<div class="row">
				<div class="offset-by-two columns eight">
					<input type="submit" value="Login">
				</div>
			</div>
		</div>
	</form>


</body>

</html>