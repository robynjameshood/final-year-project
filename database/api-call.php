<?php

function apiAllGames($leagueID) {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures/?live=all",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: api-football-v1.p.rapidapi.com",
            "X-RapidAPI-Key: 332c0a65dbmshaa2eb7ba72092d5p1dce5bjsna84d3145dcf2"
        ],
    ]);

    $response = json_decode(curl_exec($curl), true, JSON_PRETTY_PRINT);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    }

    return $response;
}

function apiSpecificLeagueGames($leagueID) {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api-football-v1.p.rapidapi.com/v3/fixtures?live=all&league='.$leagueID.'&season=2021',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: api-football-v1.p.rapidapi.com",
            "X-RapidAPI-Key: 332c0a65dbmshaa2eb7ba72092d5p1dce5bjsna84d3145dcf2"
        ],
    ]);

    $response = json_decode(curl_exec($curl), true, JSON_PRETTY_PRINT);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    }

    return $response;
}

