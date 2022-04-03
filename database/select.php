<?php
session_start();
include "connection.php";

// sql query
$query = $connection->prepare("select teamName, tablePosition from teams ");

$query->execute();

//returns the actual result / returns the rows of data and places them inside of result variable.
$result = $query->get_result(); // returns the actual result/data

