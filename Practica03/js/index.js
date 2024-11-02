// Variables globales
var tablero = [];
var filas;
var columnas;
var cantidadMinas;
var celdasDescubiertas = 0;
var cantidadBanderas = 0;
var juegoTerminado = false;
var primeraSeleccion = true;

// Función para iniciar un juego personalizado
function iniciarJuegoPersonalizado() {
  filas = document.getElementById("alto").value;
  columnas = document.getElementById("ancho").value;
  cantidadMinas = document.getElementById("minas").value;

  if (filas < 5 || columnas < 5 || cantidadMinas < 1) {
    alert("Debes ingresar valores válidos: mínimo 5x5 y al menos 1 mina.");
    return;
  } else if (cantidadMinas >= filas * columnas) {
    alert("La cantidad de minas no puede ser igual o superior a la de celdas.");
    return;
  }

  configurarTablero();
}

// Función para iniciar un juego con dificultad predeterminada
function iniciarJuegoDificultad(dificultad) {
  if (dificultad === "facil") {
    filas = 5;
    columnas = 5;
    cantidadMinas = 5;
  } else if (dificultad === "medio") {
    filas = 8;
    columnas = 8;
    cantidadMinas = 10;
  } else if (dificultad === "dificil") {
    filas = 10;
    columnas = 10;
    cantidadMinas = 20;
  } else if (dificultad === "muyDificil") {
    filas = 12;
    columnas = 12;
    cantidadMinas = 30;
  } else if (dificultad === "leyenda") {
    filas = 15;
    columnas = 15;
    cantidadMinas = 50;
  }

  configurarTablero();
}

// Configura el tablero y coloca las minas
function configurarTablero() {
  tablero = []; // Reinicia el tablero
  celdasDescubiertas = 0;
  cantidadBanderas = 0;
  juegoTerminado = false;
  primeraSeleccion = true;

  for (var i = 0; i < filas; i++) {
    tablero[i] = [];
    for (var j = 0; j < columnas; j++) {
      tablero[i][j] = 0; // Inicializa las celda con valor 0
    }
  }

  dibujarTablero();
}

// Coloca las minas aleatoriamente
function colocarMinas(excluirFila, excluirColumna) {
  var minasColocadas = 0;
  while (minasColocadas < cantidadMinas) {
    var fila = Math.floor(Math.random() * filas);
    var columna = Math.floor(Math.random() * columnas);

    //Que la mina no se ponga en la primera celda clicada
    if (
      tablero[fila][columna] !== "💣" &&
      (fila !== excluirFila || columna !== excluirColumna)
    ) {
      tablero[fila][columna] = "💣";
      minasColocadas++;
    }
  }
}

// Calcula los valores de las celdas
function calcularValores() {
  for (var i = 0; i < filas; i++) {
    for (var j = 0; j < columnas; j++) {
      if (tablero[i][j] === "💣") continue;
      tablero[i][j] = contarMinasAlrededor(i, j); // Número de minas al rededor
    }
  }
}

// Cuenta el número de minas alrededor de una celda
function contarMinasAlrededor(fila, columna) {
  var contador = 0;
  // Itera sobre las celdas adyacentes
  for (var i = -1; i <= 1; i++) {
    for (var j = -1; j <= 1; j++) {
      if (i === 0 && j === 0) continue; //si es la misma celda la salta y continua con las otras
      var nuevaFila = fila + i;
      var nuevaColumna = columna + j;
      // Verifica si la celda está dentro del tablero
      if (
        nuevaFila >= 0 &&
        nuevaFila < filas &&
        nuevaColumna >= 0 &&
        nuevaColumna < columnas
      ) {
        if (tablero[nuevaFila][nuevaColumna] === "💣") {
          //Si hay una mina
          contador++;
        }
      }
    }
  }
  return contador;
}

// Dibuja el tablero en la pantalla
function dibujarTablero() {
  var tabla = document.getElementById("tablero");
  tabla.innerHTML = ""; // Limpia el tablero

  for (var i = 0; i < filas; i++) {
    var tabla = document.getElementById("tablero");
    tabla.innerHTML = ""; // Limpia el tablero
    celdas = []; // Reinicia el arreglo de celdas

    for (var i = 0; i < filas; i++) {
      var fila = document.createElement("tr");
      celdas[i] = []; // Inicializa el arreglo para la fila

      for (var j = 0; j < columnas; j++) {
        var celda = document.createElement("td");
        celda.classList.add("celda");
        celda.dataset.fila = i;
        celda.dataset.columna = j;

        // Agregar eventos para las celdas
        celda.onclick = function () {
          if (!juegoTerminado) {
            var f = this.dataset.fila;
            var c = this.dataset.columna;
            descubrirCelda(f, c);
            verificarVictoria();
          }
        };

        celda.oncontextmenu = function (event) {
          event.preventDefault();
          if (!juegoTerminado) {
            var f = this.dataset.fila;
            var c = this.dataset.columna;
            marcarCelda(f, c);
            verificarVictoria();
          }
        };

        fila.appendChild(celda);
        celdas[i][j] = celda; // Almacena la referencia de la celda
      }
      tabla.appendChild(fila);
    }
  }
}

// Descubre la celda
function descubrirCelda(fila, columna) {
  fila = parseInt(fila);
  columna = parseInt(columna);

  if (primeraSeleccion) {
    colocarMinas(fila, columna);
    calcularValores();
    primeraSeleccion = false;
  }

  var celda = celdas[fila][columna]; // Accede a la celda directamente
  if (celda.textContent != "🚩") {
    if (tablero[fila][columna] === "💣") {
      celda.innerHTML = "💣"; // Muestra bomba
      alert("¡Perdiste!");
      juegoTerminado = true;
      revelarTablero();
    } else if (!celda.classList.contains("descubierta")) {
      celda.textContent = tablero[fila][columna]; // Muestra el número de minas alrededor
      celdasDescubiertas++;
      celda.classList.add("descubierta");

      // Si el valor es 0, descubre celdas adyacentes
      if (tablero[fila][columna] === 0) {
        descubrirCeldasAdyacentes(fila, columna);
      }
    }
  }
}

// Descubre las celdas adyacentes
function descubrirCeldasAdyacentes(fila, columna) {
  // Itera sobre las celdas adyacentes
  for (var i = -1; i <= 1; i++) {
    for (var j = -1; j <= 1; j++) {
      if (i === 0 && j === 0) continue; // Si es la misma celda, salta

      var nuevaFila = fila + i;
      var nuevaColumna = columna + j;

      // Verifica si la celda está dentro del tablero
      if (
        nuevaFila >= 0 &&
        nuevaFila < filas &&
        nuevaColumna >= 0 &&
        nuevaColumna < columnas
      ) {
        var celdaAdyacente = celdas[nuevaFila][nuevaColumna];
        if (!celdaAdyacente.classList.contains("descubierta")) {
          descubrirCelda(nuevaFila, nuevaColumna);
        }
      }
    }
  }
}

// Revela todo el tablero
function revelarTablero() {
  for (var i = 0; i < filas; i++) {
    for (var j = 0; j < columnas; j++) {
      var celda = celdas[i][j];
      if (tablero[i][j] === "💣") {
        celda.textContent = "💣";
      } else {
        celda.textContent = tablero[i][j];
      }
      celda.classList.add("descubierta");
    }
  }
}

// Marca o desmarca la celda como bandera
function marcarCelda(fila, columna) {
  fila = parseInt(fila);
  columna = parseInt(columna);

  var celda = celdas[fila][columna];
  if (celda.textContent === "🚩") {
    celda.textContent = ""; // Quita la bandera
    cantidadBanderas--;
  } else if (celda.textContent === "") {
    celda.textContent = "🚩"; // Marca la celda
    cantidadBanderas++;
  }
}

// Verifica si se ha ganado el juego
function verificarVictoria() {
  console.log(
    `Llevas -> ${celdasDescubiertas} celdas de un total de ${
      filas * columnas - cantidadMinas
    } safeponits`
  );
  console.log(
    `Llevas -> ${cantidadBanderas} banderas de un total de ${cantidadMinas} minas`
  );

  if (celdasDescubiertas >= filas * columnas - cantidadMinas) {
    alert("¡Felicidades, ganaste!");
    juegoTerminado = true; // Marca el juego como terminado
  }
}
