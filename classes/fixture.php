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
     * @param mixed $fixtureID
     */
    public function setFixtureID($fixtureID)
    {
        $this->fixtureID = $fixtureID;
    }




}