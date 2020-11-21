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

<div class="background" id="background-select">
</div>
</body>
<script type="text/javascript" src="java.js"></script>
</html>