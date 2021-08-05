<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

// Log into the database and insert user score into scores table
include 'database-login.php';
$result = mysqli_query($con, "INSERT INTO scores(username, gamemode, gamewon, score) 
                                VALUES ('".$_POST['username']."', ".$_POST['gamemode'].", ".$_POST['gamewon'].", ".$_POST['score'].");");
$con->close();
?>