<?php

require 'config/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->errno ) {
    echo $mysqli->error;
    exit();
}

$type = $_GET['type'];
$name = $_SESSION["name"];
if($type == 'load') {
    $favPlayers = "SELECT u.username, p.api_id, p.first_name, p.last_name, p.fg3_pct, p.fg_pct, p.ft_pct, p.min, p.pts FROM users AS u
                    JOIN favorites AS f
                        ON f.user_id = u.user_id
                    JOIN players AS p
                        ON f.player_id = p.player_id 
                    WHERE u.username='" . $name . "';";

}
else {
    $favPlayers = "SELECT u.username, p.api_id, p.first_name, p.last_name, p.fg3_pct, p.fg_pct, p.ft_pct, p.min, p.pts FROM users AS u
                    JOIN favorites AS f
                        ON f.user_id = u.user_id
                    JOIN players AS p
                        ON f.player_id = p.player_id 
                    WHERE u.username='" . $name . "'
                    ORDER BY " . $type ." DESC;";

}

$results = $mysqli->query($favPlayers);	
if ( !$results ) {
    echo $mysqli->error;
    exit();
}

$mysqli->close();
$results_array = [];
while( $row = $results->fetch_assoc() ) {
    array_push( $results_array, $row );
}
echo json_encode($results_array);

?>
