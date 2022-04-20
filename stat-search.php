<?php

use smartstats\controller;

include "classes/controller.php";

$team = "";

if (isset($_GET['team'])) {
    $team = $_GET['team'];
}

// this page is an upcoming feature, takes input (tean name) from the user, sends that data to the controller
// selects all the games with that team name and retrieves the stats for each game which will be clickable records (drop down per each record)

$controller = new controller();

$fixtureIDS = $controller->getAllFixtureIDS();
$statistics = array();

$i = 0;

$players = getPlayersOfTeamFromDatabase($team, $controller);

$data = getPlayerSpecificStats($players, $controller);

$result = 0;

?>
<head>
    <link rel="stylesheet" href="styles.css"
</head>
<style>
    body {
        overflow-y: scroll;
    }
</style>
<body>
<?php
?>
<body>
<div class="userpage-wrapper">
    <div class="userpage-side">
        <div class="user">Logged in:</div>
        <div class="flex-side-links">
            <a href="live-games.php" class="live-games-page">Live-games</a>
            <a href="premierleague.php" class="premierleague">Premier-League</a>
            <a href="championship.php" class="championship">Championship</a>
            <a href="ligue-one.php" class="Ligue 1">Ligue 1</a>
            <a href="serie-a.php" class="Serie A">Serie A</a>
            <a href="bundesliga.php" class="Bundesliga">Bundesliga</a>
            <a href="laliga.php" class="La Liga">La Liga</a>
            <a href="stat-search.php" class="stat-search">Stat Search</a>
            <div id="player-watch">Player-Watch</div>
        </div>
    </div>

    <div class="userpage-main">
        <table class="stats-search-table">
            <tr>
                <td>Stat-Search</td>
            </tr>
            <tr>
                <td>
                    <label for="team">Team: </label><input type="text" id="search">
                </td>
            </tr>
        </table>
        <table class="stat-search-results-table">
            <tr>
                <td>Player</td>
                <td>Appearences</td>
                <td>Shots On Target Per Game</td>
                <td>Goals</td>
                <td>Yellow Cards</td>
            </tr><script src="stat-search.js"></script></body>
            <tr> <?php

foreach ($data as $player) {
    echo "<td>" . $player[0]['player']['name'] . "</td>";
    echo "<td>" . $player[0]['statistics'][0]['games']['appearences'] . "</td>";
//    echo "Shots On Target: " . $player[0]['statistics'][0]['shots']['on'] . '<br>';
    if ($player[0]['statistics'][0]['shots']['on'] !=0 or $player[0]['statistics'][0]['games']['appearences'] !=0) {
        $sotCalculation = $player[0]['statistics'][0]['shots']['on'] / $player[0]['statistics'][0]['games']['appearences'];
        $result = round($sotCalculation, 2);
    }

    echo "<td>" . $result . '<br>';
    echo "<td>" . $player[0]['statistics'][0]['goals']['total'] . "</td>";
    echo "<td>" . $player[0]['statistics'][0]['cards']['yellow'] . "</td>";
    echo "</tr>";
}

    function getPlayerSpecificStats($players, controller $controller)
    {
        $playerStats = array();
        foreach ($players as $player) {
            $playerID = $player['playerID'];
            $playerStats[] = $controller->getPlayerStatsFromAPI($playerID);
        }
        return $playerStats;
    }

    function getPlayersOfTeamFromDatabase($team, controller $controller)
    { // this function returns the fixture ids of the team from the search
        return $fixtures = $controller->getStatsByTeam($team); // returns player stats from the requested team.
    }

    ?>

