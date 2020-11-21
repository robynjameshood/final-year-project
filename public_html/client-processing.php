<?php
session_start();

$server = "shareddb-w.hosting.stackcp.net";
$user = "robyn83";
$pass = "trojanhorse1";
$dbname = "betatest-3134397ae7";

$connection = mysqli_connect($server, $user, $pass, $dbname) or die("Connection error");

$username = null;$forename = null;$surname = null;$eMail = null;$option = null;$saltedHash = null;

if (isset($_POST['username'])) {
    $username = $_POST['username'];
}

if (isset($_POST['first_name'])) {
    $forename = $_POST['first_name'];
}

if (isset($_POST['second_name'])) {
    $surname = $_POST['second_name'];
}

if (isset($_POST['email'])) {
    $eMail = $_POST['email'];
}

if (isset($_POST['password'])) {
    $saltedHash = hash('sha256',$_POST['password'].$username);
}

if (isset($_GET['option'])) {
    $option = $_GET['option'];
}

$dateNow = time();
$dateNow = intval($dateNow);

$error = false;

switch ($option) {
    case 1:
        if (!filter_var($eMail, FILTER_VALIDATE_EMAIL)) {
            header("location: register?invalid-email=true");
        }
        else {
            header("location: login");
            $SQL = $connection->prepare(
                "SELECT *
                FROM tbl_username
                WHERE username=? 
                OR email=?");
            $SQL->bind_param("ss", $username, $eMail);
            $SQL->execute();
            $result = $SQL->get_result();
            $rows = $result->num_rows;
            $SQL->close();

            if ($rows == 0) {
                $SQL = $connection->prepare("INSERT INTO tbl_username (username, datecreated, email, forename, surname) VALUES (?,?,?,?,?)");
                $SQL->bind_param('sisss', $username, $dateNow, $eMail, $forename, $surname);
                $SQL->execute();
                $userID = $connection->insert_id;
                $SQL->close();

                $SQL = $connection->prepare("INSERT INTO tbl_hashword (hashword) values (?)");
                $SQL->bind_param('s', $saltedHash);
                $SQL->execute();
                $hashID = $connection->insert_id;
                $SQL->close();

                $SQL = "INSERT INTO lnk_userHash(userID, hashID) 
                        values ('$userID','$hashID')";
                $linkQuery = mysqli_query($connection, $SQL);

            } else {

                header("location: login?already-registered=true");

            }
        }


        break;
    case 2:
        $SQL = $connection->prepare(
              "SELECT * 
                     FROM tbl_username 
                     WHERE email=?");
        $SQL->bind_param('s',$eMail);
        $SQL->execute(); $result = $SQL->get_result(); $rows = $result->num_rows; $resultObject = $result->fetch_object();$SQL->close();
        $success = true;
        if ($rows != 0) {
            $currentEmail = $resultObject->email;
            $currentID = $resultObject->ID;
            $hashSQL = "SELECT tbl_hashword.hashword 
                        FROM lnk_userHash
                        INNER JOIN tbl_hashword
                        ON lnk_userHash.hashID = tbl_hashword.ID
                        WHERE lnk_userHash.userID='$currentID'";
            $hashFound = $connection -> query($hashSQL)->fetch_object();
            $hash = $hashFound->hashword;

            if ($eMail = $currentEmail && $saltedHash = $hash) {
                header('location: userpage');
                $_SESSION["username"] = $currentEmail;
                $_SESSION["userid"] = $currentID;
            } else {$success = false;}
            } else {$success = false;}
        if ($success === false){header("location: login?error=true");}

        break;


    case 3:
        header("location: login");
        session_destroy();
        break;
    default:
        echo 'No option selected';
        break;
}

