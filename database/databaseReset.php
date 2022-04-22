<?php

// this file is called once a day (midnight) to clean the database so the next day's fixtures can be added without teamName collision.

include "../database/select.php";

$select = new select();

$select->databaseReset();
