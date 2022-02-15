<?php session_start();
if (!isset($_SESSION["username"])) {
    header("location: login.php");
} ?>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <?php require_once 'vendor/autoload.php'; ?>
    <meta http-equiv="refresh" content="60">
    <link rel="stylesheet" href="styles.css"
    <meta http-equiv="refresh" content="60">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="side-menu" id="side-menu">
    <div class="menu-flex-container">
        <div><a href="corner-alerts" id="league-title">Corner Alerts</a></div>
        <div><a href="goal-alerts" id="league-title">Goal Alerts</a></div>
        <div><a href="player-cards" id="league-title">Player Cards</a></div>
        <div><a href="btts" id="league-title">Both Teams To Score</a></div>
        <div><a href="over2point5" id="league-title">Over 2.5 Goals</a></div>
    </div>
</div>
<div class="user-flex-container">
    <div class="text">Logged in:</div>
    <a href="userpage.php"><?php echo $_SESSION["username"]; ?></a>
</div>

<?php $response = Unirest\Request::get("https://api-football-v1.p.rapidapi.com/v2/fixtures/live",
    array(
        "X-RapidAPI-Host" => "api-football-v1.p.rapidapi.com",
        "X-RapidAPI-Key" => "876d579235msh398dd1932516a96p1ffad5jsnd2510f2f083f"
    )
);
$data = json_decode($response->raw_body, true);
$fixture_id = array();
$time_elapsed = array();
$cornerKicksArray = array();
?>

<div class="background" id="background-select">
    <div class="statistics-flex-container">
        <table class="live-statistics-table">
            <tr>
                <th>Time</th>
                <th>Home</th>
                <th>Score</th>
                <th>Away</th>
                <th>Corners</th>
                <th>Alert</th>
            </tr>
            <?php foreach ($data['api']['fixtures'] as $fixture) { ?>
                <tr>
                    <td><?= $fixture['elapsed'] ?></td>
                    <td><?= $fixture['homeTeam']['team_name'] ?></td>
                    <td><?= $fixture['goalsHomeTeam'] . " - " . $fixture['goalsAwayTeam'] ?></td>
                    <td><?= $fixture['awayTeam']['team_name'] ?></td>
                    <?php $fixture_id[] = $fixture['fixture_id']; ?>
                    <?php $time_elapsed[] = $fixture['elapsed']; ?>
                    <?php foreach ($fixture_id as $match) { ?>
                        <?php $response = Unirest\Request::get("https://api-football-v1.p.rapidapi.com/v2/statistics/fixture/$match/",
                            array(
                                "X-RapidAPI-Host" => "api-football-v1.p.rapidapi.com",
                                "X-RapidAPI-Key" => "876d579235msh398dd1932516a96p1ffad5jsnd2510f2f083f"
                            )
                        );
                        $result = json_decode($response->raw_body, true); ?>
                        <td><?php @$result['api']['statistics']['Corner Kicks']['home'] ?> </td>
                    <?php } ?>
                </tr
            <?php } ?>
        </table>
    </div>
</div>
</body>
<script type="text/javascript" src="java.js"></script>
</html>