<?php

use smartstats\fixture;
use smartstats\player;
use smartstats\team;

require "../smart-stats/classes/fixture.php";
require "../smart-stats/classes/team.php";
require "../smart-stats/classes/player.php";
require "../smart-stats/database/api.php";

include "database/insert.php";
include "database/select.php";

$id = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

generateFixture($id);
generateTeamData($id);
generatePlayerData($id);


function generateFixture($id)
{
    $response = inplay($id);
    if (empty($response['response'])) {
        echo "Lineup Not Available for this fixture";
    } else {
        echo "fixture inserting...\r\n";
        $fixture = new fixture($id);
        $insert = new insert();
        $insert->insertFixture($fixture);
    }
}

function generateTeamData($id)
{
    $response = inplay($id);
    echo "\r\ninserting into team table";
    if (empty($response['response'])) {
        echo "Lineup Not Available for this fixture";
    } else {
        foreach ($response['response'] as $team) {
            $teamID = $team['team']['id'];
            $teamName = $team['team']['name'];
            $teamData = new team($teamID, $teamName);
            $insert = new insert();

            $insert->insertTeamData($teamData, $id);
        }
    }
}

function generatePlayerData($id)
{
    $select = new select();

    $teamData = $select->getLineup($id);

    if ($teamData) {
        echo "\r\nTeam data found - pulling from database";
        var_dump($teamData);
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

