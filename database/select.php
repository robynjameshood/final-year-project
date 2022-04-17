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

        $query = $connection->prepare("SELECT player.name, player.position, player.shirtNumber, team.teamName
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

    public function getPlayerStatistics($fixtureID) {
        return 0;
    }
}




