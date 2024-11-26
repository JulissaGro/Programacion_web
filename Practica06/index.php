<!-- Listar los juegos -->
<?php
//URL del endpoint que vamos a llamar
$urlGetGames = "http://primosoft.com.mx/games/api/getgames.php";

//LLamada a la API, poder hacer peticiones http
$ch = curl_init(); //init de la petición http
curl_setopt_array($ch, [ //Establecimiento de opciones
    CURLOPT_URL => $urlGetGames, //url a la que se llama
    CURLOPT_RETURNTRANSFER => true, //texto de la respuesta
    CURLOPT_FOLLOWLOCATION => true, //si existe un redirect, lo sigue
    CURLOPT_TIMEOUT => 30 //timeout en segundos
]);

//Texto de la respuesta
$responseContent = curl_exec($ch);
curl_close($ch);

//Tener un json de la respuesta
$games = json_decode($responseContent, true);

include "views/index.view.php";