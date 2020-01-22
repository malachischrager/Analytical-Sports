<?php
require 'config/config.php';

if( isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
	header('Location: home.php');
}
else {

	if( isset($_POST['username']) && isset($_POST['password']) ){
			
		if( empty($_POST['username']) || empty($_POST['password']) ) {
			$error = "Enter a username and password ";
		}
		
		else {

			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}
            $usernameInput = $_POST["username"];
            
            $passwordInput = hash("sha256", $_POST["password"]);
            
			$sql = "SELECT * FROM users 
				WHERE username = '" . $usernameInput . "' AND password = '" . $passwordInput . "';";
			
			$results = $mysqli->query($sql);
			if(!$results) {
				echo $mysqli->error;
				exit();
			}
			if($results->num_rows > 0) {
				$_SESSION['logged_in'] = true;
				$_SESSION['name'] = $usernameInput;
				header('Location: home.php');
			}
			else {
				$error = "Invalid username or password";
            }
            
            $mysqli->close();

		}
		
	}
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Poiret+One&display=swap" rel="stylesheet">        

        <link href="loginregister.css" rel="stylesheet">

    </head>
    <body>

        <ul class="nav-bar">
            <li class="nav-left"><a href="home.php">Home</a></li>
            <li class="nav-left"><a>log in to see players</a></li>
            <li class="nav-right"><a href="login.php">Login</a></li>
            <li class="nav-right"><a href="register.php">Register</a></li>
        </ul>


        <div class="container">
            <div class="row">
                <h1 class="col-12 mt-4 mb-4">Login</h1>
            </div> 
        </div>

        <div class="container">
            <form action="login.php" method="POST" id="form">

                <div class="row mb-3">
                    <div id="error" class="font-italic text-danger col-sm-9 ml-sm-auto">
                        <?php
                            if ( isset($error) && !empty($error) ) {
                                echo $error;
                            }
                        ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="font-italic text-danger col-sm-9 ml-sm-auto">
                    </div>
                </div>
                

                <div class="form-group row">
                    <label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="username-id" name="username">
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password:</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password-id" name="password">
                    </div>
                </div> 
                

                <div class="form-group row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 mt-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-light">Cancel</a>
                    </div>
                </div> 
            </form>
        </div>
        <script>
            document.querySelector("#form").onsubmit = function(event) {


                if(document.querySelector("#username-id").value.trim().length == 0) {
                    event.preventDefault();
                    document.querySelector("#error").innerHTML = "Please enter a username.";
                }
                else if(document.querySelector("#password-id").value.trim().length == 0) {
                    event.preventDefault();
                    document.querySelector("#error").innerHTML = "Please enter a password.";
                }


            }
        </script>
    </body>
   
</html>