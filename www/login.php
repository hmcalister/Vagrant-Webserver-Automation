<?php
session_start();
$_SESSION['loggedin']=TRUE;
$_SESSION['username']=$_POST['username'];
header("Location: home.php");
exit;
?>