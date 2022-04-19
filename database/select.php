<?php

include "connection.php";

class select
{

    public function __construct()
    {

    }

    public function getLineup($fixtureID)
    {
        global $connection;

        $query = $connection->prepare("SELECT player.name, player.position, player.shirtNumber, team.teamName, player.start
                                        FROM player
                                        INNER JOIN team ON player.teamID = team.teamID
                                        INNER JOIN fixture ON team.fixtureID = fixture.fixtureID
                                        where fixture.fixtureID = ?
                                        ORDER BY team.teamName");
        $query->bind_param("i", $fixtureID);
        $query->execute();

        $result = $query->get_result(); // gets the result

        // fetches all rows using mode assoc

        //print_r($data);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPlayerStatistics($fixtureID)
    {
        global $connection;

        $query = $connection->prepare("SELECT team.teamName, player.name, player.position, statistics.shotsOnTarget, statistics.tackles, statistics.fouls, player.start
                                        FROM player
                                        INNER JOIN statistics ON player.playerID = statistics.playerID
                                        INNER JOIN team ON team.teamID = player.teamID
                                        INNER JOIN fixture ON fixture.fixtureID = team.fixtureID
                                        WHERE fixture.fixtureID = ?
                                        ORDER BY statistics.fouls desc ");
        $query->bind_param("i", $fixtureID);
        $query->execute();

        $result = $query->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPlayerWatchList($tackles, $fouls)
    {
        global $connection;

        $query = $connection->prepare("SELECT player.name, statistics.tackles, statistics.fouls, team.teamName, player.position
                                            FROM player
                                            INNER JOIN statistics on statistics.playerID = player.playerID
                                            INNER JOIN team ON team.teamID = player.teamID
                                            WHERE statistics.tackles >= ? or statistics.fouls >= ?");
        $query->bind_param("ii", $tackles, $fouls);
        $query->execute();

        $result = $query->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}




