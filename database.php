<?php
require 'config/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
}

if($_GET["type"] == "add") {

    $id = $_GET["id"];
    $firstName = $_GET["firstName"];
    $lastName = $_GET["lastName"];
    $position = $_GET["position"];
    $fg3_pct = 100*$_GET["fg3_pct"];
    $fg_pct = 100*$_GET["fg_pct"];
    $ft_pct = 100*$_GET["ft_pct"];
    $min = $_GET["min"];
    $pts = $_GET["pts"];
    $reb = $_GET["reb"];
    $name = $_SESSION["name"];

    


    $check = "SELECT u.user_id, p.api_id FROM users AS u
                JOIN favorites AS f
                    ON f.user_id = u.user_id
                JOIN players AS p
                    ON f.player_id = p.player_id 
                WHERE api_id=" . $id . " AND u.username='" . $name . "';";
    $r = $mysqli->query($check);

    if($r->num_rows > 0) {
        echo "You have already added that player";
        exit();
    }

    $check = "SELECT player_id FROM players WHERE api_id=" . $id . ";";
    $r = $mysqli->query($check);
    $row = $r->fetch_assoc();
    $playerId = $row['player_id'];

    if($r->num_rows > 0) {
        $sqlPlayers = "UPDATE players SET fg3_pct=" . $fg3_pct . ", fg_pct=" . $fg_pct . ", ft_pct=" . $ft_pct . ", min='" . $min . "', pts=" . $pts . ", reb=" . $reb . "
                            WHERE player_id=" . $playerId . ";";

        $results = $mysqli->query($sqlPlayers);
        if( !$results) {
            echo $mysqli->error;
            exit();
        }
    }
    else {

        $sqlPlayers = "INSERT INTO players (api_id, first_name, last_name, position, fg3_pct, fg_pct, ft_pct, min, pts, reb) 
                        VALUES (" . $id . ",'" . $firstName . "','" . $lastName . "','" . $position . "'," . $fg3_pct . "," . $fg_pct . "," . $ft_pct . ",'" . $min . "'," . $pts . "," . $reb . ");";

        $results = $mysqli->query($sqlPlayers);
        if( !$results) {
            echo $mysqli->error;
            exit();
        }

    }

    
    $sqlPlayerId = "SELECT player_id FROM players WHERE api_id=" . $id . ";";
    $idresults = $mysqli->query($sqlPlayerId);
    $row = $idresults->fetch_assoc();
    $playerId = $row['player_id'];

    $sqlUserId = "SELECT user_id as user FROM users WHERE username='" . $_SESSION['name'] . "';";
    $results = $mysqli->query($sqlUserId);
    if( !$results) {
        echo $mysqli->error;
        exit();
    }
    $row = $results->fetch_assoc();
    $userId = $row['user'];
    $sqlFavorites = "INSERT INTO favorites (user_id, player_id) VALUES (" . $userId . "," . $playerId . ");";
    $results = $mysqli->query($sqlFavorites);
    if( !$results) {
        echo $mysqli->error;
        exit();
    }

}

else if($_GET["type"] == "delete") {

    $id = $_GET["id"];
    $sqlPlayerId = "SELECT player_id FROM players WHERE api_id=" . $id . ";";
    $idresults = $mysqli->query($sqlPlayerId);
    if( !$idresults) {
        echo $mysqli->error;
        exit();
    }
    $row = $idresults->fetch_assoc();
    $playerId = $row['player_id'];
    
    $sqlUserId = "SELECT user_id as user FROM users WHERE username='" . $_SESSION['name'] . "';";
    $idresults = $mysqli->query($sqlUserId);
    if( !$idresults) {
        echo $mysqli->error;
        exit();
    }
    $row = $idresults->fetch_assoc();
    $userId = $row['user'];

    $sqlFavoriteId = "SELECT favorite_id as fav FROM favorites WHERE user_id =" . $userId . " AND player_id=" . $playerId . ";";
    $idresults = $mysqli->query($sqlFavoriteId);
    if( !$idresults) {
        echo $mysqli->error;
        exit();
    }
    $row = $idresults->fetch_assoc();
    $favId = $row['fav'];


    $delete = "DELETE FROM favorites WHERE favorite_id =" . $favId . ";";
    $results = $mysqli->query($delete);
    if( !$results) {
        echo $mysqli->error;
        exit();
    }

}



$mysqli->close();




?>