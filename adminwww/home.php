<!DOCTYPE html>
<html lang="en">

<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
?>

<head>

	<!-- Basic Page metadata -->
	<meta charset="utf-8">
	<title>COSC349 Assignment 1</title>
	<meta name="description" content="COSC349 Assignment 1">
	<meta name="author" content="Hayden McAlister">

	<!-- CSS references: from SkeletonCSS -->
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">

</head>


<body>
	<?php $page_name = "Home";
	include 'header.php'; ?>
    <?php include 'footer.php'?>
</body>

</html>