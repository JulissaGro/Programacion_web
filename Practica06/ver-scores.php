<?php
$game = filter_input(INPUT_GET, "game");
if (!$game) {
    echo "Es necesario el parámetro url";
    exit();
}

$gameEncoded = urlencode($game);
$urlGetScore = "http://primosoft.com.mx/games/api/getscores.php?game=$gameEncoded&orderAsc=1";

$ch = curl_init();
curl_setopt_array(
    $ch,
    [
        CURLOPT_URL => $urlGetScore, //url a la que se llama
        CURLOPT_RETURNTRANSFER => true, //texto de la respuesta
        CURLOPT_FOLLOWLOCATION => true, //si existe un redirect, lo sigue
        CURLOPT_TIMEOUT => 30 //timeout en segundos
    ]
);

$responseContent = curl_exec($ch);
curl_close($ch);

//Tener un json de la respuesta
$scores = json_decode($responseContent, true);

include "views/ver-scores.view.php";
