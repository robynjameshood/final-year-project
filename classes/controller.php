<?php

namespace smartstats;

require "database/insert.php";
require "database/select.php";

use insert;
use select;

class controller
{

    private $insertData;

    public function __construct() {
        $insert = new insert();
        $this->insertData = $insert;
    }

    public function buildPlayer(player $player, $teamID) {
        $this->insertData->insertPlayer($player, $teamID);
    }

    public function buildFixture($fixtureID) {

        $this->insertData->insertFixture($fixtureID);
    }

    public function buildTeamData($teamID, $teamName, $fixtureID) {

        $this->insertData->insertTeamData($teamID, $teamName, $fixtureID);
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
}