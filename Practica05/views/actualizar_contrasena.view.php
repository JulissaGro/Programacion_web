<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= APP_ROOT ?>css/style.css" rel="stylesheet" type="text/css" />
    <title><?php echo $tituloPagina; ?></title>
</head>

<body>
    <?php require APP_PATH . "html_parts/info_usuario.php"; ?>

    <div class="header">
        <h1>Práctica 05</h1>
        <h2>Basic Server Side Programming</h2>
        <h4>Bienvenido <?= $USUARIO_NOMBRE_COMPLETO ?></h4>
    </div>

    <?php require APP_PATH . "html_parts/menu.php"; ?>

    <div class="card">
        <h2>Actualizar contraseña</h2>
        <form id="actualizaChontrasena" method="POST">
            <table>
                <tr>
                    <!-- Mínio 8 caracteres, contener letras y números -->
                    <td><label for="txt-password">Password:</label></td>
                    <td><input type="password" name="password" id="txt-password" minlength="8" pattern="^(?=.*[a-zA-Z])(?=.*\d).{8,}$" required />
                </tr>
                <tr>
                    <td><label for="txt-password-confirm">Confirm password:</label></td>
                    <td><input type="password" name="password-confirm" id="txt-password-confirm" minlength="8" pattern="^(?=.*[a-zA-Z])(?=.*\d).{8,}$" required />
                </tr>
                <tr>
                    <td></td>
                    <td><input id="btn-actualizar" type="submit" value="Actualizar"></td>
                </tr>
            </table>
        </form>
    </div>

    <div class="footer">
        <h2>ITI - Programación Web</h2>
    </div>
    <script>
        const APP_ROOT = "<?php echo APP_ROOT; ?>";
    </script>
    <script src="js/actualizar_contrasena.js"></script>
</body>

</html>