<?php

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

//var_dump($datosReservas);
include("../views/mostrarReservas.php");
