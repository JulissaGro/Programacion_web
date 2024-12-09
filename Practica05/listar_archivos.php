<?php
// Para importar otro archivo de código PHP
require_once "config.php";
require APP_PATH . "sesion_requerida.php";
require APP_PATH . "data_access/db.php";

$tituloPagina = "Práctica 05 - Entregable 3 Añadir a favoritos";

$id = filter_input(INPUT_GET, "id");
$nombre = filter_input(INPUT_GET, "nombre");

//Si no está definido se pone el año actual
$anio = isset($_POST['anio']) ? (int)$_POST['anio'] : date('Y');
//Lo mismo, si no se define, se pone el mes actual
$mes = isset($_POST['mes']) ? (int)$_POST['mes'] : date('m');

// Establecer conexión con la base de datos
$db = getDbConnection();
$sql = "SELECT * FROM archivos a LEFT JOIN  favoritos f ON a.id = f.id_archivo WHERE YEAR(a.fecha_subido) = ?
        AND MONTH(a.fecha_subido) = ? AND a.usuario_subio_id = ? AND a.es_publico = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$anio, $mes, $id, 1]);

$archivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

require APP_PATH . "views/listar_archivos.view.php";