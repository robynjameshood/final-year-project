<?php

use smartstats\controller;

require_once "vendor/autoload.php";
include "classes/controller.php";

$controller = new controller();


?>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="refresh" content="">
    <link rel="stylesheet" href="styles.css"
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
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
        <div class="userpage-main-title">Ligue One</div>
        <?php
        $response = $controller->getFixturesByLeagueID("all"); // calls function api in api-call file passing the session variable.;
        ?>

        <div class="table-wrapper">
            <table class="live-games-table">
                <tr>
                    <td>Time</td>
                    <td>Home</td>
                    <td>Score</td>
                    <td>Away</td>
                    <td>League</td>
                    <td>Lineups</td>
                    <td>Statistics</td>
                </tr>
                <?php
                foreach ($response['response'] as $fixture) {
                if ($fixture['league']['name'] == "Ligue 1" and $country = $fixture['league']['country'] == "France") { ?>
                <tr>
                    <?php

                    $time = $fixture['fixture']['status']['elapsed'];
                    $home_goals = $fixture['goals']['home'];
                    $away_goals = $fixture['goals']['away'];
                    $league = $fixture['league']['name'];
                    $homeTeam = $fixture['teams']['home']['name'];
                    $awayTeam = $fixture['teams']['away']['name'];
                    $country = $fixture['league']['country']; ?>
                    <td><?php echo $time . "'"; ?></td>
                    <td><?php echo $homeTeam; ?> </td>
                    <?php ?>

                    <td><?php echo $home_goals; ?><?php echo ":" .
                            $away_goals ?> </td>
                    <td><?php echo $awayTeam; ?> </td>
                    <?php $id = $fixture['fixture']['id']; ?>
                    <td><?php echo $country;
                        echo ": "; ?>
                        <?php echo $league; ?></td>
                    <td>
                        <button class="lineups" homeTeam="<?php echo $homeTeam; ?>" awayTeam="<?php echo $awayTeam; ?>"
                                name="<?php echo $id; ?>" homeGoals="<?php echo $home_goals; ?>"
                                awayGoals="<?php echo $away_goals; ?>">View
                        </button>
                    </td>
                    <td>
                        <button class="statistics" home="<?php echo $homeTeam; ?>" away="<?php echo $awayTeam; ?>"
                                name="<?php echo $id; ?>">View
                        </button>
                    </td>
                    <div class="notification-values" homeTeam="<?php echo $homeTeam; ?>"
                         awayTeam="<?php echo $awayTeam; ?>"
                         name="<?php echo $id; ?>" homeGoals="<?php echo $home_goals; ?>"
                         awayGoals="<?php echo $away_goals; ?>" time="<?php echo $time ?>"
                         league="<?php echo $league ?>"></div>
                    <?php }
                    } ?>

                </tr>
            </table>
        </div>
    </div>
    <script src="java.js"></script>
</body>
