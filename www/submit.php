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
$query = $con->prepare("INSERT INTO scores(username, gamemode, gamewon, score) 
                            VALUES (?, ?, ?, ?);");
$query->bind_param("ssss",$_POST['username'], $_POST['gamemode'], $_POST['gamewon'], $_POST['score']);
$query->execute();
$query->close();
$con->close();
?>