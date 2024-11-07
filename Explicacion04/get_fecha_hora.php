<?php
/**
 * Lado del servidor | Llamadas AJAX
 * Como son varios datos, lo que se va a retornar es un JSON
 *  el cual se retornará como un array asociativo
 */

usleep(1000000); //1 segundo de delay

//Fecha hora actual
$now = new DateTime();


//Response object como array asociativo
$resObj = [
    "fechaHoraStr" => $now -> format("d/m/Y H:i:s"),
    "fecha" => $now -> format("d/m/Y")
];

//Obtener la correspondiente representación en JSON de la response
$resObjJson = json_encode($resObj);

//Indicar al client que el tipo de respuesta será un JSON
header('Content-Type: application/json');
echo $resObjJson;
