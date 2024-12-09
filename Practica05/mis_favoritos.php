<?php

// Para importar otro archivo de código PHP
require_once "config.php";
require APP_PATH . "sesion_requerida.php";
require APP_PATH . "data_access/db.php";

$usuario_id = $_SESSION['Usuario_Id'];

$tituloPagina = "Práctica 05 - Entregable 3 Añadir a favoritos";

// Establecer conexión con la base de datos
$db = getDbConnection();
$sql = "SELECT * FROM archivos a LEFT JOIN favoritos f ON a.id = f.id_archivo WHERE f.id_usuario = ? ORDER BY f.fecha_marcado";
$stmt = $db->prepare($sql);
$stmt->execute([$usuario_id]);

$archivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

require APP_PATH . "views/mis_favoritos.view.php";