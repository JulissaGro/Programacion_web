<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!-- Existe una versión abreviada si solo se quiere usar para imprimir -->
    <!-- El uso de PHP normalmente es para imprimir algo que requerimos en HTML -->
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
    <?php require 'parte_html.php'?>
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

    <h3>Lista de Personas</h3>
    <div class="personas">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Edad</th>
                    <th>Deportes Practicados</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($personas as $p): ?>
                    <tr>
                        <td><?= $p['nombre'] ?></td>
                        <td><?= $p['apellidos'] ?></td>
                        <td><?= $p['edad'] ?></td>
                        <td>
                            <ul>
                                <?php foreach ($p['deportesPracticados'] as $d): ?>
                                    <li><?= $d ?></li>
                                <?php endforeach ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    </div>
    <!-- Serializa los datos que están en los input y los envia al servidor, ya sea
            una petición GET o una petición POST
        Normalmente en las peticiones GET los parámetros son enviados por la URL    
     -->
    <h3>Formularios</h3>
    <div>
        <form action="busqueda.php" method="GET">
            <label for="txt-q">Buscar: </label>
            <input type="text" name="q" id="txt-q" placeholder="buscar..." required>
            <input type="submit" value="Buscar">
        </form>
    </div>

    <div class="container" id="down-style">
        <img src="img/trini.png">
    </div>
    <div class="container">
        <br>
    </div>
</body>

</html>