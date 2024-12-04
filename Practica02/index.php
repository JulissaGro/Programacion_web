<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Práctica 02: Tic Tac Toe</title>

  <div class="container" id="references">
    <table>
      <tr>
        <td><a href="../">Volver a la lista de prácticas</a></td>
      </tr>
    </table>
  </div>
</head>

<body>
  <img class="banner_top" src="img/halloween_banner_top.png" />
  <h1>Práctica 02: TIC TAC TOE</h1>
  <div class="content">
    <div class="cat">
      <img src="img/cat.gif" />
    </div>

    <div class="tictactoe">
      <table id="table_tictactoe">
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table>
      <a style="font-size:18px; font-weight: 900;" href="../Practica06/index.php">Mira el ranking de otros juegos</a>
    </div>
    <div class="ranking">
      <h2>Ranking de Mejores Tiempos</h2>
      <ol id="ol_ranking">
      </ol>
    </div>
  </div>
  <p>Tiempo: <strong id="s-tiempo-segundos"></strong></p>

  <div class="banner_bottom">
    <br />
  </div>
  <script src="js/index.js"></script>
</body>

</html>