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
    <title>Admin - SQL</title>
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
    <?php $page_name = "SQL";
    include 'header.php'; ?>

    <div class="container" id="main">
        <div class="row">
            <div class="offset-by-two columns eight columns" style="text-align:center;">
                <h1>SQL Interface: Webdatabase</h1>
                <h4 style="color:#CC0000;">Warning: All SQL runs trusted - you have been warned</h4>
            </div>
        </div>
        <div class="row">
            <form action="sql.php" method="post">
                <div class="eight columns">
                    <input type="text" name="query">
                </div>
                <div class="offset-by-two-columns two columns">
                    <input type="submit" value="Query">
                </div>
            </form>
        </div>
        <div class="row">
            <div class="twelve columns" style="text-align: center;">
            <?php include "sql-query.php"; ?>
            <?php
            if ($_POST) {
                // Now we check if the data from the login form was submitted, isset() will check if the data exists.
                if ($_POST['query'] === "") {
                    // Could not get the data that should have been sent.
                    echo('Please enter a query!');
                } else {
                    printf("<h3>%s</h3>", $_POST['query']);
                    sql_query($_POST['query']);
                }                
            }
            ?>
            </div>
        </div>

    </div>

    <?php include 'footer.php' ?>
</body>

</html>