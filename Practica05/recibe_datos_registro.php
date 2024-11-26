<?php
require "config.php";
require_once APP_PATH . 'data_access/db.php';
header("Content-Type: application/json");

// Inicializamos el arreglo de errores
$errores = [];

// Filtramos los datos recibidos
$username = filter_input(INPUT_POST, "username");
$name = filter_input(INPUT_POST, "name");
$lastname = filter_input(INPUT_POST, "lastname");
$gender = filter_input(INPUT_POST, "gender");
$dateBirth = filter_input(INPUT_POST, "date-birth");
$password = filter_input(INPUT_POST, "password");
$passwordConfirm = filter_input(INPUT_POST, "password-confirm");

// Validaciones
if (!$username || !strlen(trim($username)) || !preg_match('#^[a-zA-Z\d_]+$#', $username)) {
    $errores[] = "El username solo puede contener letras, números y guion bajo.";
} else {
    $sqlCmd = "SELECT id FROM usuarios WHERE username = ?";  // Comando SQL
    $db = getDbConnection();  // Obtenemos la conexión a la base de datos
    $sqlParams = [$username];  // Parámetros de la consulta
    $stmt = $db->prepare($sqlCmd);  // Preparamos el statement
    $stmt->execute($sqlParams);  // Ejecutamos con los parámetros 

    if ($stmt->rowCount() > 0) {
        $errores[] = "El username ya está en uso.";
    }
}

if (!$name || !strlen(trim($name))) {
    $errores[] = "Nombre no especificado correctamente.";
}

if ($lastname && !strlen(trim($lastname))) {
    $errores[] = "Apellido no especificado correctamente";
}

if (!$gender || !strlen(trim($gender))) {
    $errores[] = "Genero no valido";
}

if (
    !$password || !strlen(trim($password)) ||
    !preg_match('#^(?=.*[a-zA-Z])(?=.*\d).{8,}$#', $password)
) {
    $errores[] = "El password debe tener al menos 8 caracteres, incluyendo letras y números.";
}

if (
    !$passwordConfirm || !strlen(trim($passwordConfirm)) ||
    trim($password) !== trim($passwordConfirm)
) {
    $errores[] = "La confirmación del password no coincide.";
}

if ($errores) {
    echo json_encode(['success' => false, 'errores' => $errores]);
    exit();
}

try {
    $username = strtolower(trim($username));
    $name = trim($name);
    $lastname = trim($lastname);
    $password = trim($password);


    $tamañoBytes = 32;
    $bytesRandom = random_bytes($tamañoBytes);
    $salt = strtoupper(bin2hex($bytesRandom));

    $passwordMasSalt = $password . $salt;
    $passwordEncrypted = strtoupper(hash("sha512", $passwordMasSalt));

    $db = getDbConnection();
    $sqlCmd = "INSERT INTO usuarios (username, password_encrypted, password_salt, nombre, apellidos, genero, fecha_nacimiento, fecha_hora_registro, es_admin, activo)
           VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), 0, 1)";
    $sqlParams = [$username, $passwordEncrypted, $salt, $name, $lastname, $gender, $dateBirth];  // Parámetros de la consulta
    $stmt = $db->prepare($sqlCmd);
    $stmt->execute($sqlParams);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'errores' => [$e->getMessage()]]);
}

header("Location: " . APP_ROOT);
