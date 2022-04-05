<?php

class fixture
{
    private $fixtureID;
    private $home;
    private $away;
    private $time;
    private $score;
    private $playerID;
    private $team;
    private $playerName;
    private $shotsOnTarget;
    private $fouls;

    function __construct($fixtureID, $home, $away, $time, $score) {
        $this->fixtureID = $fixtureID;
        $this->home = $home;
        $this->away = $away;
        $this->time = $time;
        $this->score = $score;
    }

    function lineup($playerID) {
        $this->playerID = $playerID;
    }

    function player($team, $playerName, $shotsOnTarget, $fouls, $playerID = null){
        $this->team = $team;
        $this->playerName = $playerName;
        $this->shotsOnTarget = $shotsOnTarget;
        $this->fouls = $fouls;
        $this->playerID = $playerID;
    }

    /**
     * @return mixed
     */
    public function getFixtureID()
    {
        return $this->fixtureID;
    }

    /**
     * @return mixed
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * @return mixed
     */
    public function getAway()
    {
        return $this->away;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @return mixed
     */
    public function getPlayerID()
    {
        return $this->playerID;
    }

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
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
    public function getShotsOnTarget()
    {
        return $this->shotsOnTarget;
    }

    /**
     * @return mixed
     */
    public function getFouls()
    {
        return $this->fouls;
    }

    /**
     * @param mixed $fixtureID
     */
    public function setFixtureID($fixtureID)
    {
        $this->fixtureID = $fixtureID;
    }

    /**
     * @param mixed $home
     */
    public function setHome($home)
    {
        $this->home = $home;
    }

    /**
     * @param mixed $away
     */
    public function setAway($away)
    {
        $this->away = $away;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @param mixed $playerID
     */
    public function setPlayerID($playerID)
    {
        $this->playerID = $playerID;
    }

    /**
     * @param mixed $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }

    /**
     * @param mixed $playerName
     */
    public function setPlayerName($playerName)
    {
        $this->playerName = $playerName;
    }

    /**
     * @param mixed $shotsOnTarget
     */
    public function setShotsOnTarget($shotsOnTarget)
    {
        $this->shotsOnTarget = $shotsOnTarget;
    }

    /**
     * @param mixed $fouls
     */
    public function setFouls($fouls)
    {
        $this->fouls = $fouls;
    }
}