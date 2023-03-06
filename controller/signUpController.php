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
if (isset($_POST["email"]) && isset($_POST["nombre"]) && isset($_POST["password"])) {

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
    $empleado["password"] = hash("sha256", $salt . $_POST["password"]);

    //Por defecto el empleado esta deshabilitado
    $empleado["activo"] = 1;

    //Generamos el codigo de activacion
    $empleado["cod_activation"] = Utils::generar_codigo_activacion();

    $gestorUsu = new Empleado();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Añadimos el registro
    $resultado = $gestorUsu->addEmpleado($empleado, $conexPDO);

    //Si ha ido bien el mensaje sera distint
    if ($resultado === "emailExiste") {
        $mensaje = "error";
        $mensajeAMostrar = "Ya existe un empleado con ese correo electrónico";
        include("../views/signUp.php");
    } else {
        if ($resultado != null) {
            //Enviamos el codigo de activación al correo proporcionado
            $resultado_correo = Utils::correo_registro($empleado["email"],  $empleado["cod_activation"]);

            if ($resultado_correo == CORREO_ENVIADO) {
                echo '<script>alert("El correo ha sido enviado correctamente");</script>';
            } else {
                echo '<script>alert("Ha habido un error al enviar el correo");</script>';
            }

            $mensaje = "correct";
            $mensajeAMostrar = "El Empleado se Registro Correctamente, proceda a la Activación de su cuenta. Condigo de activacion: " . $empleado["cod_activation"];
            include("../views/activate.php");
        } else {
            $mensaje = "error";
            $mensajeAMostrar = "Ha habido un fallo al acceder a la Base de Datos\n salte por la ventana ya!";
            include("../views/signUp.php");
        }
    }
} else {
    include("../views/signUp.php");
}
