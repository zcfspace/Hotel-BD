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
   
    //Obtener los datas relacionada con la reserva
    echo json_encode($datosReservaDetalle);
}
