<?php

use \model\Reserva;
use \model\Utils;
//Creamos un array para guardar los datos del reserva
$reserva = array();

//Actualizamos reserva
if (isset($_POST["id_reserva"]) && isset($_POST["fecha_entrada"]) && isset($_POST["fecha_salida"]) && isset($_POST["id_empleado"]) && isset($_POST["id_cliente"])) {
    //rellenamos los datos del reserva que le pasaremos a la vista

    if (isset($_FILES["imagen"]) && !empty($_FILES["imagen"]["name"])) {

        // Verificar que el archivo cargado es una imagen
        $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
        $limite_kb = 5000; // Tamaño máximo permitido en KB

        if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024) {

            // Borrar la imagen antigua si existe
            if (isset($_POST["imagen_antiguo"])) {
                $archivo_a_eliminar = $_POST["imagen_antiguo"];
                if (file_exists($archivo_a_eliminar)) {
                    unlink($archivo_a_eliminar);
                }
            }

            // Renombrar la imagen subida
            $nombre_imagen = "reserva_" . date('Y-m-d_His') . "_" . uniqid() . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);

            // Definir la ruta de destino de la imagen
            $ruta_destino = "img/" . $nombre_imagen;

            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
                // Error al subir la imagen
                echo "Error al subir la imagen";
            } else {
                // Obtener la ruta completa de la imagen
                $ruta_completa = realpath($ruta_destino);

                // Renombrar la imagen con el mismo nombre que $nombre_imagen
                $nueva_ruta = dirname($ruta_completa) . "/" . $nombre_imagen;
                rename($ruta_completa, $nueva_ruta);
            }

            $reserva["imagen"] = $ruta_destino;
        } else {
            // El archivo no es una imagen o supera el tamaño máximo permitido
            echo "El archivo debe ser una imagen (JPG, JPEG, GIF o PNG) y no debe superar los " . $limite_kb . "KB.";

            $reserva["imagen"] = $_POST["imagen_antiguo"];
        }
    } else {
        //Si no ha subido ninguna niguna, se quedará con el antiguo
        if (isset($_POST["imagen"])) {
            $reserva["imagen"] = $_POST["imagen"];
        } else {
            $reserva["imagen"] = $_POST["imagen_antiguo"];
        }
    }

    $reserva["id_reserva"] = $_POST["id_reserva"];
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
