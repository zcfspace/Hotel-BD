<?php

namespace model;

require_once("Utils.php");

use \PDO;
use \PDOException;

class Servicio
{
    /**
     * Devuelve el servicios asociado a la clave primaria introducida
     */
    public function getServicio($idServicio, $conexPDO)
    {
        if (isset($idServicio) && is_numeric($idServicio)) {


            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM hotel.servicios where id_servicios=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idServicio);
                    //Ejecutamos la sentencia
                    $sentencia->execute();

                    //Devolvemos los datos del servicios
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
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
                $sentencia = $conexPDO->query("SELECT count(*) AS conteo FROM hotel.servicios");

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
     * Funcion que nos devuelve todos los servicios con paginacion
     * */
    public function getServiciosPag($conexPDO, $numPag)
    {
        if ($conexPDO != null) {
            try {

                $pagina = 1;
                if (isset($_GET["pagina"])) {
                    $pagina = $_GET["pagina"];
                }
                $limit = $numPag;

                $offset = ($pagina - 1) * $numPag;

                $sentencia = $conexPDO->prepare("SELECT * FROM hotel.servicios LIMIT ? OFFSET ?");
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
     * Funcion para añadir reserva
     */
    function addServicio($servicios, $conexPDO)
    {
        $result = null;
        if (isset($servicios) && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO hotel.servicios (id_servicios, nombre_servicio, precio) VALUES ( :id_servicios, :nombre_servicio, :precio)");

                //Asociamos los valores a los parametros de la sentencia sql

                $sentencia->bindParam(":id_servicios", $servicios["id_servicios"]);
                $sentencia->bindParam(":nombre_servicio", $servicios["nombre_servicio"]);
                $sentencia->bindParam(":precio", $servicios["precio"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }  

    /**
     * Funcion para borrar reserva
     */
    function delServicio($idServicio, $conexPDO)
    {
        $result = null;

        if (isset($idServicio) && is_numeric($idServicio)) {


            if ($conexPDO != null) {
                try {
                    //Borramos el servicios asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM hotel.servicios where id_servicios=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idServicio);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }

        return $result;
    }

    /**
     * Funcion para actualizar reservas
     */
    function updateServicio($servicios, $conexPDO)
    {

        $result = null;
        if (isset($servicios) && isset($servicios["id_servicios"]) && is_numeric($servicios["id_servicios"])  && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE hotel.servicios set id_servicios=:id_servicios, nombre_servicio=:nombre_servicio, precio=:precio where id_servicios=:id_servicios");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":id_servicios", $servicios["id_servicios"]);
                $sentencia->bindParam(":nombre_servicio", $servicios["nombre_servicio"]);
                $sentencia->bindParam(":precio", $servicios["precio"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }
}
