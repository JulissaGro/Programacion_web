//Elementos HTML
//Son constantes porque no cambiará la referencia al valor de estas
/**
 * Con document se obtiene acceso a la API de DOM, entre ellas está la función
 * querySelector, utiliza la lógica de los selectores de css (.nombre, #nombre, elemento)
 **/
const txtNombre = document.querySelector("#txt-nombre"); //Se accede al elemento html
const btnAction = document.querySelector("#btn-action");
const sUserAgent = document.querySelector("#s-user-agent");
const txtItem = document.querySelector("#txt-item");
const btnAgregarItem = document.querySelector("#btn-agregar-item");
const ulLista = document.querySelector("#ul-lista");

//Otra de las API's para poder acceder a elementos del navegador
sUserAgent.textContent = navigator.userAgent;

//Si no existe un elemento regresará null
if (!localStorage.getItem('listaElementos')) {
  let lista = []; //Lista vacía
  /**
   * JSON es una forma de serialización de la información sirve para
   *    serializar objetos complejos u objetos simples como una lista
   */
  //let listaJson = JSON.stringify(lista); //Transformar la lista vacía en un JSON
  //Objeto complejo, un objeto que contiene a otros
  //localStorage.setItem('listaElementos', listaJson);
  //Otra forma es poniendo directamente la función:
  localStorage.setItem('listaElementos', JSON.stringify(lista));
}

//Obtener el elemento listaElementos (string), pero parseado a su representación en JSON (utilizable en javaScript)
const lista = JSON.parse(localStorage.getItem('listaElementos'));

//Agregar los elementos que ya existían
for(let i of lista){ //For each
  let li = document.createElement('li');
  li.textContent = i;
  li.addEventListener('click',li_click);
  ulLista.appendChild(li);
}

//Google te solicita la ubicación con esto para dar resultados según dónde te localizas
//navigator.geolocation Localización exacta en celulares y aproximada en computadoras

//Definir una acción
function btnAction_click(e) {
  const nombre = txtNombre.value.trim();
  /**
   * En los lenguajes de tipado dinámico existen valores llamados falsy
   * Aquellos que se pueden transformar a false: array vacio, 0, null, false
   *
   * A esto se le denomina un early return, un retorno anticipado
   * Estas validaciones se les conoce Guard Clauses, puesto que cuidan
   * que lo que se obtenga sean valores validos
   **/
  if (!nombre) {
    //Pondría el cursor en dicho elemento
    txtNombre.focus();
    return;
  }

  const mensaje = `Hola ${nombre}, bienvenido a JS; ojalá y aprendas. Burro.`;
  //Alert se encarga de mostrar un mensaje
  alert(mensaje);

  //Reiniciamos los valores después de mostrar el mensaje
  txtNombre.value = ""; //Accedemos al valor de txt
  txtNombre.focus();
}

/**
 * Se le llama eventHandler porque está diseñada para responder a un evento
 * en este caso responde al clickear el botón por medio de un eventListener
 **/
//Se agrega una función dentro de otra.
btnAction.addEventListener('click', btnAction_click);

//Puede llamarse eventHandler o callback
//Podemos definir la función dentro de los parámetros
/**
 * El parámetro e es un objeto que tiene información de un evento,
 * en este caso 'keypress'
 **/
txtNombre.addEventListener("keypress", function (e) {
  //Lo que se envia a la consola
  console.log(e.key); //Muestra en consola qué tecla se presionó

  if (e.key == "Enter") {
    btnAction.click();
  }
});

btnAgregarItem.addEventListener('click', e =>{
    const itemNombre = txtItem.value.trim();
    if (!itemNombre) {
        txtItem.focus();
        return;
    }

    //Crea un elemento del tipo 'li' que es un listado
    const li = document.createElement('li');
    li.textContent = itemNombre; //Agregar el nombre del item
    li.addEventListener('click', li_click);
    ulLista.appendChild(li); //Agregamos el hijo al final la lista existente
    txtItem.value='';
    txtItem.focus();
    //Agregamos a la lista el elemento
    lista.push(itemNombre);
    //Lo almacenamos en localStorage con su representación en JSON
    localStorage.setItem('listaElementos', JSON.stringify(lista));    
})

//Cada que se da click a un elemento, mostrará el texto del elemento
function li_click(e){
  /**
   * El valor de 'this' dependerá del contexto en el que se está utilizando.
   * 
   * Como el contexto de esta función es un eventHandler de un li, este 'this'
   * hará referencia al elemento 'li'.
   */
  const li = this;

  //Tambíen se puede acceder al contenido por el parámetro e (el eventHandler)
  console.log(li);
  console.log(e);
  
  alert('Elemento clicked => ' + li.textContent);
}


/**
 * Esta función se comporta como lo sería una clase y a la vez un constructor.
 * Esta es una forma antigua de hacer las clases. Se le dice función por la
 *    idea con la que se creó javascript, se quería que fuera un lenguaje 
 *    sencillo omitiendo las clases, sin embargo se llegaron a necesitar
 * Como integramos una función dentro de otra, se puede encontrar esto
 *     como una función de primer orden.
 * Actualmente en javascript ya existen las clases, desde 2016
 * Internamente convierte la clase a una función constructora, a esto se le
 *  conoce como syntactic sugar, solo para hacerlo más vistoso.
 */
function Persona(nombre, apellidos, edad){
  this.nombre = nombre;
  this.apellidos = apellidos;
  this.edad = edad;

  //Podemos definir funciones utilizando this
  this.saludar = function(){
    console.log(`Hola, soy ${this.nombre} ${this.apellidos}`);
  }
}

const persona01 = new Persona('Julissa', 'Guerrero', 20);
persona01.saludar();
/**
 * Podemos definir otras propiedades (variables de instancia) a lo largo 
 *    del código por eso se le conoce a javascript como dinámico.
 * Esto no modifica otras instancias, solo se está agregando a persona01.
 */
persona01.otraPropiedad = 'Otra propiedad';
console.log(persona01.otraPropiedad);
//También es posible añadir nuevas funciones
persona01.decirEdad = function(){
  console.log(`Mi edad es ${this.edad} años`);
}
persona01.decirEdad();

//Es posible añadir estas funciones y variables a toda la clase usando prototype
Persona.prototype.imprimirNombreCompleto = function(){
  console.log(`${this.nombre} ${this.apellidos}`);
  
}

const persona02 = new Persona('Vianey', 'Salazar', 20);
console.log(persona01);
console.log(persona02);

/**
 * Javascript es un lenguaje multiparadigma, no orientado a objetos
 *  sino a prototipos, algo que va cambiando construyendose con el 
 *  paso del tiempo, por ello podemos modificar directamente la
 *  "clase" persona utilizando prototype.
 */
persona01.imprimirNombreCompleto();
persona02.imprimirNombreCompleto();

/**
 * Como Javascript es un lenguaje de tipado dinámico no se checa si existe
 *    la funcionalidad extiste o no hasta que se ejecuta.
 * Javascript representa que no existe con el valor undefined, significa que
 *    no está definida esa propiedad, este es un valor falsy.
 * Es necesario verificar porque al no comprobar el programa, por el lado de
 *    Javascript puede tronar.
 * 
 * Verificar si la función está especificada en la persona 2 (son 2 formas de
 *    verificar si es o no, cualquiera funciona)
 */
if (persona02.decirEdad && typeof(persona02.decirEdad) == 'function') {
  persona02.decirEdad();
} else{
  console.log('decirEdad() no está implementado en persona02');
}

/**
 * Otra forma de definir objetos
 * Normalmente usada para objetos que contiene solo datos.
 * 
 * Cuando se guardan elementos complejos, es preferible guardarlos con esta serialización
 */
const obj01 = {
  nombre: 'Juan',
  apellidos: 'Perez'
};

/**
 * En javascript no se tiene arreglos como se tienen en otros lenguajes
 *  aquí los 'arreglos' son de longitud variable, son en realidad una lista,
 *  funciona como pila y fila, es un dequeue, double ended queue.
 * 
 * Tiene varias maneras de manejar arreglos.
 */
//Lista vacía
const arr01 = [];
arr01.push(persona01);
arr01.push(persona02);

/**
 * Nuevo array que contiene solo los nombres completos de las personas
 * 
 * Una forma:
 * Mapea para obtener el nombre completo por medio de la función de flecha
 * Retorna nombre y apellido por cada elemento, es una interpolación de strings
 * let arrNombres = arr01.map(persona => `${persona.nombre} ${persona.apellidos}`);
 * 
 * Otra forma:
 */
Persona.prototype.getNombreCompleto = function(){
  return `${this.nombre} ${this.apellidos}`;
}

let arrNombres = arr01.map(persona => persona.getNombreCompleto());
console.log(arrNombres);


//Llenado desde la definición
const arr02 = [1,2,3,4,5,6,7,8,9];

//Declarar una variable (no constante, como las que hemos estado haciendo)
//El array solo contendrá los números pares de arr02
                    //Función anónima, predicado, retorna solo verdadero falso
let arrT = arr02.filter(function (num, ix, arr){return num %2 == 0});
console.log('Pares');
console.log(arrT);
//Recorre cada elemento, por cada elemento ejecuta la función, retornando true o false
//(valor, index, array) retorna(=>) v o f si cumple con la condición
arrT = arr02.filter((num, ix, arr) => num %2 != 0); //Función abreviada (Función de flecha)

/**
 * Así es como luciría la función si no utilizaramos la de flecha,
 *  también conocida como lamda
 * 
 * Se crearon para que fuera más legible, viene de la programación
 *  funcional.
  function soloNones(arr){
  arrRes = []
  for (let ix = 0; ix < arr.length; ix++) {
    if (arr[ix] %2 != 0) {
      arrRes.push(arr[ix]);
    }
  }
  return arrRes;
} */
console.log('Nones');
console.log(arrT);

//crea un nuevo array transformando el contenido de otro según lo que se requiera
arrT = arrT.map((i,ix,arr) => i*2);
console.log(arrT);

//Si no utilizamos los elementos se pueden borrar
/* arrT.map(i => i*2);
console.log(arrT); */

console.log(localStorage.getItem('listaElemntos'));
