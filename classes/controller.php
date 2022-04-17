<?php

namespace smartstats;

require "database/insert.php";
require "database/select.php";
require "database/api.php";

use insert;
use select;

class controller
{

    private $insertData;
    private $selectData;

    public function __construct() {
        $select = new select();
        $insert = new insert();
        $this->insertData = $insert;
        $this->selectData = $select;
    }

    public function buildPlayerStatistics($shots_on_target, $tackles, $fouls, $playerID) {
        $this->insertData->insertPlayerStatistics($shots_on_target, $tackles, $fouls, $playerID);
    }

    public function updatePlayerData($shots_on_target, $tackles, $fouls, $playerID) {

        $this->insertData->updatePlayerStatistics($shots_on_target, $tackles, $fouls, $playerID);
    }

    public function buildPlayer($playerIO, $playerName, $playerPosition, $shirtNumber, $teamID) {
        $this->insertData->insertPlayer($playerIO, $playerName, $playerPosition, $shirtNumber, $teamID);
    }

    public function buildFixture($fixtureID) {

        $this->insertData->insertFixture($fixtureID);
    }

    public function buildTeamData($teamID, $teamName, $fixtureID) {

        $this->insertData->insertTeamData($teamID, $teamName, $fixtureID);
    }

    public function findLineup($fixtureID) {
        return $this->selectData->getLineup($fixtureID);
    }

    public function findStatistics($fixtureID) {
        return $this->selectData->getPlayerStatistics($fixtureID);
    }

    public function getLineup($id) {
        $fixture = inplay($id, "lineup");

        if (!empty($fixture['response'])) {
            return $fixture;
        }
        else {
            return false;
        }
    }

    public function getStatistics($id) {
        $fixture = inplay($id, "stats");

        if (!empty($fixture['response'])) {
            return $fixture;
        }
        else {
            return false;
        }
    }
}