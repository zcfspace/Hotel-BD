<?php

namespace controller;

use \model\Empleado;
use \model\Utils;
//Creamos un array para guardar los datos del cliente

//Añadimos el código del modelo
require_once("../model/Empleado.php");
require_once("../model/Utils.php");

/*
 * Los datos que llegan de la vista registro por POST ya deberían de estar validados
 * en javascript, forma email, contraseña correcta, contraseñas iguales, telefono etc
 */

//Si nos llegan datos de un cliente, implica que es el formulario el que llama al controlador
if (isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $empleado = array();

    //Limpiamos los datos de posibles caracteres o codigo malicioso
    //Segun los asignamos al array de datos del empleado a registrar
    $empleado["nombre"] = Utils::limpiar_datos($_POST["nombre"]);
    $empleado["email"] = Utils::limpiar_datos($_POST["email"]);

    //Generamos una salt de 16 posiciones
    $salt = Utils::generar_salt(16);
    $empleado["salt"] = $salt;

    //Encriptamos el password del formulario
    //Usamos función hash() con el algoritmo sha256, que produce una salida de 256 bits (32 bytes)
    $empleado["password"] = hash('sha256', $salt . $empleado["password"]);

    //Por defecto el empleado esta deshabilitado
    $empleado["activo"] = 0;

    //Generamos el codigo de activacion
    $empleado["codActivacion"] = Utils::generar_codigo_activacion();

    $gestorUsu = new Empleado();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Añadimos el registro
    $resultado = $gestorUsu->addEmpleado($empleado, $conexPDO);

    //Si ha ido bien el mensaje sera distint
    if ($resultado != null) {
        $mensaje = "correct";
        $mensajeAMostrar = "El Empleado se Registro Correctamente";
    } else {
        $mensaje = "error";
        $mensajeAMostrar = "Ha habido un fallo al acceder a la Base de Datos\n salte por la ventana ya!";
    }

    //var_dump($datosClientes);
    include("../views/login.php");
}
