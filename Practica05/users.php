<?php
require "config.php";
require_once APP_PATH . 'data_access/db.php';
require_once APP_PATH . "session.php";

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

// Incluir la vista HTML para mostrar los resultados
include APP_PATH . 'views/users.view.php';
