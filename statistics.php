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
    //$data = $controller->findLineup($id); // calls the controller to find the line-up in the database.
    $playerData = $controller->findStatistics($id); // calls the database to find the stats for a game in play.

    if ($playerData) { // checks to see if the sql data exists. This function will only fire if the lineup is available from the api.
        $controller->updatePlayerStats($id); // if the fixture data (line-up) exists, then on each click of view on the front end the player statistics data needs to be updated (database).
        home($homeTeam, $playerData); // sends homeTeam functions the name of the team (obtained via GET from the javascript parameter passing). Passes player data if it exists from the database.
        away($awayTeam, $playerData);
    } else {
        $reload_fixture = $controller->generateFixture($id); // calls the controller, this calls the api to obtain the fixture data, returning true if the data exists and proceeds to insert into the database, false if not.
        $reload_player_data = $controller->generatePlayerData($id); // same as above, returns true if the controller has received a response from the api and procceds to insert into the database.
        if ($reload_fixture == true and $reload_player_data == true) { // causes the page to reload if both variables are true.
            header("refresh: 1");
        } else {
            echo "Lineup's not available for this fixture"; // If the api doesn't contain data / lineup, then we won't be able to get the player stats, so echo this.
        }

    }

}

function home($team, $playerData)
{
    ?>
    <body>
    <table class="home-stats-table">
        <tr>
            <td colspan="5"><?php echo $team ?></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>Shots On Target</td>
            <td>Tackles</td>
            <td>Fouls</td>
            <td>Position</td>
        </tr>
        <tr> <?php
            foreach ($playerData as $player) {
            if ($player['teamName'] == $team and $player['start'] == true) {
            echo "<td>" . $player['name'] . "</td>";
            echo "<td>" . $player['shotsOnTarget'] . "</td>";
            echo "<td>" . $player['tackles'] . "</td>";
            echo "<td>" . $player['fouls'] . "</td>";
            echo "<td>" . $player['position'] . "</td>";
            }
            echo "</tr>" ;} ?>
        </tr>
        <tr>
            <td colspan="5">Substitutes</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>Shots On Target</td>
            <td>Tackles</td>
            <td>Fouls</td>
            <td>Position</td>
        </tr>
        <tr> <?php
            foreach ($playerData as $player) {
                if ($player['teamName'] == $team and $player['start'] == false) {
                    echo "<td>" . $player['name'] . "</td>";
                    echo "<td>" . $player['shotsOnTarget'] . "</td>";
                    echo "<td>" . $player['tackles'] . "</td>";
                    echo "<td>" . $player['fouls'] . "</td>";
                    echo "<td>" . $player['position'] . "</td>";
                }
                echo "</tr>" ;} ?>
        </tr>
    </table>
    </body>
<?php }

function away($team, $playerData)
{
    ?>
    <body>
    <table class="away-stats-table">
        <tr>
            <td colspan="5"><?php echo $team ?></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>Shots On Target</td>
            <td>Tackles</td>
            <td>Fouls</td>
            <td>Position</td>
        </tr>
        <tr> <?php
            foreach ($playerData as $player) {
            if ($player['teamName'] == $team and $player['start'] == true) {
            echo "<td>" . $player['name'] . "</td>";
            echo "<td>" . $player['shotsOnTarget'] . "</td>";
            echo "<td>" . $player['tackles'] . "</td>";
            echo "<td>" . $player['fouls'] . "</td>";
            echo "<td>" . $player['position'] . "</td>";
            }
            echo "</tr>" ;} ?>
        </tr>
        <tr>
            <td colspan="5">Substitutes</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>Shots On Target</td>
            <td>Tackles</td>
            <td>Fouls</td>
            <td>Position</td>
        </tr>
        <tr> <?php
            foreach ($playerData as $player) {
                if ($player['teamName'] == $team and $player['start'] == false) {
                    echo "<td>" . $player['name'] . "</td>";
                    echo "<td>" . $player['shotsOnTarget'] . "</td>";
                    echo "<td>" . $player['tackles'] . "</td>";
                    echo "<td>" . $player['fouls'] . "</td>";
                    echo "<td>" . $player['position'] . "</td>";
                }
                echo "</tr>" ;} ?>
        </tr>
    </table>
    </body>
<?php } ?>







