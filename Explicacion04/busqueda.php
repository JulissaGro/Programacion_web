<?php
    //$q = $_GET['q'];
    /**
     * En lugar de usar el array asociativo de get no es una buena práctica
     * Siempre es mejor utilizar la función de filter_input 
     * Es posible validar correo electrónico, ingreso de números, por ello existe el
     *    tercer parámetro el cual son filtros para las inputs.
    */
    $q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Práctica 04</title>
    <div class="container" id="references">
        <table>
            <tr>
                <td><a href="index.view.php">Ir atrás</a></td>
            </tr>
        </table>
    </div>
</head>
<body>
    <h1>Datos de búsqueda</h1>
    <!-- Si no usamos los filtros también lo podemos "sanitizar" en el lado del usuario -->
    <p>Está buscando <strong><?= $q ?></strong></p>
</body>
</html>