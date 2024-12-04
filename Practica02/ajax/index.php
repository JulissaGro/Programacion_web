<?php
header('Content-Type: application/json');

$game = "El super juego de TIC-TAC-TOE";
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
$scores = json_decode($responseContent, true);

if (!$scores) {
    echo json_encode(["error" => "No se recibieron datos válidos"]);
    exit;
}

$scores = array_slice($scores, 0, 10);

echo json_encode($scores);