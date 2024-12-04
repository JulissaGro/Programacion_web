<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica06: API's</title>
</head>
<body>
    <h1>Práctica 06: API's</h1>
    <h2>Games:</h2>
    <ul>
        <?php foreach ($games as $game): ?>
            <li><a href="<?=APP_ROOT?>/ver-scores.php?game=<?=$game?>&orderAsc=0"><?=$game?></a></li>
        <?php endforeach; ?>
    </ul>

    <script src="js/index.js"></script>
</body>
</html>