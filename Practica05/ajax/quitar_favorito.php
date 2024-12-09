<?php
require "../config.php";
require APP_PATH . "data_access/db.php";

session_start();
$usuario_id = $_SESSION['Usuario_Id'];

$REQUEST_IP_ADDRESS = "";  // Aquí tendremos el valor de la IP del client
if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $REQUEST_IP_ADDRESS = $_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    // Si se está usando un web server como reverse proxy, la dirección IP de
    // origen se obtiene aquí
    $REQUEST_IP_ADDRESS = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
elseif (!empty($_SERVER['REMOTE_ADDR'])) {
    $REQUEST_IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
}

header("Content-Type: application/json");

$resObj = ["error" => NULL, "mensaje" => NULL];

if (isset($_POST['archivo'])) {
    $date = date("Y-m-d H:i:s");
    $idArchivo = filter_input(INPUT_POST, "archivo");

    if ($idArchivo == "") {
        $resObj["error"] = "Fallo al captar id del archivo, vuelva a intentar";
        echo json_encode($resObj);
        exit();
    }


    try {

        $db = getDbConnection();
        $sql = "DELETE FROM favoritos WHERE id_archivo = ? AND id_usuario = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            $idArchivo,
            $usuario_id
        ]);

        $sql = "INSERT INTO archivos_log_general (archivo_id, usuario_id, fecha_hora, accion_realizada, ip_realiza_operacion)
            VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            $idArchivo,
            $usuario_id,
            $date,
            'RETIRADO',
            $REQUEST_IP_ADDRESS
        ]);
    } catch (Exception $e) {
        $resObj["error"] = $e->getMessage();
        echo json_encode($resObj);
        exit();
    }

    $resObj["mensaje"] = "Archivo eliminado de favoritos exitosamente.";
    echo json_encode($resObj);
}
