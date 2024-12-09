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
    <h2>Filtrar usuarios</h2>
    <form method="POST" action="buscar_usuario.php">
        <input type="text" name="searchUsername" placeholder="Buscar por username" value="<?= htmlspecialchars($searchUsername) ?>">
        <input type="text" name="searchName" placeholder="Buscar por nombre" value="<?= htmlspecialchars($searchName) ?>">
        <button type="submit">Buscar</button>
    </form>

    <h2>Listado de usuarios registrados</h2>
    <table id="userListTable">
        <?php if (count($usuarios) > 0): ?>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Nombre Completo</th>
                    <th>Listado de archivos</th>
                </tr>
            </thead>
        <?php endif; ?>
        <tbody name="tbody">
            <?php if (count($usuarios) > 0): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <?php if ($usuario['activo'] != '0' && $usuario['nombre'] != $USUARIO_NOMBRE): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['username']) ?></td>
                            <td><?= htmlspecialchars($usuario['nombre'].' '.$usuario['apellidos']) ?></td>
                            <td>
                                <a id="lista" href="listar_archivos.php?id=<?= urlencode($usuario['id']) ?>&nombre=<?= urlencode($usuario['nombre']) ?>">Ver archivos públicos</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Ingrese una búsqueda válida.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="footer">
        <h2>ITI - Programación Web</h2>
    </div>
    <script>
        src = "admin_users.js"
    </script>
</body>

</html>