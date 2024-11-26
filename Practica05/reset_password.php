<?php
require "config.php";
require_once APP_PATH . 'data_access/db.php';
require_once APP_PATH . 'session.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $defaultPassword = '12345';

    $tamañoBytes = 32;
    $bytesRandom = random_bytes($tamañoBytes);
    $salt = strtoupper(bin2hex($bytesRandom));

    $passwordMasSalt = $defaultPassword . $salt;
    
    $passwordEncrypted = strtoupper(hash("sha512", $passwordMasSalt));

    try {
        $db = getDbConnection();
        $sqlCmd = "UPDATE usuarios SET password_encrypted = ?, password_salt = ? WHERE username = ?";
        $stmt = $db->prepare($sqlCmd);
        $stmt->execute([$passwordEncrypted, $salt, $username]);

        echo "<script>alert('La contraseña del usuario {$username} ha sido restablecida.'); window.location.href = 'users.php';</script>";
    } catch (Exception $e) {

        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = 'users.php';</script>";
    }
}