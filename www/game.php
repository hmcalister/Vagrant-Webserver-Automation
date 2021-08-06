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

//Ensure the gamemode is selected
if (!isset($_POST['gamemode'])) {
    header('Location: home.php');
    exit;
}
include 'database-login.php';
$query=$con->prepare("SELECT * FROM gamemode WHERE ?=gamemode;");
$query->bind_param("s",$_POST['gamemode']);
$query->execute();
$result = $query->get_result();
$game_data = mysqli_fetch_array($result, MYSQLI_ASSOC);
$query->close();
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

    <!-- We will need some jquery to handle Ajax -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    <!-- Load some stuff from into variables from PHP -->
    <script type="text/javascript">
        //Remove context menus (right click) to stop interference with flag mechanic
        document.addEventListener('contextmenu', event => event.preventDefault());
        var username = "<?php echo $_SESSION['username']; ?>";
        var gamemode = <?php echo $game_data['gamemode']; ?>;
        var width = <?php echo $game_data['width']; ?>;
        var height = <?php echo $game_data['height']; ?>;
        var bomb_ratio = <?php echo $game_data['bomb_ratio']; ?>;
    </script>

    <!-- Import the game logic script -->
    <script src="game_logic.js"></script>
</head>

<body>
    <!-- Header file -->
    <?php $page_name = "Game: ".$game_data['modename'];
    include 'header.php'; ?>
    <div class="container" id="main">
        <!-- This h1 is used to display win/loss, altered in game_logic.js -->
        <div class="row">
            <div class="twelve columns">
                <h1 id="game_info"></h1>
            </div>
        </div>
        <!-- A restart button, to clear the grid and try again -->
        <div class="row">
            <div class="twelve columns">
                <button id="submit_score_btn" style='width:100%; font-size:32px;' onclick="game_setup()">Restart</button>
            </div>
        </div>
        <!-- Actual game display, created on the fly in JS -->
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