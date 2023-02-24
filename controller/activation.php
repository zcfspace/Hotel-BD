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
if (isset($_POST["cod_activation"])) {

    $empleado = array();
    //Limpiamos los datos de posibles caracteres o codigo malicioso
    //Segun los asignamos al array de datos del empleado a registrar
    $empleado["cod_activation"] = Utils::limpiar_datos($_POST["cod_activation"]);

    //Por defecto el empleado esta deshabilitado
    $empleado["activo"] = 0;

    $gestorUsu = new Empleado();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Añadimos el registro
    $resultado = $gestorUsu->addEmpleado($empleado, $conexPDO);

    //Si ha ido bien el mensaje sera distint
    if ($resultado != null) {
        $mensaje = "correct";
        $mensajeAMostrar = "El Empleado se Registro Correctamente, proceda a la Activación de su cuenta. Condigo de activacion: " . $empleado["cod_activation"];
        include("../views/activate.php");
    } else {
        $mensaje = "error";
        $mensajeAMostrar = "Ha habido un fallo al acceder a la Base de Datos\n salte por la ventana ya!";
        include("../signUp.php");
    }
}
