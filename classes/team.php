<?php

namespace smartstats;

class team
{
    private $teamID;
    private $teamName;

    public function __construct($teamID, $teamName) {
        $this->teamID = $teamID;
        $this->teamName = $teamName;
    }

    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * @param mixed $teamName
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;
    }

    /**
     * @return mixed
     */
    public function getTeamID()
    {
        return $this->teamID;
    }

    /**
     * @param mixed $teamID
     */
    public function setTeamID($teamID)
    {
        $this->teamID = $teamID;
    }
}

