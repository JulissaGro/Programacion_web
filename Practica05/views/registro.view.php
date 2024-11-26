<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= APP_ROOT ?>css/style.css" rel="stylesheet" type="text/css" />
    <title>Registro</title>
</head>

<body>
    <div class="header">
        <h1>Práctica 05</h1>
        <h2>Basic Server Side Programming</h2>
    </div>

    <?php require APP_PATH . "html_parts/menu.php"; ?>

    <div class="card">

        <form id="form-post-ajax-json" action="recibe_datos_registro.php" method="POST">
            <table>
                <tr>
                    <!-- Pasar a minúsculas, pueden ser letras números y guión bajo(_) -->
                    <td><label for="txt-username">Username:</label></td>
                    <td><input type="text" name="username" id="txt-username" pattern="^[a-zA-Z\d_]+$" required />
                </tr>
                <tr>
                    <td><label for="txt-name">Name:</label></td>
                    <td><input type="text" name="name" id="txt-name" required />
                </tr>
                <tr>
                    <td><label for="txt-lastname">LastName:</label></td>
                    <td><input type="text" name="lastname" id="txt-lastname" />
                </tr>
                <tr>
                    <td><label for="slt-gender">Gender:</label></td>
                    <td>
                        <select id="slt-gender" name="gender">
                            <option value="X">No answer</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="txt-date-bitrh">Date of bitrh:</label></td>
                    <td><input type="date" name="date-birth" id="txt-date-bitrh" required/>
                </tr>
                <tr>
                    <!-- Mínio 8 caracteres, contener letras y números -->
                    <td><label for="txt-password">Password:</label></td>
                    <td><input type="password" name="password" id="txt-password" minlength="8" pattern="^(?=.*[a-zA-Z])(?=.*\d).{8,}$" required />
                </tr>
                <tr>
                    <td><label for="txt-password-confirm">Confirm password:</label></td>
                    <td><input type="password" name="password-confirm" id="txt-password-confirm" required />
                </tr>
                <tr>
                    <td></td>
                    <td><input id="btn-enviar-registro" type="submit" value="ENTRAR" /></td>
                </tr>
            </table>
        </form>
    </div>

    <div class="footer">
        <h2>ITI - Programación Web</h2>
    </div>
    <script src="js/enviar_registro.js"></script>
</body>

</html>