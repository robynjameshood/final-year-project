<?php

use smartstats\fixture;
use smartstats\player;
use smartstats\team;

require "../smart-stats/classes/fixture.php";
require "../smart-stats/classes/team.php";
require "../smart-stats/classes/player.php";

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
    $response = apiCall($id);
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
    $response = apiCall($id);
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
        $response = apiCall($id);
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

function apiCall($id) {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures/lineups?fixture=" . $id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: api-football-v1.p.rapidapi.com",
            "X-RapidAPI-Key: 876d579235msh398dd1932516a96p1ffad5jsnd2510f2f083f"
        ],
    ]);

    $response = json_decode(curl_exec($curl), true, JSON_PRETTY_PRINT);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    }

    return $response;
}

