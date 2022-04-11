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

        $fixtureID = 816802;

        $query = $connection->prepare("SELECT player.name, player.position, player.shirtNumber, team.teamName
                                        FROM player
                                        INNER JOIN team ON player.teamID = team.teamID
                                        INNER JOIN fixture ON team.fixtureID = fixture.fixtureID
                                        where fixture.fixtureID = ?;");
        $query->bind_param("i", $fixtureID);
        $query->execute();

        $result = $query->get_result();

        return $result->fetch_all();
    }
}




