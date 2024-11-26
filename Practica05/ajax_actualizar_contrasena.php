<?php
header('Content-Type: application/json');
require "config.php";
require_once APP_PATH . 'data_access/db.php';
session_start();
$username = $_SESSION['Usuario_Username'];

$errores = [];

$password = filter_input(INPUT_POST, "password");
$passwordConfirm = filter_input(INPUT_POST, "passwordConfirm");

if (!$password|| !strlen(trim($password))||
!preg_match('#^(?=.*[a-zA-Z])(?=.*\d).{8,}$#', $password)) {
    $errores[] = "El password debe tener al menos 8 caracteres, incluyendo letras y números.";
}

if (!$passwordConfirm || 
    trim($password) !== trim($passwordConfirm)) {
    $errores[] = "La confirmación del password no coincide.";
}


if ($errores) {
    echo json_encode(['success' => false, 'errores' => $errores]);
    exit();
}

$password=trim($password);

$tamañoBytes = 32;
$bytesRandom = random_bytes($tamañoBytes);
$salt = strtoupper(bin2hex($bytesRandom));

$passwordMasSalt = $password . $salt;
$passwordEncrypted = strtoupper(hash("sha512", $passwordMasSalt));

try {

    $db = getDbConnection();
    $sqlCmd = "UPDATE usuarios 
               SET password_encrypted = ?, password_salt = ?
               WHERE username = ?";
               
    $sqlParams = [$passwordEncrypted, $salt, $username];
    $stmt = $db->prepare($sqlCmd);
    $stmt->execute($sqlParams);

    if ($stmt->rowCount()>0) {
        echo json_encode(['success' => true, 'message' => 'Usuario actualizado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'errores' => ['No se encontraron cambios en los datos.']]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'errores' => [$e->getMessage()]]);
}