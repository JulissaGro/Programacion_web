<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
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
    <div>
        <h2>Editar Usuario</h2>
        <form id="editUserForm">
            <table>
                <tr>
                    <td><label for="username">User:</label></td>
                    <td>
                        <input type="text" id="txt-username" name="username" value="<?= $USUARIO_USERNAME ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td><label for="name">Name:</label></td>
                    <td>
                        <input type="text" id="txt-name" name="name" value="<?= $USUARIO_NOMBRE ?>" required>
                    </td>
                </tr>

                <tr>
                    <td><label for="lastname">Lastname:</label></td>
                    <td><input type="text" id="txt-lastname" name="lastname" value="<?= $USUARIO_APELLIDOS ?>"></td>
                </tr>

                <tr>
                    <td><label for="gender">Gender:</label></td>
                    <td><select id="txt-gender" name="gender" required>
                            <option selected value="X">No answer</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select></td>
                </tr>

                <tr>
                    <td><label for="date-birth">Date of bitrh:</label></td>
                    <td><input type="date" id="txt-date-birth" name="date-birth" value="<?= $USUARIO_FECHANAC ?>" required></td>
                </tr>

                <tr>
                    <td></td>
                    <td><button type="submit" id="btn-enviar-registro">Actualizar</button></td>
                </tr>
            </table>
        </form>
        <a href="<?=APP_ROOT?>actualizar_contrasena.php">¿Olvidaste tu contraseña?</a>
    </div>
    <div class="footer">
        <h2>ITI - Programación Web</h2>
    </div>
    <script src="js/editar_usuario.js"></script>
</body>

</html>