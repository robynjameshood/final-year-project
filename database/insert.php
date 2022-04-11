<?php

use smartstats\fixture;
use smartstats\player;
use smartstats\team;
use smartstats\user;

include "connection.php";

class insert
{


    public function __construct() // uses dependency injection, constructor takes an object of type fixture to insert into the database
    {

    }

    function insertFixture(fixture $fixture)
    {
        global $connection;
        $id = $fixture->getFixtureID();

        $query = $connection->prepare("insert ignore into fixture (fixtureID) value (?)");
        $query->bind_param("i", $id);
        $query->execute();
    }

    function insertTeamData(team $team, $fixtureID)
    {
        global $connection;
        $teamID = $team->getTeamID();
        $teamName = $team->getTeamName();

        $query = $connection->prepare("insert ignore into team (teamID, teamName, fixtureID) VALUE (?, ?, ?)");
        $query->bind_param("isi", $teamID, $teamName, $fixtureID);
        $query->execute();
    }

    function insertPlayer(player $player, $teamID) {
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