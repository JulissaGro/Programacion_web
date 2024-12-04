<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <title>Práctica06: API's</title>
</head>

<body>
    <h1>Práctica 06: API's</h1>
    <div class="ranking">
        <h2>Games</h2>
        <?php foreach ($games as $game): ?>
            <p><a href="<?= APP_ROOT ?>/ver-scores.php?game=<?= $game ?>&orderAsc=0"><?= $game ?></a></p>
        <?php endforeach; ?>
    </div>

    <script src="js/index.js"></script>
</body>

</html>