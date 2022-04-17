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
        homeTeam($homeTeam, $data);
        awayTeam($awayTeam, $data);
    } else {
        $reload = $controller->generateFixture($id);
        if ($reload == true) {
            header("refresh: 1");
        }
        else {
            echo "Lineup's not available for this fixture";
        }

    }

}

function homeTeam($homeTeam, $data)
{
    echo "<div style='position: fixed; left: 0; width: 300px; text-align: center'>$homeTeam</div>";
    echo "<table style='width: 300px; position: fixed; left: 0px; top: 20px'>";
    echo "<tr>";
    echo "<td>Position</td>";
    echo "<td>Player Name</td>";
    echo "</tr>";

    echo "<tr>";
    foreach ($data as $player) {

        if ($player['teamName'] == $homeTeam and $player['start'] == true) {
            echo "<td>" . $player['position'] . "</td>";
            echo "<td>" . $player['name'] . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}

function awayTeam($awayTeam, $data)
{
    echo "<div style='position: fixed; right: 0; width: 300px; text-align: center'>$awayTeam</div>";
    echo "<table style='width: 300px; position: fixed; right: 0px; top: 20px'>";
    echo "<tr>";
    echo "<td>Position</td>";
    echo "<td>Player Name</td>";
    echo "</tr>";

    echo "<tr>";
    foreach ($data as $player) {

        if ($player['teamName'] == $awayTeam and $player['start'] == true) {
            echo "<td>" . $player['position'] . "</td>";
            echo "<td>" . $player['name'] . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}



