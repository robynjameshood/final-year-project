<?php

namespace smartstats;

class player
{
    private $playerID;
    private $playerName;
    private $shotsOnTarget;
    private $fouls;
    private $shirtNumber;
    private $playerPosition;

    public function __construct($playerID, $playerName, $position, $shirtNumber, $shotsOnTarget = null, $fouls = null) {
        $this->playerID = $playerID;
        $this->playerName = $playerName;
        $this->playerPosition = $position;
        $this->shirtNumber = $shirtNumber;
        $this->shotsOnTarget = $shotsOnTarget;
        $this->fouls = $fouls;
    }

    /**
     * @return mixed
     */
    public function getShirtNumber()
    {
        return $this->shirtNumber;
    }

    /**
     * @return mixed
     */
    public function getPlayerPosition()
    {
        return $this->playerPosition;
    }

    /**
     * @return mixed|null
     */
    public function getFouls()
    {
        return $this->fouls;
    }

    /**
     * @return mixed|null
     */
    public function getShotsOnTarget()
    {
        return $this->shotsOnTarget;
    }

    /**
     * @return mixed
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }

    /**
     * @return mixed
     */
    public function getPlayerID()
    {
        return $this->playerID;
    }

    /**
     * @param mixed|null $shotsOnTarget
     */
    public function setShotsOnTarget($shotsOnTarget)
    {
        $this->shotsOnTarget = $shotsOnTarget;
    }

    /**
     * @param mixed $shirtNumber
     */
    public function setShirtNumber($shirtNumber)
    {
        $this->shirtNumber = $shirtNumber;
    }

    /**
     * @param mixed $playerPosition
     */
    public function setPlayerPosition($playerPosition)
    {
        $this->playerPosition = $playerPosition;
    }

    /**
     * @param mixed|null $fouls
     */
    public function setFouls($fouls)
    {
        $this->fouls = $fouls;
    }

    /**
     * @param mixed $playerName
     */
    public function setPlayerName($playerName)
    {
        $this->playerName = $playerName;
    }

    /**
     * @param mixed $playerID
     */
    public function setPlayerID($playerID)
    {
        $this->playerID = $playerID;
    }
}