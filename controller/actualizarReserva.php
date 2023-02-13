<?php

use \model\Reserva;
use \model\Utils;
//Creamos un array para guardar los datos del reserva
$reserva = array();

//Borramos el reserva
if (isset($_POST["id_reserva"]) && isset($_POST["imagen"]) && isset($_POST["fecha_entrada"]) && isset($_POST["fecha_salida"]) && isset($_POST["id_empleado"]) && isset($_POST["id_cliente"])) {
    //rellenamos los datos del reserva que le pasaremos a la vista

    $reserva["id_reserva"] = $_POST["id_reserva"];
    $reserva["imagen"] = $_POST["imagen"];
    $reserva["fecha_entrada"] = $_POST["fecha_entrada"];
    $reserva["fecha_salida"] = $_POST["fecha_salida"];
    $reserva["id_empleado"] = $_POST["id_empleado"];
    $reserva["id_cliente"] = $_POST["id_cliente"];

    //Con los datos del reserva cargados cargamos la vista
    if (isset($_POST["modificar"]) && $_POST["modificar"] == "false") {
        //Declaramos la accion para que el formulario 
        //Sepa a que controlador llamar con los datos
        $accion = "modificar";
        //Con los datos del cliente cargados cargamos la vista
        $mensaje = "correct";

        include("../views/modificarReservas.php");
    } else {

        //Añadimos el código del modelo
        require_once("../model/Reserva.php");
        require_once("../model/Utils.php");

        $gestorCli = new Reserva();

        //Nos conectamos a la Bd
        $conexPDO = Utils::conectar();

        //Modificamos el registro
        $resultado = $gestorCli->updateReserva($reserva, $conexPDO);

        //Si ha ido bien el mensaje sera distint
        if ($resultado != null) {
            $mensaje = "correct";
            $mensajeAMostrar = "La Reserva se Actualizo Correctamente";
        } else {
            $mensaje = "error";
        }

        //Recolectamos los datos de los reservas
        $numPag = $gestorCli->getNumPag($conexPDO, 5);
        $datosReservas = $gestorCli->getReservasPag($conexPDO, 5);

        //var_dump($datosReservas);
        include("../views/mostrarReservas.php");
    }
} else {

    //Añadimos el código del modelo
    require_once("../model/Reserva.php");
    require_once("../model/Utils.php");

    $gestorCli = new Reserva();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Recolectamos los datos de los clientes
    $numPag = $gestorCli->getNumPag($conexPDO, 5);
    $datosReservas = $gestorCli->getReservasPag($conexPDO, 5);

    //var_dump($datosClientes);
    include("../views/mostrarReservas.php");
}
