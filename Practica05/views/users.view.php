<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <link href="<?= APP_ROOT ?>css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php require APP_PATH . "html_parts/info_usuario.php" ?>

    <div class="header">
        <h1>Práctica 05</h1>
        <h2>Basic Server Side Programming</h2>
        <h4>Bienvenido <?= $USUARIO_NOMBRE_COMPLETO ?></h4>
    </div>
    <?php require APP_PATH . "html_parts/menu.php"; ?>
    <h2>Lista de usuarios</h2>
    <form method="POST" action="users.php">
        <input type="text" name="searchUsername" placeholder="Buscar por username" value="<?= htmlspecialchars($searchUsername) ?>">
        <input type="text" name="searchName" placeholder="Buscar por nombre" value="<?= htmlspecialchars($searchName) ?>">
        <button type="submit">Buscar</button>
    </form>

    <h2>Últimos 100 Usuarios Registrados</h2>
    <table id="userListTable">
        <?php if (count($usuarios) > 0): ?>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Genero</th>
                    <th>Fecha de nacimiento</th>
                    <th>Es_admin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        <?php endif; ?>
        <tbody name="tbody">
            <?php if (count($usuarios) > 0): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <?php if ($usuario['activo'] != '0' && $usuario['nombre'] != $USUARIO_NOMBRE): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['username']) ?></td>
                            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                            <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                            <td><?= htmlspecialchars($usuario['genero']) ?></td>
                            <td><?= htmlspecialchars($usuario['fecha_nacimiento']) ?></td>
                            <td><?= htmlspecialchars($usuario['es_admin']) ?></td>
                            <td>
                                <?php if ($usuario['es_admin'] != '1'): ?>
                                    <a id="admin" href="users_admin.php?username=<?= urlencode($usuario['username']) ?>">Hacer Admin</a> |
                                <?php endif; ?>
                                <a id="reset" href="reset_password.php?username=<?= urlencode($usuario['username']) ?>">Resetear Contraseña</a> |
                                <a id="delete" href="delete_user.php?username=<?= urlencode($usuario['username']) ?>">Eliminar Usuario</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No se encontraron resultados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="footer">
        <h2>ITI - Programación Web</h2>
    </div>
    <script>src="admin_users.js"</script>
</body>

</html>