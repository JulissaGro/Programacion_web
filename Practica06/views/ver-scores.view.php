<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <title>Práctica06: API's</title>
</head>

<body>
    <div class="container" id="references">
        <table>
            <tr>
                <td><a href="../">Volver a la lista de juegos</a></td>
            </tr>
        </table>
    </div>
    <h1>Práctica 06: API's</h1>
    <div class="ranking">
        <h2><?= $scores[0]['game'] ?></h2>
        <hr>
    </div>
    <div class="content">
        <table class="tictactoe">
            <thead>
                <?php if (count($scores) > 0): ?>
                    <tr>
                        <th>Id</th>
                        <th>Puntuación</th>
                        <th>Jugador</th>
                        <th>Fecha</th>
                    </tr>
                <?php endif; ?>
            </thead>
            <tbody>
                <?php foreach ($scores as $score): ?>
                    <tr>
                        <td><?= $score['id'] ?></td>
                        <td><?= $score['score'] ?></td>
                        <td><?= $score['player'] ?></td>
                        <td><?= $score['date'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="js/index.js"></script>
</body>

</html>