<?php

namespace smartstats;

class fixture
{
    private $fixtureID;


    public function __construct($fixtureID) {
        $this->fixtureID = $fixtureID;
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


    /**
     * @param mixed $fixtureID
     */
    public function setFixtureID($fixtureID)
    {
        $this->fixtureID = $fixtureID;
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


}