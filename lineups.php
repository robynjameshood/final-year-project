<?php

use smartstats\player;
//use smartstats\team;
use smartstats\controller;

//require "../smart-stats/classes/fixture.php";
require "../smart-stats/classes/team.php";
require "../smart-stats/classes/player.php";
require_once "../smart-stats/database/api.php";
require "../smart-stats/classes/controller.php";

$id = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

generateFixture($id);
//generateTeamData($id);
//generatePlayerData($id);

function checkDatabaseForFixture() {

}

function generateFixture($id)
{
    $controller = new controller();

    $response = $controller->getLineup($id);

    if ($response === false) {
        echo "No lineup available";
    } else {
        echo "inserting fixture...";

        $buildFixture = new controller();

        $buildFixture->buildFixture($id);

        echo "Inserting Team Data";

        foreach ($response['response'] as $team) {
            $teamID = $team['team']['id'];
            $teamName = $team['team']['name'];

            $controller->buildTeamData($teamID, $teamName, $id);
        }
    }
}

function generateTeamData($id)
{
    $controller = new controller();

    $response = $controller->getLineup($id);


    if (empty($response['response'])) {
    } else {
        echo "Line up found - Inserting into database: '<br>'";

    }
}

function generatePlayerData($id)
{
    $select = new select();

    $teamData = $select->getLineup($id);

    if ($teamData) {
        echo "\r\nTeam data found - pulling from database";
        //print_r($teamData);
    } else {
        echo "\r\ncalling api";
        $response = inplay($id);
        if (empty($response['response'])) {
            echo "Lineup Not Available for this fixture";
        } else {
            echo "inserting player data";
            foreach ($response['response'] as $team) {
                $teamID = $team['team']['id'];

                foreach ($team['startXI'] as $players) {
                    $playerID = $players['player']['id'];
                    $playerName = $players['player']['name'];
                    $playerPosition = $players['player']['pos'];
                    $playerNumber = $players['player']['number'];
                    $player = new player($playerID, $playerName, $playerPosition, $playerNumber);

                    $insert = new insert();

                    $insert->insertPlayer($player, $teamID);
                }
            }
        }
    }
}

