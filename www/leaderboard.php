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
    <title>Leaderboards</title>
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
    <?php $page_name = "Leaderboards";
    include 'header.php'; ?>

    <div class="container" id="main">
        <div class="row">
            <?php
            // Log into database, get info on what game modes there are
            //TODO: Secure this query
            include 'database-login.php';
            $result = mysqli_query($con, "SELECT * from gamemode;");

            // While there are more gamemodes
            while ($gamemode = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                // Make each gamemode it's own full width button
                echo ("<div class='twelve columns'>");
                echo ("<form action='leaderboard.php' method='post'>
                <button type='submit' style='width:100%; font-size:32px;' name='modename' value=" . $gamemode['modename'] . ">" . $gamemode['modename'] . "</button>
                </form>");
                echo ("</div>");
            }
            $con->close();
            ?>
        </div>

        <div class=row>
            <div class="twelve columns">
                <?php
                // If we have selected an option from the buttons above, but not before
                if ($_POST) {
                    // Connect to the database and run a very ugly query to get username and time of the selected gamemode
                    include 'database-login.php';
                    $query = "SELECT s.username, s.score FROM scores s, gamemode g 
                                WHERE g.gamemode=s.gamemode AND s.gamewon=1 
                                    AND g.modename='" . $_POST['modename'] . "' 
                                ORDER BY s.score ASC";
                    $result = mysqli_query($con, $query);

                    // Setup start of table and headings
                    echo ("<h1>Game mode: " . $_POST['modename'] . "</h1>");
                    echo "<table class='result_table'>";
                    echo ('<tr><th>Name</th><th>Time</th></tr>');

                    // For each result of query
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        // Make a new row and place all the data from the results tuple into it
                        // Of form name, time
                        echo "<tr>";
                        printf("<td>%s</td><td>%s</td>", $row["username"], $row["score"]/1000);
                        echo "</tr>";
                    }
                    echo "</table>"; //Close the table in HTML
                    $con->close();
                }
                ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>
</body>

</html>