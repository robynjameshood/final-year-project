<?php

$server = "localhost";
$user = "root";
$pass = "";
$dbname = "smart-stats";

$connection = mysqli_connect($server, $user, $pass, $dbname) or die("Connection error");
