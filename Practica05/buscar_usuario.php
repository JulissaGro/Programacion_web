<?php

// Para importar otro archivo de código PHP
require_once "config.php";
require APP_PATH . "sesion_requerida.php";
require APP_PATH . "data_access/db.php";

$tituloPagina = "Práctica 05 - Entregable 3 Añadir a favoritos";

$searchUsername = isset($_POST['searchUsername']) ? $_POST['searchUsername'] : '';
$searchName = isset($_POST['searchName']) ? $_POST['searchName'] : '';

// Establecer conexión con la base de datos
$db = getDbConnection();

$sql = "SELECT * FROM usuarios WHERE 1=1";
$params = [];

if ($searchUsername) {
    $sql .= " AND username LIKE ?";
    $params[] = "%$searchUsername%";
}

if ($searchName) {
    $sql .= " AND nombre LIKE ?";
    $params[] = "%$searchName%";
}

$stmt = $db->prepare($sql);
$stmt->execute($params);

// Obtener los resultados de la consulta
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

require APP_PATH . "views/buscar_usuario.view.php";