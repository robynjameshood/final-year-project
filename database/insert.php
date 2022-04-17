<?php

use smartstats\player;

include "connection.php";

class insert
{


    public function __construct() //
    {

    }

    public function insertFixture($fixtureID)
    {
        global $connection;

        $query = $connection->prepare("insert ignore into fixture (fixtureID) value (?)");
        $query->bind_param("i", $fixtureID);
        $query->execute();
    }

    function insertTeamData($teamID, $teamName, $fixtureID)
    {
        global $connection;

        $query = $connection->prepare("insert ignore into team (teamID, teamName, fixtureID) VALUE (?, ?, ?)");
        $query->bind_param("isi", $teamID, $teamName, $fixtureID);
        $query->execute();
    }

    public function insertPlayer($playerIO, $playerName, $playerPosition, $shirtNumber, $xi, $teamID) {
        global $connection;

        $query = $connection->prepare("insert ignore into player (playerID, name, position, shirtNumber, start, teamID) value (?, ?, ?, ?, ?, ?)");
        $query->bind_param("issiii", $playerIO, $playerName, $playerPosition, $shirtNumber, $xi, $teamID);
        $query->execute();
    }

    public function insertPlayerStatistics($shots_on_target, $tackles, $fouls, $playerID) {
        global $connection;

        $query = $connection->prepare("insert ignore into statistics (shotsOnTarget, tackles, fouls, playerID) value (?, ?, ?, ?)");
        $query->bind_param("iiii", $shots_on_target, $tackles, $fouls, $playerID);
        $query->execute();
    }

    public function updatePlayerStatistics($shots_on_target, $tackles, $fouls, $playerID) {
        global $connection;

        $query = $connection->prepare("UPDATE statistics set shotsOnTarget = ?, tackles = ?, fouls = ? WHERE playerID = ?");
        $query->bind_param("iiii", $shots_on_target, $tackles, $fouls, $playerID);
        $query->execute();
    }
}