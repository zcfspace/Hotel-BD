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
if (isset($_POST["email"]) && isset($_POST["password"])) {

    $empleado = array();

    //Limpiamos los datos de posibles caracteres o codigo malicioso
    //Segun los asignamos al array de datos del empleado a registrar
    $empleado["password"] = Utils::limpiar_datos($_POST["password"]);
    $empleado["email"] = Utils::limpiar_datos($_POST["email"]);

    $gestorUsu = new Empleado();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    // Comprobar las credenciales
    $resultado = $gestorUsu->comprobarCredenciales($empleado["email"], $empleado["password"], $conexPDO);

    if (is_array($resultado)) {
        // Las credenciales son correctas
        // Guardar la información del empleado en la sesión
        session_start();
        $_SESSION["idEmpleado"] = $resultado["id_empleado"];
        $_SESSION["nombre"] = $resultado["nombre"];
        $_SESSION["email"] = $resultado["email"];
        // Mostrar el maincontroller
        header("Location: mainController.php");
        exit();
    } else {
        switch ($resultado) {
            case "noActiva":
                $mensaje = "error";
                $mensajeAMostrar = "La cuenta no está activa, proceda a la activacion";
                include("activation.php");
                break;
            case "noPass":
                $mensaje = "error";
                $mensajeAMostrar = "La contraseña es incorrecta";
                include("../views/login.php");
                break;
            case "noEmail":
                $mensaje = "error";
                $mensajeAMostrar = "El email no está registrado";
                include("../views/login.php");
                break;
            case "noEmailnoPass":
                $mensaje = "error";
                $mensajeAMostrar = "Debe introducir email y contraseña";
                include("../views/login.php");
                break;
        };
    };
} else {
    include("../views/login.php");
}
