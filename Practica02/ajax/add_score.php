<?php
header('Content-Type: application/json');

$resObj = ["error" => null, "message" => null];


if (!isset($_POST['player']) || !strlen(trim($_POST['player']))) {
    $errores[] = "Parámetro nombre no enviado, no debe ser nulo";
}

if (!isset($_POST['score']) || !strlen(trim($_POST['score']))) {
    $errores[] = "Parámetro tiempo no enviado, intentar una nueva partida";
}

if (isset($errores) && count($errores) > 0) {
    $resObj = ['error' => true, 'errores' => $errores];
    echo json_encode($resObj);
    exit();
}

$score = filter_input(INPUT_POST, 'score');
$player = filter_input(INPUT_POST, 'player');
$game = filter_input(INPUT_POST, 'game');

/* $score = trim($_POST['score']);
$player = trim($_POST['player']);
$game = trim($_POST['game']);
 */

$post = [
    'score' => $score,
    'player' => $player,
    'game'   => $game,
];

$post = http_build_query($post);

// Preparar solicitud cURL
$addScoreUrl = "http://primosoft.com.mx/games/api/addscore.php";

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $addScoreUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $post,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/x-www-form-urlencoded',
    ],
]);

$response = curl_exec($curl);
$curlError = curl_error($curl);
curl_close($curl);

if ($curlError) {
    echo json_encode([
        'error' => true,
        'message' => $curlError
    ]);
    exit();
}

$responseData = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        'error' => true,
        'message' => 'La API devolvió una respuesta no válida.'
    ]);
    exit();
}

$mensaje = "Puntuación correctamente almacenada en la API";
$resObj = ['error' => false, 'message' => $mensaje];

echo json_encode($resObj);
