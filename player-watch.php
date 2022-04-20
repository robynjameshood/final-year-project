<?php

use smartstats\controller;

include "classes/controller.php";

?>
<head>
  <meta http-equiv="refresh" content="60">
  <script src="java.js"></script>
</head>
<?php

$foulCount = 2;
$tackleCount = 2;

$controller = new controller();

$live = $controller->getLiveGames(); // returns array of fixtures from api.

$data = $controller->getPlayerWatchList($tackleCount, $foulCount); // returns player stats from database

databaseFixtureIDs($controller, $live);

liveGames($live, $data);

function databaseFixtureIDs(controller $controller, $live) {
    $fixtureIDS = $controller->getAllFixtureIDS();

    foreach ($fixtureIDS as $fixtureID) {
        $id =  $fixtureID['fixtureID'];
        compareFixtures($id, $controller, $live);
    }
}

function compareFixtures($id, controller $controller, $live) {
    foreach ($live['response'] as $fixture) {
        if ($fixture['fixture']['id'] == $id) {
            $controller->updatePlayerStats($id);
        }
    }
}

function liveGames($live, $data)
{ ?>
    <table style="width: 800px; height: 50px; margin: auto">
    <tr>
        <td style="border: 1px solid lightskyblue; text-align: center">Player</td>
        <td style="border: 1px solid lightskyblue; text-align: center">Position</td>
        <td style="border: 1px solid lightskyblue; text-align: center">Tackles</td>
        <td style="border: 1px solid lightskyblue; text-align: center">Fouls</td>
        <td style="border: 1px solid lightskyblue; text-align: center">Team</td>
    </tr> <tr><?php
    foreach ($data as $player) {

        $team = $player['teamName'];
        $playerName = $player['name'];
        $tackles = $player['tackles'];
        $fouls = $player['fouls'];
        $position = $player['position'];

        isLive($live, $team, $playerName, $tackles, $fouls, $position);
    }
}


function isLive($live, $team, $playerName, $tackles, $fouls, $position)
{
    foreach ($live['response'] as $fixture) {
        $home = $fixture['teams']['home']['name'];
        $away = $fixture['teams']['away']['name'];

        if ($home === $team or $away === $team) { ?>

            <td style="border: 1px solid lightskyblue; text-align: center"> <?php echo $playerName; ?></td>
            <td style="border: 1px solid lightskyblue; text-align: center"> <?php echo $position; ?></td>
            <td style="border: 1px solid lightskyblue; text-align: center"> <?php echo $tackles; ?></td>
            <td style="border: 1px solid lightskyblue; text-align: center"> <?php echo $fouls; ?></td>
            <td style="border: 1px solid lightskyblue; text-align: center"> <?php echo $team; }?></td>
            </tr> <?php }
}

