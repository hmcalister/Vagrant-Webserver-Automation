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
    <title>Admin - Add Admin</title>
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
    <?php $page_name = "Add Admin";
    include 'header.php'; ?>

    <form action="admin.php" method="post">
        <div class="container">
            <div class="row">
                <div class="four columns">
                    <input type="text" name="username" placeholder="Username" id="username" required>
                </div>
                <div class="four columns">
                    <input type="password" name="password" placeholder="Password" id="password" required>
                </div>
                <div class="four columns">
                    <input type="password" name="confirm-password" placeholder="Confirm Password" id="password" required>
                </div>
            </div>
            <div class="row">
                <div class="offset-by-two columns eight">
                    <input type="submit" value="Add Admin">
                </div>
            </div>
        </div>
        <div class=row>
            <div class="twelve columns">
                <?php
                if ($_POST) {
                    if ($_POST["password"] != $_POST["confirm-password"]) {
                        echo ("<h1>Passwords do not match!</h1>");
                    } else {
                        include 'sql-query.php';

                        $new_name = $_POST["username"];
                        $new_password = password_hash($_POST["password"], PASSWORD_BCRYPT);
                        $query = "INSERT INTO admin(username, passwd) VALUES ('$new_name', '$new_password');";
                        sql_query($query);
                    }
                }
                ?>
            </div>
        </div>
    </form>

    <?php include 'footer.php' ?>
</body>

</html>