<!DOCTYPE html>
<?php
session_start();
$_SESSION['leagueID'] = "all";

require_once "vendor/autoload.php";
include "database/api.php";


?>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" lang="">
<head>
    <meta http-equiv="refresh" content="">
    <link rel="stylesheet" href="styles.css"
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
<div class="userpage-wrapper">
    <div class="userpage-side">
        <div class="user">Logged in:</div>
        <div class="flex-side-links">
            <a href="live-games.php" class="live-games-page">Live-games</a>
            <a href="premierleague.php" class="premierleague">Premier-League</a>
            <a href="championship.php" class="championship">Championship</a>
            <a href="ligue-one.php" class="Ligue 1">Ligue 1</a>
            <a href="serie-a.php" class="Serie A">Serie A</a>
            <a href="bundesliga.php" class="Bundesliga">Bundesliga</a>
            <a href="laliga.php" class="La Liga">La Liga</a>
        </div>
    </div>

    <div class="userpage-main">
        <div class="userpage-main-title">Live Games:</div>
        <?php
        $response = inplay($_SESSION['leagueID']); // calls function api in api-call file passing the session variable.
        ?>


        <div class="table-wrapper">
            <table class="live-games-table">
                <tr>
                    <td>Time</td>
                    <td>Home</td>
                    <td>Score</td>
                    <td>Away</td>
                    <td>Lineup</td>
                    <td>Statistics</td>
                </tr>
                <?php
                foreach ($response['response'] as $fixture) { ?>
                <tr>
                    <td><?php print_r($fixture['fixture']['status']['elapsed'] . "'") ?></td>
                    <td><?php print_r($fixture['teams']['home']['name']); ?> </td>
                    <?php $homeTeam = $fixture['teams']['home']['name'];
                    $awayTeam = $fixture['teams']['away']['name'];
                    ?>
                    <td><?php print_r($fixture['goals']['home']); ?><?php echo ":";
                        print_r($fixture['goals']['away']) ?> </td>
                    <td><?php print_r($fixture['teams']['away']['name']); ?> </td>
                    <?php $id = $fixture['fixture']['id']; ?>
                    <td>
                        <button class="lineups" homeTeam = "<?php echo$homeTeam; ?>" awayTeam = "<?php echo$awayTeam;?>" name="<?php echo $id; ?>">View</button>
                    </td>
                    <td>
                        <button class="statistics" name="<?php echo $id ?>">View</button>
                    </td>
                    <?php } ?>
                </tr>
            </table>
        </div>
        <script src="java.js"></script>
    </div>
</div>

</body>
