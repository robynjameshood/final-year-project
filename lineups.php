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

function checkDatabaseForFixture($id, $homeTeam, $awayTeam)
{
    $controller = new controller();
    $data = $controller->findLineup($id);

    if ($data) {
        home($homeTeam, $data);
        away($awayTeam, $data);
    } else {
        $reload = $controller->generateFixture($id);
        if ($reload == true) {
            header("refresh: 1");
        }
        else {
            noLineup($homeTeam, $awayTeam);
        }

    }

}

function noLineup($homeTeam, $awayTeam) {
    ?>
    <body class="no-lineups-body">
    <div class="no-lineups-flex">
    <div class="no-lineups"><p><?php echo $homeTeam . " V " . $awayTeam ?></p></div>
    <div id="no-lineup-text">Player Data Not Available</div>
    </div>
    </body>
    <?php
}

function home($team, $playerData)
{
    ?>
    <body>
    <table class="home-lineup-table">
        <tr>
            <td colspan="5"><?php echo $team ?></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>Position</td>
        </tr>
        <tr> <?php
            foreach ($playerData as $player) {
                if ($player['teamName'] == $team and $player['start'] == true) {
                    echo "<td>" . $player['name'] . "</td>";
                    echo "<td>" . $player['position'] . "</td>";
                }
                echo "</tr>" ;} ?>
        </tr>
        <tr>
            <td colspan="5">Substitutes</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>Position</td>
        </tr>
        <tr> <?php
            foreach ($playerData as $player) {
                if ($player['teamName'] == $team and $player['start'] == false) {
                    echo "<td>" . $player['name'] . "</td>";
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
    <table class="away-lineup-table">
        <tr>
            <td colspan="5"><?php echo $team ?></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>Position</td>
        </tr>
        <tr> <?php
            foreach ($playerData as $player) {
                if ($player['teamName'] == $team and $player['start'] == true) {
                    echo "<td>" . $player['name'] . "</td>";
                    echo "<td>" . $player['position'] . "</td>";
                }
                echo "</tr>" ;} ?>
        </tr>
        <tr>
            <td colspan="5">Substitutes</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>Position</td>
        </tr>
        <tr> <?php
            foreach ($playerData as $player) {
                if ($player['teamName'] == $team and $player['start'] == false) {
                    echo "<td>" . $player['name'] . "</td>";
                    echo "<td>" . $player['position'] . "</td>";
                }
                echo "</tr>" ;} ?>
        </tr>
    </table>
    </body>
<?php } ?>



