<?php
$_SESSION['league'] = "Bundesliga";
$_SESSION['leagueID'] = 78;
require_once "vendor/autoload.php";
include "database/api-call.php"


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
        </div>
    </div>

    <div class="userpage-main">
        <div class="userpage-main-title">Premier League Statistics</div>
        <?php
        $response = inplay($_SESSION['leagueID']); // calls function api in api-call file passing the session variable.

        if (!empty($response['response'])) { ?>
        <div class="table-wrapper">
            <table class="live-games-table">
                <tr>
                    <td>Home</td>
                    <td>Score</td>
                    <td>Away</td>
                    <td>Lineup</td>
                    <td>Statistics</td>
                </tr>
                <?php
                foreach ($response['response'] as $fixture) { ?>
                <tr>
                    <td><?php print_r($fixture['teams']['home']['name']); ?> </td>
                    <td><?php print_r($fixture['goals']['home']); ?><?php echo ":";
                        print_r($fixture['goals']['away']) ?> </td>
                    <td><?php print_r($fixture['teams']['away']['name']); ?> </td>
                    <td>
                        <button class="lineups">View</button>
                    </td>
                    <td>
                        <button class="statistics">View</button>
                    </td> <?php }}
                    else {  ?>
                        <div class="table-wrapper">
                            <table class="live-games-table">
                                <tr>
                                    <td>Home</td>
                                    <td>Score</td>
                                    <td>Away</td>
                                    <td>Lineup</td>
                                    <td>Statistics</td>
                                </tr>
                            </table>
                        </div> <?php } ?>


        <div class="widget" id="scoreaxis-widget-c3a7d"
             style="border-width:1px;border-color:rgba(0, 0, 0, 0.15);border-style:solid;border-radius:8px;padding:0px;background:rgb(255, 255, 255);width:300px;height: 100%;">
            <iframe id="Iframe"
                    src="https://www.scoreaxis.com/widget/league-top-players/8?autoHeight=1&amp;playersNumber=15&amp;inst=c3a7d"
                    style="width:100%;border:none;transition:all 300ms ease"></iframe>
            <script>window.addEventListener("DOMContentLoaded", event => {
                    window.addEventListener("message", event => {
                        if (event.data.appHeight && "c3a7d" == event.data.inst) {
                            let container = document.querySelector("#scoreaxis-widget-c3a7d iframe");
                            container && (container.style.height = parseInt(event.data.appHeight) + "px")
                        }
                    }, !1)
                });</script>
        </div>
    </div>
</div>

</body>
