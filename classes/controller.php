<?php

namespace smartstats;

require "database/insert.php";
require "database/select.php";
require "database/api.php";

use Joli\JoliNotif\Notification;
use Joli\JoliNotif\NotifierFactory;
use insert;
use select;

class controller
{
    private $insertData;
    private $selectData;

    public function __construct()
    {
        $select = new select();
        $insert = new insert();
        $this->insertData = $insert;
        $this->selectData = $select;
    }

    public function findLineup($fixtureID)
    {
        return $this->selectData->getLineup($fixtureID);
    }

    public function findStatistics($fixtureID)
    {
        return $this->selectData->getPlayerStatistics($fixtureID);
    }

    function generateFixture($id)
    {
        $fixture = inplay($id, "lineup");

        if (!empty($fixture['response'])) {

            echo "Loading Player Data... ";

            $this->insertData->insertFixture($id);

            foreach ($fixture['response'] as $team) {
                $teamID = $team['team']['id'];
                $teamName = $team['team']['name'];

                $this->insertData->insertTeamData($teamID, $teamName, $id);

                foreach ($team['startXI'] as $player) {
                    $playerID = $player['player']['id'];
                    $playerName = $player['player']['name'];
                    $playerPosition = $player['player']['pos'];
                    $playerNumber = $player['player']['number'];

                    $this->insertData->insertPlayer($playerID, $playerName, $playerPosition, $playerNumber,true, $teamID);
                }

                foreach ($team['substitutes'] as $subs) {
                    $playerID = $subs['player']['id'];
                    $playerName = $subs['player']['name'];
                    $playerPosition = $subs['player']['pos'];
                    $playerNumber = $subs['player']['number'];

                    $this->insertData->insertPlayer($playerID, $playerName, $playerPosition, $playerNumber, false, $teamID);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    function generatePlayerData($id)
    {
        $fixture = inplay($id, "stats");

        if (!empty($fixture['response'])) {
            foreach ($fixture['response'] as $team) {
                foreach ($team['players'] as $player) {

                    $playerID = $player['player']['id'];

                    foreach ($player['statistics'] as $stats) {
                        $shots_on_target = $stats['shots']['on'];
                        $tackles = $stats['tackles']['total'];
                        $fouls = $stats['fouls']['committed'];

                        $this->insertData->insertPlayerStatistics($shots_on_target, $tackles, $fouls, $playerID);
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

    function updatePlayerStats($id)
    {
        $fixture = inplay($id, "stats");

        if (!empty($fixture['response'])) {

            foreach ($fixture['response'] as $team) {
                foreach ($team['players'] as $player) {

                    $playerID = $player['player']['id'];

                    foreach ($player['statistics'] as $stats) {
                        $shots_on_target = $stats['shots']['on'];
                        $tackles = $stats['tackles']['total'];
                        $fouls = $stats['fouls']['committed'];

                        $this->insertData->updatePlayerStatistics($shots_on_target, $tackles, $fouls, $playerID);
                    }
                }
            }
        }
    }

    function getLiveGames() {
        $fixtures = inplay();
        return $fixtures;
    }

    function getPlayerWatchList($tackles, $fouls) {
        return $this->selectData->getPlayerWatchList($tackles, $fouls);
    }

    function getAllFixtureIDS() {
        return $this->selectData->getFixtureIds();
    }

    function getStatsByTeam($team) {
        return $this->selectData->getStatsByTeamName($team);
    }

    function getPlayerStatsFromAPI($playerID) {
        return $playerStats = inplay($playerID, "playerStats");
    }

    function getFixturesByLeagueID($leagueID) {
        return $fixtures = inplay($leagueID, "all");
    }

    function resetDatabase() {
        $this->selectData->databaseReset();
    }
}