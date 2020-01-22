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
    <body onload="displayStats()">
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
        <div class="row mb-3">
            <div id="error" class="font-italic text-danger col-sm-9 ml-sm-auto"></div>
        </div>
        <div class="row ">
            <form action="" method="" class="col-12" id="search-form">
                <div id="form" class="form-row justify-content-center">
                    <div class="col-12 mt-4 col-sm-8 col-lg-4">
                        <label for="search-id" class="sr-only">Search:</label>
                        <input type="text" name="" class="form-control" id="search-id" placeholder="Search for a player">
                    </div>
                    <div class="col-12 mt-4 col-sm-auto">
                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid wrongcolor">


            <div class="row justify-content-center">
                <div class="col-12">

                    <table class="table">
                        <thead>
                            <tr id="table-head">
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th class="position">Position</th>
                                <th class="team">Team</th>
                                <th>Watch Player</th>
                            </tr>
                        </thead>
                        <tbody id="players"></tbody>
                    </table>
                </div>
            </div>      
        </div>

        <script src="playerscript.js"></script>
    </body>
</html>