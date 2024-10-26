/**
 * API para acceder a cualquier almacenamiento local, usada para la persistencia de datos
 * Hasta que se le de borrar a todos los elementos del sitio
 * Paso 1: comprobar que exista el almacenamiento local
 */
if (!window.localStorage) {
    //Window hace referencia a todo, literal hasta las variables creadas
    alert('LocalStorafe no disponible en el navegador');
    //TODO: Terminar la ejecución
    //Redirigir a otra página si sucede esto
    /**
     * Location es una API que nos da la ubicación actual del html donde se está trabajando
     * tiene más cualidades, pero esta es la que usamos ahorita 
    */
    location.assign('index.html');
}


const sFechaHora = document.querySelector('#s-fecha-hora');
const txtLlave = document.querySelector('#txt-llave');
const txtValor = document.querySelector('#txt-valor');
const btnAgregar = document.querySelector('#btn-agregar');

/**
 * Función asíncrona, en relación al flujo de código de javaScript
 *      en teoría no se puede hacer concurrencia, la simula, pero no
 *      tiene un paralelismo al 100%, se ejecuta en realidad en un solo
 *      hilo de ejecución, no hay operaciones 100% paralelas
 *      se otorga un cierto tiempo de ejecución.
 * 
 * Existe un eventloop (ciclo infinito) que se encarga de asignar
 *      un tiempo para que se ejecute, al dar un Interval también se genera
 *      uno de estos eventos, es como un evenListener pero en función del tiempo.
 * 
 * El manejo de operaciones en paralelo es desgastante para la computadora,
 *      toma tiempo y memoria, si lo tenemos en un solo hilo de ejecución con
 *      un eventLoop que se encargue de decir qué se ejecuta primero, puede
 *      ejecutarse más rápido. En ciertas circunstancias es mejor tener
 *      procesos que simulen ser concurrentes.
 * 
 * La API de fecha que tiene javascript no es la favorita de los programadores
 *      suele variar la fecha hora por navegador, no suele ser exacta.
 * 
 * Tenemos un timer con el setInterval para tareas repetitivas
 * Cada 500 milisegundos se actualizará la fecha-hora
 */
setInterval(e =>{
    //Obtiene la fecha
    const d = new Date();
    //Lo pasa a string y se lo manda al elemento strong en el html
    sFechaHora.textContent = d.toLocaleString();
}, 1000);

//Podemos cancelar un timer
clearInterval(idTimer1);

function listarElementosEnLocalStorage() {
    console.log('Elementos en el LocalStorage');
    
    //Se puede hacer manual sin window
    //*LocalStorage solo guarda valores y llaves en string
    for (let ix = 0; ix < localStorage.length; ix++) {
        //Obtener la llave del elemento
        let k = localStorage.key(ix);
        //Obtener el elemento por medio de la llave
        let v = localStorage.getItem(k);
        console.log(`- [${k}] -> ${v}`);
    }
}

/**
 * LocalStorage tiene otro elemento llamado SessionStorage
 * sessionStorage borra el estado luego de que la página es cerrada
 * a diferencia de LocalStorage
 */
btnAgregar.addEventListener('click', e => {
    if(!txtLlave.value.trim()){
        txtLlave.focus();
        return;
    }

    localStorage.setItem(txtLlave.value.trim(), txtValor.value);
    txtLlave.value = '';
    txtValor.value = '';
    txtLlave.focus();
    listarElementosEnLocalStorage();
});