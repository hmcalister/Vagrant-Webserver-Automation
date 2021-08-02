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
    <title>Home</title>
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
            <div class='twelve columns'>
                <h1>Please choose a gamemode</h1>
            </div>
            <div class="row">
                <?php
                include "database-login.php";
                $result = mysqli_query($con, "SELECT * FROM gamemode;");
                while ($gamemode = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo ("<div class='twelve columns'>");
                    echo ("<form action='game.php' method='post'>
                <button type='submit' style='width:100%; font-size:32px;' name='gametype' value=" . $gamemode['gametype'] . ">" . $gamemode['name'] . "</button>
                </form>");
                    echo ("</div>");
                }
                ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>


</body>

</html>