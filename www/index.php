<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page metadata -->
    <meta charset="utf-8">
    <title>COSC349 Assignment 1</title>
    <meta name="description" content="COSC349 Assignment 1">
    <meta name="author" content="Hayden McAlister">

    <!-- CSS references: from SkeletonCSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">

</head>

<body>
    <?php $page_name = "Login";
    include 'header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="twelve columns">
                <h1>Login</h1>
            </div>
            <form action="login.php" method="POST">
                <div class="eight columns">
                    <input type="text" name="username" placeholder="Username" style="width: 100%;" required>
                </div>
                <div class="four columns">
                    <input type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>

</body>

</html>