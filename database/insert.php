<?php

include "connection.php";

// Test variables

$teamName = "Manchester United";
$goalsPerGame = 2.2;
$cornersPerGame = 4.3;
$tablePosition = 6;
$leagueID = 2;

$countryName = "England";
$leagueName = "Premiership";


// Prepare the SQL statement for execution.
$query = $connection->prepare("insert into teams (teamName, goalsPerGame, cornersPerGame, tablePosition, leagueID) values (?, ?, ?, ?, ?)");

// Bind the parameter values

$query->bind_param("sddii", $teamName, $goalsPerGame, $cornersPerGame, $tablePosition, $leagueID);
$query->execute();