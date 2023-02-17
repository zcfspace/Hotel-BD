<?php

namespace model;

require_once("Utils.php");

use \PDO;
use \PDOException;

class Habitacion
{
    /**
     * Devuelve el habitaciones asociado a la clave primaria introducida
     */
    public function getHabitacion($idHabitacion, $conexPDO)
    {
        if (isset($idHabitacion) && is_numeric($idHabitacion)) {


            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM hotel.habitaciones where id_habitaciones=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idHabitacion);
                    //Ejecutamos la sentencia
                    $sentencia->execute();

                    //Devolvemos los datos del habitaciones
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
                $sentencia = $conexPDO->query("SELECT count(*) AS conteo FROM hotel.habitaciones");

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
     * Funcion que nos devuelve todos los habitaciones con paginacion
     * */
    public function getHabitacionesPag($conexPDO, $numPag)
    {
        if ($conexPDO != null) {
            try {

                $pagina = 1;
                if (isset($_GET["pagina"])) {
                    $pagina = $_GET["pagina"];
                }
                $limit = $numPag;

                $offset = ($pagina - 1) * $numPag;

                $sentencia = $conexPDO->prepare("SELECT * FROM hotel.habitaciones LIMIT ? OFFSET ?");
                $sentencia->bindValue(1, $limit, PDO::PARAM_INT);
                $sentencia->bindValue(2, $offset, PDO::PARAM_INT);

                $sentencia->execute();

                return $sentencia->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                error_log("Error al acceder a BD" . $e->getMessage());
            }
        }
    }

    function addHabitacion($habitacion, $conexPDO)
    {

        $result = null;
        if (isset($habitacion) && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO hotel.habitacions (id_habitacion, numero, tipo, precio) VALUES ( :id_habitacion, :numero, :tipo, :precio)");

                //Asociamos los valores a los parametros de la sentencia sql

                $sentencia->bindParam(":id_habitacion", $habitacion["id_habitacion"]);
                $sentencia->bindParam(":numero", $habitacion["numero"]);
                $sentencia->bindParam(":tipo", $habitacion["tipo"]);
                $sentencia->bindParam(":precio", $habitacion["precio"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    function delHabitacion($idHabitacion, $conexPDO)
    {
        $result = null;

        if (isset($idHabitacion) && is_numeric($idHabitacion)) {


            if ($conexPDO != null) {
                try {
                    //Borramos el habitacion asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM hotel.habitacions where id_habitacion=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idHabitacion);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }

        return $result;
    }

    function updateHabitacion($habitacion, $conexPDO)
    {

        $result = null;
        if (isset($habitacion) && isset($habitacion["id_habitacion"]) && is_numeric($habitacion["id_habitacion"])  && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE hotel.habitacions set id_habitacion=:id_habitacion, numero=:numero, tipo=:tipo, precio=:precio where id_habitacion=:id_habitacion");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":id_habitacion", $habitacion["id_habitacion"]);
                $sentencia->bindParam(":numero", $habitacion["numero"]);
                $sentencia->bindParam(":tipo", $habitacion["tipo"]);
                $sentencia->bindParam(":precio", $habitacion["precio"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }
}
