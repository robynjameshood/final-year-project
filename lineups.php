<?php
session_start();

$id = $_GET['id'];

//echo $id;

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures/lineups?fixture=" . $id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: api-football-v1.p.rapidapi.com",
        "X-RapidAPI-Key: 876d579235msh398dd1932516a96p1ffad5jsnd2510f2f083f"
    ],
]);

$response = json_decode(curl_exec($curl), true, JSON_PRETTY_PRINT);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
}

if (empty($response['response'])) {
    echo "Lineup Not Available for this fixture";
} else {
    echo $response['response'][0]['team']['name'];
    foreach ($response['response'][0]['startXI'] as $lineup) {
        echo $lineup['player']['name'] . '<br>';
    }
    echo $response['response'][1]['team']['name'];
    foreach ($response['response'][1]['startXI'] as $lineup) {
        echo $lineup['player']['name'] . '<br>';
    }
}