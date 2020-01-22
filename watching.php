<?php
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Analytics Insight</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Poiret+One&display=swap" rel="stylesheet">     
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link href="mainstyle.css" rel="stylesheet">
    </head>
    <body onload="getPlayers('load')">
    <ul class="nav-bar">
            <li class="nav-left"><a href="home.php">Home</a></li>
            <li class="nav-left"><a href="playerlist.php">Players</a></li>
            <li class="nav-left"><a href="watching.php">Watching</a></li>
            <?php if ( isset($_SESSION['logged_in']) && $_SESSION['name']) : ?>
                <li class="personName nav-right"><a>Welcome <?php echo $_SESSION['name'] ?></a></li>
                <li class="nav-right"><a href="signout.php">Sign Out</a></li>
			<?php else : ?>
                <li class="nav-right"><a href="login.php">Login</a></li>
                <li class="nav-right"><a href="register.php">Register</a></li>				
            <?php endif; ?>
        </ul>

        <div id="home-title">
            <img class="logo" src="images/logo.png">
        </div>
        <div class="container-fluid wrongcolor">


            <div class="row justify-content-center">
                <div class="col-12">

                    <table class="table">
                        <thead>
                            <tr id="table-head">
                                <th> Name</th>
                                <th class="list" onclick="getPlayers('fg_pct')">fg%&#8645;</th>
                                <th class="list fg3" onclick="getPlayers('fg3_pct')">fg3%&#8645;</th>
                                <th class="list ft" onclick="getPlayers('ft_pct')">ft%&#8645;</th>
                                <th class=" min">min</th>
                                <th class="list" onclick="getPlayers('pts')">pts&#8645;</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="players"></tbody>
                    </table>
                </div>
            </div>      
        </div>

        <script src="watchingscript.js"></script>
    </body>
</html>