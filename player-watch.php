<?php

use smartstats\controller;

include "classes/controller.php";

?>
<head>
  <meta http-equiv="refresh" content="300">
</head>
<?php

$foulCount = 2;
$tackleCount = 2;

$controller = new controller();

$live = $controller->getLiveGames(); // returns array of fixtures from api.

$data = $controller->getPlayerWatchList($tackleCount, $foulCount); // returns player stats from database



foreach ($live['response'] as $fixture) {
    $id = $fixture['fixture']['id'];
    $controller->updatePlayerStats($id);
}

liveGames($live, $data);

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

