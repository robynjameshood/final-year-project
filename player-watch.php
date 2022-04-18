<?php

use smartstats\controller;

include "classes/controller.php";

$foulCount = 1;
$tackleCount = 0;

$controller = new controller();

$data = $controller->getPlayerWatchList($tackleCount, $foulCount);

$live = $controller->getLiveGames();

foreach ($live['response'] as $fixture) {
    $id = $fixture['fixture']['id'] . "<br>";
    $controller->updatePlayerStats($id);
}

liveGames($live, $data);

function liveGames($live, $data)
{ ?>
    <table style="width: 800px; height: 50px; margin: auto">
    <tr>
        <td style="border: 1px solid lightskyblue; text-align: center">Player</td>
        <td style="border: 1px solid lightskyblue; text-align: center">Tackles</td>
        <td style="border: 1px solid lightskyblue; text-align: center">Fouls</td>
        <td style="border: 1px solid lightskyblue; text-align: center">Team</td>
    </tr> <tr><?php
    foreach ($data as $player) {
        //
        //$away = $fixture['teams']['away']['name'];

        $team = $player['teamName'];
        $playerName = $player['name'];
        $tackles = $player['tackles'];
        $fouls = $player['fouls'];

        isLive($live, $team, $playerName, $tackles, $fouls);
    }
}


function isLive($live, $team, $playerName, $tackles, $fouls)
{
    foreach ($live['response'] as $fixture) {
        $home = $fixture['teams']['home']['name'];
        $away = $fixture['teams']['away']['name'];

        if ($home === $team or $away === $team) { ?>

            <td style="border: 1px solid lightskyblue; text-align: center"> <?php echo $playerName; ?></td>
            <td style="border: 1px solid lightskyblue; text-align: center"> <?php echo $tackles; ?></td>
            <td style="border: 1px solid lightskyblue; text-align: center"> <?php echo $fouls; ?></td>
            <td style="border: 1px solid lightskyblue; text-align: center"> <?php echo $team; }?></td>
            </tr> <?php }
}

