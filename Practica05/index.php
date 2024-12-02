<?php

// Para importar otro archivo de código PHP
require_once "config.php";
require APP_PATH . "sesion_requerida.php";
require APP_PATH . "data_access/db.php";

// Diferentes tipos de variables
$tituloPagina = "Práctica 05 - Server Side Programming";  // variable string
$hoy = new DateTime("now");  // variable DateTime (object)
$numeroEnter = 100;  // variable int
$numeroDecimal = 3.14159;  // variable float
$valorBooleano = true;  // variable boolean

// Array de elementos string
$array01 = ["Valor 1", "Valor 2", "Valor 3"];  // con valores iniciales
$array01[] = "Valor 4";  // agregar al array un elemento al final
$array01[] = "Valor 5";  // se agrega al array otro elemento al final

// Array de arrays asociativos
$articulos = [
    ["titulo" => "Artículo 001", "id" => 1],  // array assoc
    ["titulo" => "Artículo 002", "id" => 2],  // array assoc
    ["titulo" => "Artículo 003", "id" => 3]   // array assoc
];

// Cookies para obtener la cantidad de visitas a la págnia.
$cantidadVisitas = 1;
$segundosEnUnDia = 86400;
$expira = time() + ($segundosEnUnDia * 30);  // tiempo en que expira, 30 día a partir de hoy
if (isset($_COOKIE["cantidadVisitas"])) {  // ya existe la cookie?
    $cantidadVisitas = (int)$_COOKIE["cantidadVisitas"];  // se obtiene el valor (que es un string)
    $cantidadVisitas++; 
}

// Para establecer la cookie (esta irá en el response)
setcookie(
    "cantidadVisitas",  // nombre de la cookie
    (string)$cantidadVisitas,  // valor de la cookie
    $expira   // cuándo exipira (fecha UNIX)
);

//Si no está definido se pone el año actual
$anio = isset($_POST['anio']) ? (int)$_POST['anio'] : date('Y');
//Lo mismo, si no se define, se pone el mes actual
$mes = isset($_POST['mes']) ? (int)$_POST['mes'] : date('m');

// Establecer conexión con la base de datos
$db = getDbConnection();
$sql = "SELECT * FROM archivos WHERE YEAR(fecha_subido) = ? AND MONTH(fecha_subido) = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$anio, $mes]);

// Obtener los resultados de la consulta
$archivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Se regresa el view  del index  :)
require APP_PATH . "views/index.view.php";
