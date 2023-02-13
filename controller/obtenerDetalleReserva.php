<?php

use \model\Reserva;
use \model\Utils;

//Añadimos el código del modelo
require_once("../model/Reserva.php");
require_once("../model/Utils.php");

$gestorCli = new Reserva();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();


if (isset($_POST["idReserva"])) {

    $idReserva = $_POST["idReserva"];

    $datosReservaDetalle = $gestorCli->getReservaDetalle($idReserva, $conexPDO);


    // if ($datosReservaDetalle == null || $datosReservaDetalle == 0) {
    //     $mensaje = "error";
    //     $mensajeAMostrar = "Error al obtener el detalle de la reserva";
    // } else {
    //     $mensaje = "correct";
    //     $mensajeAMostrar = "se ha obtenido los datos correctamente";
    // }
    
    echo json_encode($datosReservaDetalle);
}
