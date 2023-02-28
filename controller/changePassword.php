<?php

namespace controller;

use \model\Empleado;
use \model\Utils;

//Añadimos el código del modelo
require_once("../model/Empleado.php");
require_once("../model/Utils.php");

/*
 * Los datos que llegan de la vista registro por POST ya deberían de estar validados
 * en javascript, forma email, contraseña correcta, contraseñas iguales, telefono etc
 */

//Si nos llegan datos de un empleado, implica que es el formulario el que llama al controlador
if (isset($_POST["id_empleado"]) && isset($_POST["passwordCurrent"]) && isset($_POST["passwordNew2"])) {

    $empleado = array();
    //Limpiamos los datos de posibles caracteres o codigo malicioso
    //Segun los asignamos al array de datos del empleado a registrar
    $empleado["id_empleado"] = Utils::limpiar_datos($_POST["id_empleado"]);
    $empleado["passwordActual"] = Utils::limpiar_datos($_POST["passwordCurrent"]);
    $empleado["passwordNuevo"] = Utils::limpiar_datos($_POST["passwordNew2"]);

    $gestorUsu = new Empleado();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Añadimos el registro
    $resultado = $gestorUsu->changePassword($empleado, $conexPDO);
    
    //Enviamos la respuesta al cliente en formato JSON
    echo json_encode($resultado);
}
