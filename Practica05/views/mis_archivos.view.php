<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?= APP_ROOT ?>css/style.css" rel="stylesheet" type="text/css" />
    <title><?php echo $tituloPagina; ?></title>
    <script src="<?= APP_ROOT ?>js/config.js"></script>
</head>

<body>

    <?php require APP_PATH . "html_parts/info_usuario.php" ?>

    <div class="header">
        <h1>Práctica 05</h1>
        <h2>Basic Server Side Programming</h2>
        <h4>Bienvenido <?= $USUARIO_NOMBRE_COMPLETO ?></h4>
    </div>

    <?php require APP_PATH . "html_parts/menu.php"; ?>

    <div class="row">
        <div class="leftcolumn">
            <div class="card">
                <h2>Archivos</h2>

                <form method="POST" action="mis_archivos.php">
                    <label for="anio">Año:</label>
                    <input type="number" name="anio" id="anio" value="<?= htmlspecialchars($anio) ?>" min="2000" max="<?= date('Y') ?>" />

                    <label for="mes">Mes:</label>
                    <input type="number" name="mes" id="mes" value="<?= htmlspecialchars($mes) ?>" min="1" max="12" />

                    <button type="submit">Filtrar</button>
                </form>

                <!-- Archivos privados -->
                <h3>Propios</h3>
                <table>
                    <?php if (count($archivos) > 0): ?>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Fecha-hora</th>
                                <th>Peso</th>
                                <th>Privado/Público</th>
                                <th>Borrar</th>
                                <th>Favorito</th>
                            </tr>
                        </thead>
                    <?php endif; ?>
                    <tbody name="tbody">
                        <?php if (count($archivos) > 0): ?>
                            <?php foreach ($archivos as $archivo): ?>
                                <?php if ($archivo['fecha_borrado'] == NULL && $archivo['usuario_subio_id'] == $USUARIO_ID): ?>
                                    <tr>
                                        <td class="id-archivo"><?= $archivo["id"] ?></td>
                                        <td><a href="<?= APP_ROOT ?>archivo.php?id=<?= $archivo["id"] ?>&titulo=<?= urlencode($archivo["nombre_archivo"]) ?>"><?= htmlspecialchars($archivo['nombre_archivo']) ?></a></td>
                                        <td>|<?= htmlspecialchars($archivo['fecha_subido']) ?>|</td>
                                        <td><?= htmlspecialchars($archivo['tamaño']) ?> KB</td>
                                        <?php if ($archivo['es_publico'] == '0'): ?>
                                            <td><input type="submit" name="publico" class="btn-hacer-publico" value="Hacer Público"></td>
                                        <?php elseif ($archivo['es_publico'] != '0' && $archivo['usuario_subio_id'] == $USUARIO_ID): ?>
                                            <td><input type="submit" name="privado" class="btn-hacer-privado" value="Hacer Privado"></td>
                                        <?php endif; ?>
                                        <td><input type="submit" name="borrar" class="btn-borrar-archivo" value="Borrar"></td>
                                        <td>
                                            <?php if ($archivo['es_favorito'] != '1' || $archivo['es_favorito'] == NULL): ?>
                                                <input type="submit" name="favorito" class="btn-favorito" value="Añadir a Favoritos">
                                            <?php else: ?>
                                                <input type="submit" name="favorito" class="btn-desfavorito" value="Retirar de Favoritos">
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">No se encontraron archivos privados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div> <!-- End left column -->

        <!-- Incluimos la parte derecha de la página, que está procesada en otro archivo -->
        <?php require APP_PATH . "html_parts/page_right_column.php"; ?>

    </div> <!-- End row-->

    <div class="footer">
        <h2>ITI - Programación Web</h2>
    </div>

    <script src="<?= APP_ROOT ?>js/index.js"></script>
    <script src="<?= APP_ROOT ?>js/hacer_favorito.js"></script>
</body>

</html>