<!DOCTYPE html>
<?php
session_start(); ?>

<link rel="stylesheet" type="text/css" href="styles.css">

<?php

use smartstats\controller;

require "../smart-stats/classes/controller.php";

$id = "";
$homeTeam = "";
$awayTeam = "";
$reload = "";

if (isset($_GET['homeTeam'])) {
    $homeTeam = $_GET['homeTeam'];
}

if (isset($_GET['awayTeam'])) {
    $awayTeam = $_GET['awayTeam'];
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

checkDatabaseForFixture($id, $homeTeam, $awayTeam);

if ($reload === true) {
    header("location lineups.php");
}


// this function checks to see if the fixture data already exists in the database before calling the api; if the data is within the database, uses this data in the page
// instead of wasting an api call on the same data.

function checkDatabaseForFixture($id, $homeTeam, $awayTeam)
{
    $controller = new controller();
    $data = $controller->findLineup($id); // database call to find the line up of a fixture using $id (fixture id).
    $playerData = $controller->findStatistics($id); // database call to find player statistics using $id (fixture id).


    if (!empty($data)) {
        updatePlayerStats($id);
        homeTeam($homeTeam, $playerData); // passes the hometeam name and playerdata to echo the table of player data
        awayTeam($awayTeam, $playerData); // passes the hometeam name and playerdata to echo the table of player data

    } else {
        $reloadFixtureData = generateFixture($id); // function that returns true/false based on if a lineup is found, if so, page refreshes / header location refresh caused unexpected array index issues$playerData = generatePlayerData($id); // returns api response with player statistics.
        $reloadPlayerData = generatePlayerData($id);
        if ($reloadFixtureData == true and $reloadPlayerData) {
            header("refresh: 1");
            $reloadFixtureData = false;
        }
        else {
            echo "No lineup data available";
        }
    }

}

// generate feature is designed to check to see if the lineup exists in the api, if the lineup key is empty, the controller returns false and informs the user.
// if a lineup is found, the controller will then proceed to build the fixture data table, the team data table which relates to the fixture table
// it will then build the player data table which relates to the team table, which relates to the fixture table.

function homeTeam($homeTeam, $playerData)
{
    echo "<div style='position: fixed; left: 0; width: 300px; text-align: center'>$homeTeam</div>";
    echo "<table style='width: 300px; position: fixed; left: 0px; top: 20px'>";
    echo "<tr>";
    echo "<td>Name</td>";
    echo "<td>Shots</td>";
    echo "<td>Tackles</td>";
    echo "<td>Fouls</td>";
    echo "</tr>";

    echo "<tr>";
//    foreach ($playerData[0]['players'] as $player) {
//
//        echo "<td>" . $player['player']['name'] . "</td>";
//        foreach ($player['statistics'] as $stats) {
//            echo "<td>" . $stats['shots']['on'] . "</td>";
//            echo "<td>" . $stats['tackles'] . "</td>";
//            echo "<td>" . $stats['fouls'] . "</td>";
//        }
//
//        echo "</tr>";
//    }

    echo "</table>";
}

function awayTeam($awayTeam, $playerData)
{
    echo "<div style='position: fixed; right: 0; width: 300px; text-align: center'>$awayTeam</div>";
    echo "<table style='width: 300px; position: fixed; right: 0px; top: 20px'>";
    echo "<tr>";
    echo "<td>Position</td>";
    echo "<td>Player Name</td>";
    echo "</tr>";

    echo "<tr>";
//    foreach ($playerData as $player) {
//
//        if ($player['teamName'] == $awayTeam) {
//            echo "<td>" . $player['position'] . "</td>";
//            echo "<td>" . $player['name'] . "</td>";
//        }
//        echo "</tr>";
//    }

    echo "</table>";
}

function generateFixture($id)
{
    $controller = new controller();

    $response = $controller->getLineup($id);

    if ($response === false) {
        return false;
    } else {
        $buildFixture = new controller();

        $buildFixture->buildFixture($id);

        echo "Loading Player Data... ";

        foreach ($response['response'] as $team) {
            $teamID = $team['team']['id'];
            $teamName = $team['team']['name'];

            $controller->buildTeamData($teamID, $teamName, $id);

            foreach ($team['startXI'] as $player) {
                $playerID = $player['player']['id'];
                $playerName = $player['player']['name'];
                $playerPosition = $player['player']['pos'];
                $playerNumber = $player['player']['number'];

                $controller->buildPlayer($playerID, $playerName, $playerPosition, $playerNumber, $teamID);
            }

            foreach ($team['substitutes'] as $subs) {
                echo "inserting subs";
                $playerID = $subs['player']['id'];
                $playerName = $subs['player']['name'];
                $playerPosition = $subs['player']['pos'];
                $playerNumber = $subs['player']['number'];

                $controller->buildPlayer($playerID, $playerName, $playerPosition, $playerNumber, $teamID);
            }
        }
        return true;
    }
}

function generatePlayerData($id)
{
    $controller = new controller();

    $data = $controller->getStatistics($id);

    if ($data['response']) {

        foreach ($data['response'] as $team) {
            foreach ($team['players'] as $player) {

                $playerID = $player['player']['id'];

                foreach ($player['statistics'] as $stats) {
                    $shots_on_target = $stats['shots']['on'];
                    $tackles = $stats['tackles']['total'];
                    $fouls = $stats['fouls']['committed'];

                    $controller->buildPlayerStatistics($shots_on_target, $tackles, $fouls, $playerID);
                }
            }
        }
        return $data;
    }
    else {
        return false;
    }

}

function updatePlayerStats($id) {
    $controller = new controller();

    $data = $controller->getStatistics($id);

    foreach ($data['response'] as $team) {
        foreach ($team['players'] as $player) {

            $playerID = $player['player']['id'];

            foreach ($player['statistics'] as $stats) {
                $shots_on_target = $stats['shots']['on'];
                $tackles = $stats['tackles']['total'];
                $fouls = $stats['fouls']['committed'];

                $controller->updatePlayerData($shots_on_target, $tackles, $fouls, $playerID);
            }
        }
    }
}

