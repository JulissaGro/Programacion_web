<?php
header('Content-Type: application/json');
require "config.php";
require_once APP_PATH . 'data_access/db.php';
session_start();
$username = $_SESSION['Usuario_Username'];

$errores = [];

$name = filter_input(INPUT_POST, "name");
$lastname = filter_input(INPUT_POST, "lastname");
$gender = filter_input(INPUT_POST, "gender");
$dateBirth = filter_input(INPUT_POST, "date-birth");

if (!$name || !strlen(trim($name))) {
    $errores[] = "Nombre no especificado correctamente.";
}

if ($lastname &&  !strlen(trim($lastname))) {
    $errores[] = "Apellido no especificado correctamente.";
}

if (!$gender || !strlen(trim($gender))) {
    $errores[] = "Género no válido.";
}

if (!$dateBirth || !strlen(trim($dateBirth))) {
    $errores[] = "Fecha de nacimiento no válida.";
}

if ($errores) {
    echo json_encode(['success' => false, 'errores' => $errores]);
    exit();
}

try {
    $db = getDbConnection();

    $sqlCmd = "UPDATE usuarios 
               SET nombre = ?, apellidos = ?, genero = ?, fecha_nacimiento = ?
               WHERE username = ?";
    $sqlParams = [$name, $lastname, $gender, $dateBirth, $username];

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
