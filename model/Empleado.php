<?php

namespace model;

require_once("Utils.php");

use \PDO;
use \PDOException;

class Empleado
{

    /**Funcion que nos devuelve todos los empleados */
    public function getEmpleados($conexPDO)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM hotel.empleados");
                //Ejecutamos la sentencia
                $sentencia->execute();

                //Devolvemos los datos del empleado
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
                $sentencia = $conexPDO->query("SELECT count(*) AS conteo FROM hotel.empleados");

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
     * Funcion que nos devuelve todos los empleados con paginacion
     * */
    public function getEmpleadosPag($conexPDO, $numPag)
    {
        if ($conexPDO != null) {
            try {

                $pagina = 1;
                if (isset($_GET["pagina"])) {
                    $pagina = $_GET["pagina"];
                }
                $limit = $numPag;

                $offset = ($pagina - 1) * $numPag;

                $sentencia = $conexPDO->prepare("SELECT * FROM hotel.empleados LIMIT ? OFFSET ?");
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
     * Devuelve el empleado asociado a la clave primaria introducida
     */
    public function getEmpleado($idEmpleado, $conexPDO)
    {
        if (isset($idEmpleado) && is_numeric($idEmpleado)) {


            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM hotel.empleados where id_empleado=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idEmpleado);
                    //Ejecutamos la sentencia
                    $sentencia->execute();

                    //Devolvemos los datos del empleado
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }

    function addEmpleado($empleado, $conexPDO)
    {

        $result = null;
        if (isset($empleado) && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO hotel.empleados (nombre, email, password, salt, activo, cod_activation) VALUES ( :nombre, :email, :password, :salt, :activo, :cod_activation)");

                //Asociamos los valores a los parametros de la sentencia sql

                $sentencia->bindParam(":nombre", $empleado["nombre"]);
                $sentencia->bindParam(":email", $empleado["email"]);
                $sentencia->bindParam(":password", $empleado["password"]);
                $sentencia->bindParam(":salt", $empleado["salt"]);
                $sentencia->bindParam(":activo", $empleado["activo"]);
                $sentencia->bindParam(":cod_activation", $empleado["cod_activation"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    function delEmpleado($idEmpleado, $conexPDO)
    {
        $result = null;

        if (isset($idEmpleado) && is_numeric($idEmpleado)) {


            if ($conexPDO != null) {
                try {
                    //Borramos el empleado asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM hotel.empleados where id_empleado=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idEmpleado);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }

        return $result;
    }

    function updateEmpleado($empleado, $conexPDO)
    {

        $result = null;
        if (isset($empleado) && isset($empleado["id_empleado"]) && is_numeric($empleado["id_empleado"])  && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE hotel.empleados set id_empleado=:id_empleado, nombre=:nombre, apellido=:apellido, puesto=:puesto, login=:login, pass=:pass , sueldo=sueldo where id_empleado=:id_empleado");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":id_empleado", $empleado["id_empleado"]);
                $sentencia->bindParam(":nombre", $empleado["nombre"]);
                $sentencia->bindParam(":apellido", $empleado["apellido"]);
                $sentencia->bindParam(":puesto", $empleado["puesto"]);
                $sentencia->bindParam(":login", $empleado["login"]);
                $sentencia->bindParam(":pass", $empleado["pass"]);
                $sentencia->bindParam(":sueldo", $empleado["sueldo"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }
}
