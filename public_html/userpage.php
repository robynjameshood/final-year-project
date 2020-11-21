<?php session_start();
if (!isset($_SESSION["username"])) {
    header("location: login");
}
?>

<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <?php require_once 'vendor/autoload.php'; ?>
    <meta http-equiv="refresh" content="60">
    <link rel="stylesheet" href="styles.css"
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="leagues-menu" id="leagues-menu">
    <a href="all-games" div class="league-title" id="league-title">Matches</div></a>
</div>
</div>

<div class="background" id="background-select">
    <div class="user-admin-flex-container">
        <div class="username">Username: <?php echo $_SESSION['username']; ?></div>
        <div class="Suggestions/Feedback">Feedback - Coming Soon</div>
        <div class="FAQ">FAQ - Coming Soon</div>
        <div class="Change email/password">Change email/password - Coming Soon</div>
        <div class="log-out"><a href="client-processing.php?option=3">log-out</a></div>
    </div>
</div>
</body>
<script type="text/javascript" src="java.js"></script>
</html>