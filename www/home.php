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
        <!-- Button to access leaderboards, could be cleaner HTML but it works -->
        <div class="row">
            <div class='twelve columns'>
                <a href="leaderboard.php"><button style='width:100%; font-size:32px;'>Leaderboards</button></a>
            </div>
        </div>

        <div class="row">
            <div class='twelve columns'>
                <h1>Please choose a Game mode</h1>
            </div>
        </div>

        <!-- Pull gamemodes from Database and make buttons from them-->
        <div class="row">
            <?php
            // Log into database, make query of gamemode table
            // TODO: secure query
            include "database-login.php";
            // This query is always server side, so no need to change it
            $result = mysqli_query($con, "SELECT * FROM gamemode;");

            // While there are still gamemodes
            while ($gamemode = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                // Make a new full width button to display this game mode
                echo ("<div class='twelve columns'>");
                echo ("<form action='game.php' method='post'>
                <button type='submit' style='width:100%; font-size:32px;' name='gamemode' value=" . $gamemode['gamemode'] . ">" . $gamemode['modename'] . "</button>
                </form>");
                echo ("</div>");
            }
            ?>
        </div>
    </div>

    <?php include 'footer.php' ?>


</body>

</html>