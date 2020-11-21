<?php

$server = "shareddb-w.hosting.stackcp.net";
$user = "robyn83";
$pass = "trojanhorse1";
$dbname = "betatest-3134397ae7";

$connection = mysqli_connect($server, $user, $pass, $dbname) or die("Connection error");

$time = strftime("%H:%M:%S", time());

$sql = "insert into users (firstname, surname, time) values ('Robyn', 'Blackham', '$time')";

$query = mysqli_query($connection, $sql);