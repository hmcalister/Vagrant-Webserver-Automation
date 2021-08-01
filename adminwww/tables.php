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
    <title>Admin - Tables</title>
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
    <?php $page_name = "Tables";
    include 'header.php';
    include 'sql-query.php'; ?>

    <div class="container" id="main">
        <div class="row">
            <div class="twelve columns">
                <?php
                // Change this to your connection info.
                $DATABASE_HOST = '192.168.2.12:3306';
                $DATABASE_USER = 'root';
                $DATABASE_PASS = 'root';
                $DATABASE_NAME = 'webdatabase';

                // Try and connect using the info above.
                $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                if (mysqli_connect_errno()) {
                    // If there is an error with the connection, stop the script and display the error.
                    echo ('Failed to connect to MySQL: ' . mysqli_connect_error());
                    return;
                }
                $result = mysqli_query($con, "SHOW TABLES;");
                $result = mysqli_fetch_array($result);
                for ($i = 0; $i < count($result); $i += 2) {
                    echo ("<div class='twelve columns'>");
                    echo ("<form action='tables.php' method='post'>
                <button type='submit' style='width:100%; font-size:32px;' name='table' value=" . $result[$i] . ">" . $result[$i] . "</button>
                </form>");
                    echo ("</div>");
                }
                $con->close();
                ?>
            </div>
        </div>
        <div class=row>
            <div class="twelve columns">
                <?php
                if ($_POST) {
                    echo ("<h1>Table: " . $_POST['table'] . "</h1>");
                    sql_query('SELECT * FROM ' . $_POST['table'] . ';');
                }
                ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>
</body>

</html>