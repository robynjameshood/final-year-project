<?php
require_once "vendor/autoload.php";
//include "database/select.php";


?>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="refresh" content="">
    <link rel="stylesheet" href="styles.css"
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="wrapper">
    <div class="side">
        <div class="side-title">Welcome</div>
        <form class="login-form" action="/database/login.php">
            <div class="form-title">Login:</div><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" required><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
        </form>
    </div>

    <div class="main">
        <div class="main-title">Smart-Stats</div>
    </div>
</div>

</body>
