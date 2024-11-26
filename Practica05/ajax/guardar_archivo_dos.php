<?php
require "../config.php";
require_once APP_PATH . 'data_access/db.php';
session_start();
$username = $_SESSION['Usuario_Username'];
$usuario_id = $_SESSION['Usuario_Id'];

header("Content-Type: application/json");

$resObj = ["error" => NULL, "mensaje" => NULL];

if (empty($_FILES) || !isset($_FILES["archivo"])) {
    $resObj["error"] = "Archivo no especificado";
    echo json_encode($resObj);
    exit();
}

$archivo = $_FILES["archivo"];
$tamaño = $archivo["size"];
$nombreArchivo = $archivo["name"];
$rutaTemporal = $archivo["tmp_name"];
$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
$nombreArchivoAleatorio = uniqid().$nombreArchivo.".".$extension;

$rutaAGuardar = DIR_UPLOAD . $nombreArchivo;

$tamañoBytes = 32;
$bytesRandom = random_bytes($tamañoBytes);
$salt = strtoupper(bin2hex($bytesRandom));

$hash = $rutaAGuardar . $salt;
$hashSha = strtoupper(hash("sha512", $hash));

$seGuardoArchivo = move_uploaded_file($rutaTemporal, $rutaAGuardar);
if (!$seGuardoArchivo) {
    $resObj["error"] = "No se pudo guardar el archivo :(";
    echo json_encode($resObj);
    exit();
}

try {
    $db = getDbConnection();
    $sql = "INSERT INTO archivos (nombre_archivo, extension, nombre_archivo_guardado, tamaño, hash_sha256, fecha_subida, usuario_subio_id)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        $nombreArchivo,
        $extension,
        $nombreArchivoAleatorio,
        $tamaño,
        $hashSha,
        date('Y-m-d H:i:s'),
        $usuario_id,
    ]);
    
} catch (Exception $e) {
    $resObj["error"] = $e->getMessage();
    echo json_encode($resObj);
    exit();
}

$resObj["mensaje"] = "Archivo guardado correctamente.";

echo json_encode($resObj);
