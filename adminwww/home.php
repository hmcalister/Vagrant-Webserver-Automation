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
    <title>Admin - Home</title>
    <meta name="description" content="COSC349 Assignment 1">
    <meta name="author" content="Hayden McAlister">

    <!-- CSS references: from SkeletonCSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">

</head>


<body>
    <?php $page_name = "Home";
    include 'header.php'; ?>
    <div class="container" id="main">
        <div class="row">
            <a href="sql.php">
                <div class="four columns">
                    <div class="admin-section-button">
                        <h4>SQL Input</h4>
                        <img src="images/database.png">
                    </div>
                </div>
            </a>

            <a href="tables.php">
                <div class="four columns">
                    <div class="admin-section-button">
                        <h4>View Tables</h4>
                        <img src="images/table.png">
                    </div>
                </div>
            </a>

            <a href="admin.php">
                <div class="four columns">
                    <div class="admin-section-button">
                        <h4>Add Admin</h4>
                        <img src="images/user.png">
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php include 'footer.php' ?>
</body>

</html>