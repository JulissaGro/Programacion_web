// Variables para el juego
let tablero = ["", "", "", "", "", "", "", "", ""];
let turnoJugador = true;
const stiempoSegundos = document.querySelector("#s-tiempo-segundos");
let idTimer1;
let juegoIniciado = false;
let tiempoTotal = 0;

// Función para comenzar el juego en el primer clic
function iniciarConPrimerClic(e) {
  if (!juegoIniciado) {
    empezarJuego();
  }
  movimientoJugador(e);
}

// Configuración inicial del tablero
async function configurarTablero() {
  const celdas = document.querySelectorAll("#table_tictactoe td");
  for (let i = 0; i < celdas.length; i++) {
    celdas[i].addEventListener("click", iniciarConPrimerClic);
  }
  muestraRanking(); // Muestra el ranking al cargar la página
}

// Inicia el temporizador y limpia el tablero
function empezarJuego() {
  const celdas = document.querySelectorAll("#table_tictactoe td");

  for (let i = 0; i < celdas.length; i++) {
    celdas[i].removeEventListener("click", iniciarConPrimerClic); // Elimina el evento inicial
    celdas[i].addEventListener("click", movimientoJugador); // Agrega el evento de movimiento normal
  }

  limpiaTablero();

  // Detiene el temporizador anterior si existe y empieza un nuevo tiempo de inicio
  clearInterval(idTimer1);
  tiempoTotal = 0; // Reinicia el tiempo total
  juegoIniciado = true;
  actualizarTiempoEnPantalla();

  // Inicia un nuevo intervalo para actualizar la visualización del tiempo
  idTimer1 = setInterval(actualizarTiempoEnPantalla, 100);
}

// Actualiza el tiempo mostrado en la pantalla con mayor precisión
function actualizarTiempoEnPantalla() {
  if (juegoIniciado) {
    // Convertir a segundos
    tiempoTotal += 100; // Incrementa el tiempo total en 1000 milisegundos
    // Con 2 decimales
    stiempoSegundos.textContent = tiempoTotal;
  }
}

// Limpia el tablero
function limpiaTablero() {
  const celdas = document.querySelectorAll("#table_tictactoe td");
  tablero = ["", "", "", "", "", "", "", "", ""];

  for (let i = 0; i < celdas.length; i++) {
    celdas[i].textContent = "";
  }

  turnoJugador = true;
}

// Movimiento del jugador
function movimientoJugador(e) {
  const celda = e.target;
  let celdaIndex = -1;

  //Obtener todas las filas de la tabla
  const filas = document.querySelectorAll("#table_tictactoe tr");

  // Buscar la fila y la celda
  for (let i = 0; i < filas.length; i++) {
    const celdasFila = filas[i].children; // Celdas de la fila actual
    for (let j = 0; j < celdasFila.length; j++) {
      if (celdasFila[j] === celda) {
        // Si encontramos la celda
        celdaIndex = j + i * 3;
        break;
      }
    }

    if (celdaIndex !== -1) break; // Si encontramos la celda, salimos del bucle exterior
  }

  if (turnoJugador && tablero[celdaIndex] == "") {
    celda.textContent = "X";
    tablero[celdaIndex] = "X";

    if (verificaVictoria("X")) {
      finalizaJuego(true);
    } else if (!tablero.includes("")) {
      // Verifica si hay empate
      alert("¡Empate! Nadie ha ganado.");
      finalizaJuego(null); // Llama a finalizaJuego sin ganador para indicar empate
    } else {
      turnoJugador = false;
      setTimeout(movimientoCom, 500);
    }
  }
}

// Movimiento de la computadora
function movimientoCom() {
  let celdasVacias = [];
  for (let i = 0; i < tablero.length; i++) {
    if (tablero[i] === "") celdasVacias.push(i);
  }
  const randomIndex =
    celdasVacias[Math.floor(Math.random() * celdasVacias.length)];
  tablero[randomIndex] = "O";
  const celdas = document.querySelectorAll("#table_tictactoe td");
  celdas[randomIndex].textContent = "O";

  if (verificaVictoria("O")) {
    finalizaJuego(false);
  } else if (!tablero.includes("")) {
    alert("¡Empate! Nadie ha ganado.");
    finalizaJuego(null); // Llama a finalizaJuego sin ganador para indicar empate
  } else {
    turnoJugador = true;
  }
}

// Comprueba si hay un ganador
function verificaVictoria(jugadorEnTurno) {
  const posiblesVictorias = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8], //Horizontal
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8], //Vertical
    [0, 4, 8],
    [2, 4, 6], //Diagonal
  ];

  for (let i = 0; i < posiblesVictorias.length; i++) {
    const [a, b, c] = posiblesVictorias[i];
    if (
      tablero[a] === jugadorEnTurno &&
      tablero[b] === jugadorEnTurno &&
      tablero[c] === jugadorEnTurno
    ) {
      return true;
    }
  }
  return false;
}

// Termina el juego
async function finalizaJuego(jugadorEnTurno) {
  const tiempo = stiempoSegundos.textContent;

  if (jugadorEnTurno === true) {
    const nombre = prompt("¡Ganaste! Ingresa tu nombre para el ranking:");
    if (nombre) {
      agregaARanking(nombre, tiempo);
    }
  } else if (jugadorEnTurno === false) {
    alert("La computadora ha ganado. Inténtalo de nuevo.");
  }

  limpiaTablero();
  muestraRanking();
  clearInterval(idTimer1);
  juegoIniciado = false; // Reinicia la variable para una nueva partida

  const celdas = document.querySelectorAll("#table_tictactoe td");

  for (let i = 0; i < celdas.length; i++) {
    celdas[i].removeEventListener("click", movimientoJugador);
    celdas[i].addEventListener("click", iniciarConPrimerClic);
  }
}

// Guarda el ranking en LocalStorage y API
async function agregaARanking(nombre, tiempo) {
  const datos = new FormData();
  datos.append("game", "El super juego de TIC-TAC-TOE");
  datos.append("player", nombre);
  datos.append("score", tiempo);

  const res = await fetch("ajax/add_score.php", {
    method: "POST",
    body: datos,
  });

  if (!res.ok) throw new Error("Error en la solicitud al servidor.");

  const resObj = await res.json();

  if (resObj.error) {
    alert("Error: " + resObj.message);
  } else {
    alert("Éxito: " + resObj.message);
  }
}

// Muestra el ranking en pantalla
async function muestraRanking() {
  const listaRanking = document.getElementById("ol_ranking");
  listaRanking.innerHTML = ""; // Limpiar la lista antes de agregar nuevos elementos

  const res = await fetch("ajax/index.php");
  if (!res.ok) throw new Error("Error al recuperar el ranking.");
  const ranking = await res.json();

  console.log(ranking);
  

  ranking.forEach(top => {
    const li = document.createElement("li");
    li.textContent = `${top.score}ms ${top.player} ${top.date}`;
    listaRanking.appendChild(li);
  });
}

configurarTablero();

