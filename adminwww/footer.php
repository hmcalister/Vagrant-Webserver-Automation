<div id="footer">
    <hr style="margin-top: 0;">
    <div class="container">
        <div class="row">
            <div class="eight columns">
                <?php echo '<h1>User: ' . $_SESSION['name'] . '</h1>' ?>
            </div>
            <div class="two columns">
                <a href="home.php"><button type="button">Home</button></a>
            </div>
            <div class="two columns">
                <a href="logout.php"><button type="button">Logout</button></a>
            </div>
        </div>
    </div>
</div>