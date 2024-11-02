<?php

/**
 * PHP Sirve para poder obtener datos de una base de datos, podemos
 *    conectarnos a otro servicio 
 */
$tituloPagina = "Práctica 04: Introducción a la Programación de Lado del servidor <br>";

/**
 * El código php se tiene que ejecutar, en caso de mostrar el código plano
 *    significa que algo va mal. Debe de mostrar su ejecución en html.
 *    Es decir que al inspeccionar la página deberá de mostrar html.    
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!-- Existe una versión abreviada si solo se quiere usar para imprimir -->
    <title><?php echo $tituloPagina ?></title>

    <div class="container" id="references">
        <table>
            <tr>
                <td><a href="../index.html">Volver a la lista de prácticas</a></td>
            </tr>
        </table>
    </div>
</head>

<body>
    <!-- Esta es la otra forma -->
    <h1><?= $tituloPagina; ?></h1>
    <div class="content">
        <div class="ejemploLista">
            <p>Ejemplo de generación de HTML dinámico usando PHP</p>
            <ul>
                <?php
                #El signo de peso ($) indica qué cosas son una variable
                for ($i = 0; $i < 10; $i++) {
                    echo "Hola Mundo!!! $i <br>";
                }
                ?>
            </ul>
        </div>

        <div class="ejemploLista">
            <p>Otra lista generada por php</p>
            <!-- Esta es la dorma más tradicional de trabajar con php -->
            <ul>
                <?php
                for ($i = 1; $i < 15; $i++): ?>
                    <li>Hola Mundo!!! <?= $i ?></li>
                <?php endfor ?>
            </ul>
        </div>
    </div>

    <div class="container" id="down-style">
        <img src="img/foot.png">
    </div>
    <div class="container">
        <br>
    </div>
</body>

</html>