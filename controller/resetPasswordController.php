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
 * en javascript, forma email
 */

//Si nos llegan datos de un empleado, implica que es el formulario el que llama al controlador
if (isset($_POST["email"])) {

    $empleado = array();

    //Limpiamos los datos de posibles caracteres o codigo malicioso
    //Segun los asignamos al array de datos del empleado a registrar
    $empleado["email"] = Utils::limpiar_datos($_POST["email"]);
    $gestorUsu = new Empleado();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Añadimos el registro
    $resultado = $gestorUsu->getEmpleadoConEmail($empleado["email"], $conexPDO);

    //Si ha ido bien el mensaje sera distint
    if ($resultado == null) {
        $mensaje = "error";
        $mensajeAMostrar = "No existe el correo introducido";
        include("../views/resetPassword.php");
    } else {
        if ($resultado != null) {
            //Enviamos el codigo de activación al correo proporcionado
            $resultado_correo = Utils::correo_pass_reset($resultado["email"],  $resultado["cod_activation"]);

            if ($resultado_correo == CORREO_ENVIADO) {
                echo '<script>alert("El correo ha sido enviado correctamente");</script>';
            } else {
                echo '<script>alert("Ha habido un error al enviar el correo");</script>';
            }

            $mensaje = "correct";
            $mensajeAMostrar = "Introduzca tu nuevo contraseña y el codigo de verificación. Condigo de verificación: " . $resultado["cod_activation"];
            include("../views/newPasswordSet.php");
        }
    }
} else {
    include("../views/resetPassword.php");
}
