const btnEjecutar = document.querySelector('#btn-ejecutar');
const sProcesoEstatus = document.querySelector('#s-proceso-status');

//Función asíncrona, se puede utilizar el await, en lugar de then
// Then es utilizado en la función de mero abajo
//Una forma más moderna de tratarla, en lugar de usar Promise
async function btnEjecutar_click(e) {
    btnEjecutar.disabled = true;
    sProcesoEstatus.textContent = 'En ejecución';
    //await solo se puede utilizar en funciones asíncronas
    //Aquí se para la ejecución, espera que la promesa se cumpla
    const resultado = await procesoTardado(4, 'ProcButton');
    sProcesoEstatus.textContent = `La ejecución regresó ${resultado}`;
    btnEjecutar.disabled = false;
}

btnEjecutar.addEventListener('click', btnEjecutar_click);

/**
 *Funciones de primer orden: Nos permite recibir funciones  
 */ 

function iterador(desde, hasta, accion) {
    for (let ix = desde; ix < hasta; ix++) {
        accion(ix);
    }
}

//Podemos insertar funciones
iterador(1,10,function(i) {
    console.log(`Iteración: ${i}`);
    
});

//Otra forma de declarar una función sería fun0hasta2(i)
//También se puede usar let, en lugar de const
const func0hasta2 = i =>{
    alert(`Hola #${i}`);
};

iterador(0,2,func0hasta2);


/**
 * CLOSURES
 * Nos permite regresar una función
 */
function hacerSumador(numeroASumar) {
    let suma = 0;
    const funcionResultado = () => {
        suma += numeroASumar;
        console.log(`Suma a ${numeroASumar} esta en ${suma}`);
    };

    return funcionResultado;
}

//Estas constantes son funciones que podemos llamar
const sumador1 = hacerSumador(1);
const sumador2 = hacerSumador(2);

sumador1();
sumador1();
sumador1();
sumador2();

setTimeout(() => {
    console.log('Timeout ejecutado');    
}, 2500);

console.log('Mensaje después de la definición del timeout');

//Regresa un objeto
function procesoTardado(tiempoSegundos, nombreProceso){
    const tiempoMilisegundos = tiempoSegundos * 1000;
    
    //nos pide una función
    //Algo en el futuro que se va a terminar y va a retornar algo
    return new Promise(function(resolve, reject){
        setTimeout(()=>{
            console.log(`Proceso: ${nombreProceso} terminado`);
            resolve(tiempoSegundos);            
        }, tiempoMilisegundos);
    });
};

//Normalmente no se guarda en variables
//const proceso1 = procesoTardado(5, 'Proc01');

//Se suele usar cuando se quiere manejar paralelismo,
//    aunque en realidad nos sea capaz de hacerlo.

//Se hace esto
console.log('Empieza Proc01');
procesoTardado(5, 'Proc01')
    .then(resultado =>{
        console.log('Esto se ejecuta después de que termina el Proc01');
        console.log(`Proc01 nos regresó -> ${resultado}`);
    }
);

console.log('Terminó el Proc01???');

