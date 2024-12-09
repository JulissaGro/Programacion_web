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
                <!-- Archivos privados -->
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
                                <tr>
                                    <?php if ($archivo['fecha_borrado'] == NULL): ?>
                                        <td class="id-archivo"><?= $archivo["id"] ?></td>
                                        <td><a href="<?= APP_ROOT ?>archivo.php?id=<?= $archivo["id"] ?>&titulo=<?= urlencode($archivo["nombre_archivo"]) ?>"><?= htmlspecialchars($archivo['nombre_archivo']) ?></a></td>
                                        <td>|<?= htmlspecialchars($archivo['fecha_subido']) ?>|</td>
                                        <td><?= htmlspecialchars($archivo['tamaño']) ?> KB</td>
                                        <?php if ($archivo['usuario_subio_id'] == $USUARIO_ID): ?>
                                            <?php if ($archivo['es_publico'] == '0'): ?>
                                                <td><input type="submit" name="publico" class="btn-hacer-publico" value="Hacer Público"></td>
                                            <?php elseif ($archivo['es_publico'] != '0' && $archivo['usuario_subio_id'] == $USUARIO_ID): ?>
                                                <td><input type="submit" name="privado" class="btn-hacer-privado" value="Hacer Privado"></td>
                                            <?php endif; ?>
                                            <td><input type="submit" name="borrar" class="btn-borrar-archivo" value="Borrar"></td>

                                        <?php elseif ($archivo['fecha_borrado'] == NULL && $archivo['usuario_subio_id'] != $USUARIO_ID && $archivo['es_publico'] != '0'): ?>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>
                                        <td>
                                            <?php if ($archivo['es_favorito'] != '1'): ?>
                                                <input type="submit" name="favorito" class="btn-favorito" value="Añadir a Favoritos">
                                            <?php else: ?>
                                                <input type="submit" name="favorito" class="btn-desfavorito" value="Retirar de Favoritos">
                                            <?php endif; ?>
                                        </td>
                                    <?php else: ?>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">No se encontraron archivos favoritos.</td>
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