<?php

namespace controller;

use \model\Empleado;
use \model\Utils;
//Creamos un array para guardar los datos del empleado

//Añadimos el código del modelo
require_once("../model/Empleado.php");
require_once("../model/Utils.php");

/*
 * Los datos que llegan de la vista registro por POST ya deberían de estar validados
 * en javascript, forma email, contraseña correcta, contraseñas iguales, telefono etc
 */

//Si nos llegan datos de un empleado, implica que es el formulario el que llama al controlador
if (isset($_POST["cod_activation"]) && isset($_POST["email"])) {

    $empleado = array();
    //Limpiamos los datos de posibles caracteres o codigo malicioso
    //Segun los asignamos al array de datos del empleado a registrar
    $empleado["cod_activation"] = Utils::limpiar_datos($_POST["cod_activation"]);
    $empleado["email"] = Utils::limpiar_datos($_POST["email"]);

    $gestorUsu = new Empleado();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Añadimos el registro
    $resultado = $gestorUsu->activateEmpleado($empleado["email"], $empleado["cod_activation"], $conexPDO);

    //Si ha ido bien el mensaje sera distinta
    if ($resultado != null) {
        $mensaje = "correct";
        $mensajeAMostrar = "Se activo correctamente, disfruta del trabajo";
        include("../views/login.php");
    } else {
        $mensaje = "error";
        $mensajeAMostrar = "El usuario introducido no esta registrado o el codigo proporcionado está mal";
        include("../views/activate.php");
    }
} else {
    include("../views/activate.php");
}
