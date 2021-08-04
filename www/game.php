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
if (!isset($_POST['gametype'])) {
    header('Location: home.php');
    exit;
}

include 'database-login.php';
$result = mysqli_query($con, "SELECT * FROM gamemode WHERE " . $_POST['gametype'] . "=gametype;");
$game_data = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<head>

    <!-- Basic Page metadata -->
    <meta charset="utf-8">
    <title>Game</title>
    <meta name="description" content="COSC349 Assignment 1">
    <meta name="author" content="Hayden McAlister">

    <!-- CSS references: from SkeletonCSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/game.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">

    <script type="text/javascript">
        document.addEventListener('contextmenu', event => event.preventDefault());
        var width = <?php echo $game_data['width']; ?>;
        var height = <?php echo $game_data['height']; ?>;
        var bomb_ratio = <?php echo $game_data['bomb_ratio']; ?>;
    </script>
    <script src="game_logic.js"></script>

</head>

<body>
    <?php $page_name = "Game";
    include 'header.php'; ?>
    <div class="container" id="main">
        <div class="row">
            <div class="twelve columns">
                <div id="game">
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>