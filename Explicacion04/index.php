<?php

/**
 * Es buena práctica dividir la lógica de las peticiones y la que muestra los datos.
 * 
 * PHP Sirve para poder obtener datos de una base de datos, podemos
 *    conectarnos a otro servicio
 * 
 * Es de tipado dinámico, puede cambiar el valor de las variables a distintos
 *    tipos de datos.
 */
$tituloPagina = "Práctica 04: Introducción a la Programación de Lado del servidor <br>";

//Pueden ser comillas dobles o sencillas
$persona1 = [
    'nombre' => 'Persona 1',
    'apellidos' => 'Apellido 1',
    'edad' => 32,
    'deportesPracticados' => ['Futbol', 'Tenis', 'Basquet']
];

//Esta es una manera más vieja de hacerlo
$persona2 = array(
    'nombre' => 'Persona 2',
    'apellidos' => 'Apellido 2',
    'edad' => 30,
    'deportesPracticados' => array('Futbol Americano', 'Baseball')
);

//Array que contiene 2 arrays asociativos
$personas = [$persona1, $persona2];

//Acceder a los elementos de un array asociativo
$deportesPersona1 = $persona1['deportesPracticados'];

$persona3 = [
    'nombre' => 'Persona 3',
    'apellidos' => 'Apellido 3',
    'edad' => 32,
    'deportesPracticados' => ['Futbol Soccer', 'Tenis', 'Basquet']
];

//Al final de array (en el sig índice) se agregará
$personas[] = $persona3;
/**
 * El código php se tiene que ejecutar, en caso de mostrar el código plano
 *    significa que algo va mal. Debe de mostrar su ejecución en html.
 *    Es decir que al inspeccionar la página deberá de mostrar html. 
 * 
 * Una estructura mutable es que puede cambiar, es decir que le podemos asignar
 *    otros elementos. Una estructura inmutable quiere decir que tal cual como
 *    se creó, se puede cambiar.
 * 
 * require_once nos ayuda a que un archivo de código solamente se haya incluido
 *    1 sola vez.
 * Contamos también con un include y un include_once
 *
 * Entre sus deferencias solo está el manejo de errores include marca warning
 *    en el require marca error y para la ejecución.
 */
require 'index.view.php';
//include 'indexz.view.php';

//Si el archivo solo contiene php no es necesario el cierre