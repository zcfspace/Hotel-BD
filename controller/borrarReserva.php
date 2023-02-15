<?php

use \model\Reserva;
use \model\Utils;

//Añadimos el código del modelo
require_once("../model/Reserva.php");
require_once("../model/Utils.php");

$gestorCli = new Reserva();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();

//Borramos el cliente
if (isset($_POST["id_reserva"])) {
    //Borramos y guardamos el resultado
    $resultado = $gestorCli->delReserva($_POST["id_reserva"], $conexPDO);

    //Si hubo un problema al borrarlo guardamos un mensaje de error
    if ($resultado == null || $resultado == 0) {
        $mensaje = "error";
    } else {
        $mensaje = "correct";
        $mensajeAMostrar = "Reserva eliminada correctamente";
    }

    //Borramos el archivo del servidor
    if (isset($_POST["imagen_borrar"])) {

        $archivo_a_eliminar = $_POST["imagen_borrar"];
        //Si exsite el archivo en la carpeta, lo borramos
        if (file_exists($archivo_a_eliminar)) {
            //borra archivo
            unlink($archivo_a_eliminar);
        } 
    }

}

//Recolectamos los datos de los clientes
$numPag = $gestorCli->getNumPag($conexPDO, 5);
$datosReservas = $gestorCli->getReservasPag($conexPDO, 5);

include("../views/mostrarReservas.php");
