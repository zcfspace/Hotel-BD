<?php

namespace model;

require_once("Utils.php");

use \PDO;
use \PDOException;

class Factura
{

    /**Funcion que nos devuelve todos los facturas */
    public function getFacturas($conexPDO)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM hotel.facturas");
                //Ejecutamos la sentencia
                $sentencia->execute();

                //Devolvemos los datos del factura
                return $sentencia->fetchAll();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }
    /**
     * Funcion para calcular las paginas necesaria para la paginacion
     */
    public function getNumPag($conexPDO, $numPag)
    {
        if ($conexPDO != null) {
            try {
                $pagina = 1;
                if (isset($_GET["pagina"])) {
                    $pagina = $_GET["pagina"];
                }
                $sentencia = $conexPDO->query("SELECT count(*) AS conteo FROM hotel.facturas");

                $conteo = $sentencia->fetchObject()->conteo;

                $devolver[0] = ceil($conteo / $numPag);
                $devolver[1] = $pagina;
                //Ejecutamos la sentencia
                $sentencia->execute();

                return $devolver;
            } catch (PDOException $e) {
                error_log("Error al acceder a BD" . $e->getMessage());
            }
        }
    }

    /**
     * Funcion que nos devuelve todos los facturas con paginacion
     * */
    public function getFacturasPag($conexPDO, $numPag)
    {
        if ($conexPDO != null) {
            try {

                $pagina = 1;
                if (isset($_GET["pagina"])) {
                    $pagina = $_GET["pagina"];
                }
                $limit = $numPag;

                $offset = ($pagina - 1) * $numPag;

                $sentencia = $conexPDO->prepare("SELECT * FROM hotel.facturas LIMIT ? OFFSET ?");
                $sentencia->bindValue(1, $limit, PDO::PARAM_INT);
                $sentencia->bindValue(2, $offset, PDO::PARAM_INT);

                $sentencia->execute();

                return $sentencia->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                error_log("Error al acceder a BD" . $e->getMessage());
            }
        }
    }


    /**
     * Devuelve el factura asociado a la clave primaria introducida
     */
    public function getFactura($idFactura, $conexPDO)
    {
        if (isset($idFactura) && is_numeric($idFactura)) {


            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM hotel.facturas where id_factura=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idFactura);
                    //Ejecutamos la sentencia
                    $sentencia->execute();

                    //Devolvemos los datos del factura
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }

    function addFactura($factura, $conexPDO)
    {

        $result = null;
        if (isset($factura) && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO hotel.facturas (id_factura, fecha, id_reserva ) VALUES ( :id_factura, :fecha, :id_reserva)");

                //Asociamos los valores a los parametros de la sentencia sql

                $sentencia->bindParam(":id_factura", $factura["id_factura"]);
                $sentencia->bindParam(":fecha", $factura["fecha"]);
                $sentencia->bindParam(":id_reserva", $factura["id_reserva"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    function delFactura($idFactura, $conexPDO)
    {
        $result = null;

        if (isset($idFactura) && is_numeric($idFactura)) {


            if ($conexPDO != null) {
                try {
                    //Borramos el factura asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM hotel.facturas where id_factura=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idFactura);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }

        return $result;
    }

    function updateFactura($factura, $conexPDO)
    {

        $result = null;
        if (isset($factura) && isset($factura["id_factura"]) && is_numeric($factura["id_factura"])  && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE hotel.facturas set id_factura=:id_factura, fecha=:fecha, id_reserva=:id_reserva where id_factura=:id_factura");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":id_factura", $factura["id_factura"]);
                $sentencia->bindParam(":fecha", $factura["fecha"]);
                $sentencia->bindParam(":id_reserva", $factura["id_reserva"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }
}
