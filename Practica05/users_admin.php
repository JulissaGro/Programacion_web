<?php
require "config.php";
require_once APP_PATH . 'data_access/db.php';
require_once APP_PATH . 'session.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    try {
        $db = getDbConnection();
        $sqlCmd = "UPDATE usuarios SET es_admin = '1' WHERE username = ?";
        $stmt = $db->prepare($sqlCmd);
        $stmt->execute([$username]);

        echo "<script>alert('El usuario {$username} ahora es admin.'); window.location.href = 'users.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = 'users.php';</script>";
    }
}