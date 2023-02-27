<?php

session_start();

var_dump($_SESSION);

if (isset($_SESSION["idEmpleado"])) {
    // La sesión existe, mostrar la información del empleado
    $mensaje = "correct";
    $mensajeAMostrar = "Bienvenido " . $_SESSION["nombre"] . "!";
} else {
    // La sesión no existe, redirigir a la página de login
    header("Location: ../views/login.php");
    exit();
}

use \model\Reserva;
use \model\Utils;

//Añadimos el código del modelo
require_once("../model/Reserva.php");
require_once("../model/Utils.php");
$mensaje = null;
$mensajeAMostrar = null;
$gestorCli = new Reserva();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();

$numPag = $gestorCli->getNumPag($conexPDO, 5);
$datosReservas = $gestorCli->getReservasPag($conexPDO, 5);

include("../views/mostrarReservas.php");
