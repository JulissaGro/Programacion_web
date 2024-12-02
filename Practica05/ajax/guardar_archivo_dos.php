<?php
require "../config.php";
require APP_PATH . "data_access/db.php";
session_start();
$username = $_SESSION['Usuario_Username'];
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

if (empty($_FILES) || !isset($_FILES["archivo"])) {
    $resObj["error"] = "Archivo no especificado";
    echo json_encode($resObj);
    exit();
}

$date = date("Y-m-d H:i:s");
$archivo = $_FILES["archivo"];
$tamanio = $archivo["size"];
$nombreArchivo = $archivo["name"];
$rutaTemporal = $archivo["tmp_name"];
$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

//Generar nombre aleatorio
srand(floor(time()));
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < 10; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
}

$nombreArchivoAleatorio = $randomString . $nombreArchivo;

$rutaAGuardar = DIR_UPLOAD . $nombreArchivoAleatorio;
$seGuardoArchivo = move_uploaded_file($rutaTemporal, $rutaAGuardar);
if (!$seGuardoArchivo) {
    $resObj["error"] = "No se pudo guardar el archivo :(((((";
    echo json_encode($resObj);
    exit();
}

$tamanioBytes = 32;
$bytesRandom = random_bytes($tamanioBytes);
$salt = strtoupper(bin2hex($bytesRandom));

$hash = $nombreArchivo . $salt;
$hashSha = strtoupper(hash("sha512", $hash));

$descripcion = filter_input(INPUT_POST, "descripcion");
$privacidad = filter_input(INPUT_POST, "privacidad");

try {
    $db = getDbConnection();
    $sql = "INSERT INTO archivos (nombre_archivo, descripcion, extension, nombre_archivo_guardado, tamaño, hash_sha256, fecha_subido, usuario_subio_id, es_publico)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        $nombreArchivo,
        $descripcion,
        $extension,
        $nombreArchivoAleatorio,
        $tamanio,
        $hashSha,
        $date,
        $usuario_id,
        $privacidad
    ]);

    $last_id = $db->lastInsertId();

    $sql = "INSERT INTO archivos_log_general (archivo_id, usuario_id, fecha_hora, accion_realizada, ip_realiza_operacion)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        $last_id,
        $usuario_id,
        $date,
        'CREAR',
        $REQUEST_IP_ADDRESS
    ]);
    
} catch (Exception $e) {
    $resObj["error"] = $e->getMessage();
    echo json_encode($resObj);
    exit();
}

$resObj["mensaje"] = "Archivo guardado correctamente.";

echo json_encode($resObj);
