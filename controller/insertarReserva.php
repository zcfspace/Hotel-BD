<?php

use \model\Reserva;
use \model\Utils;
//Creamos un array para guardar los datos del reserva


//Borramos el reserva
if (isset($_POST["id_reserva"]) && isset($_POST["imagen"]) && isset($_POST["fecha_entrada"]) && isset($_POST["fecha_salida"]) && isset($_POST["id_empleado"]) && isset($_POST["id_cliente"])) {
    //rellenamos los datos del reserva que le pasaremos a la vista

    $reserva["id_reserva"] = $_POST["id_reserva"];
    $reserva["imagen"] = $_POST["imagen"];
    $reserva["fecha_entrada"] = $_POST["fecha_entrada"];
    $reserva["fecha_salida"] = $_POST["fecha_salida"];
    $reserva["id_empleado"] = $_POST["id_empleado"];
    $reserva["id_cliente"] = $_POST["id_cliente"];

    //Añadimos el código del modelo
    require_once("../model/Reserva.php");
    require_once("../model/Utils.php");

    $gestorCli = new Reserva();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Añadimos el registro
    $resultado = $gestorCli->addReserva($reserva, $conexPDO);

    //Si ha ido bien el mensaje sera distint
    if ($resultado != null) {
        $mensaje = "correct";
        $mensajeAMostrar = "La Reserva se Inserto Correctamente";
    } else {
        $mensaje = "error";
    }

    //Recolectamos los datos de los reservas
    $numPag = $gestorCli->getNumPag($conexPDO, 5);
    $datosReservas = $gestorCli->getReservasPag($conexPDO, 5);

    //var_dump($datosReservas);
    include("../views/mostrarReservas.php");
} else {
    //Declaramos la accion para que el formulario 
    //Sepa a que controlador llamar con los datos
    $accion = "insertar";
    //Sin datos del  reserva cargados cargamos la vista
    include("../views/modificarReservas.php");
}
