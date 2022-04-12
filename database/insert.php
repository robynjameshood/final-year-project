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

    public function insertPlayer(player $player, $teamID) {
        global $connection;
        $playerID = $player->getPlayerID();
        $playerName = $player->getPlayerName();
        $playerPosition = $player->getPlayerPosition();
        $playerNumber = $player->getShirtNumber();
        $team_ID = $teamID;

        $query = $connection->prepare("insert ignore into player (playerID, name, position, shirtNumber, teamID) value (?, ?, ?, ?, ?)");
        $query->bind_param("issii", $playerID, $playerName, $playerPosition, $playerNumber, $team_ID);
        $query->execute();
    }
}