<?php 
require 'config/config.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Analytics Insight</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Poiret+One&display=swap" rel="stylesheet">        
        <link href="mainstyle.css" rel="stylesheet">
    </head>
    <body>
        <ul class="nav-bar">
            <li class="nav-left"><a href="home.php">Home</a></li>
            <?php if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ) : ?>
                <li class="nav-left"><a href="playerlist.php">Players</a></li>
                <li class="nav-left"><a href="watching.php">Watching</a></li>
                <li class="personName nav-right"><a>Welcome <?php echo $_SESSION['name'] ?></a></li>
                <li class="nav-right"><a href="updatePassword.php">Update Password</a></li>
                <li class="nav-right"><a href="signout.php">Sign Out</a></li>
            <?php else : ?>
                <li class="nav-left"><a >log in to see players</a></li>
                <li class="nav-right"><a href="login.php">Login</a></li>
                <li class="nav-right"><a href="register.php">Register</a></li>				
            <?php endif; ?>
        </ul>

        <div id="home-title">
            <img class="logo" src="images/logo.png">
        </div>

        <div id="intro">
            <p><strong> Welcome to your fantasy sports desination.  
                You can search for current NBA players and add them to your watching list.
                From there you can sort them based on metrics such as field goal percentage
                and points.</strong></p>
        </div>

        <div id="hello">
                <img class="pic lakers" src="images/lakers.jpg">
                <img class="pic westharden" src="images/west&harden.jpg">
                <img class="pic greek" src="images/greek.jpg">
        </div>
    </body>
</html>