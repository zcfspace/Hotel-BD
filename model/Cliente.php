<?php

namespace model;

require_once("Utils.php");

use \PDO;
use \PDOException;

class Cliente
{


    /**Funcion que nos devuelve todos los clientes */
    public function getClientes($conexPDO)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM hotel.clientes");
                //Ejecutamos la sentencia
                $sentencia->execute();

                //Devolvemos los datos del cliente
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
                $sentencia = $conexPDO->query("SELECT count(*) AS conteo FROM hotel.clientes");

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
     * Funcion que nos devuelve todos los clientes con paginacion
     * */
    public function getClientesPag($conexPDO, $numPag)
    {
        if ($conexPDO != null) {
            try {

                $pagina = 1;
                if (isset($_GET["pagina"])) {
                    $pagina = $_GET["pagina"];
                }
                $limit = $numPag;

                $offset = ($pagina - 1) * $numPag;

                $sentencia = $conexPDO->prepare("SELECT * FROM hotel.clientes LIMIT ? OFFSET ?");
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
     * Devuelve el cliente asociado a la clave primaria introducida
     */
    public function getCliente($idCliente, $conexPDO)
    {
        if (isset($idCliente) && is_numeric($idCliente)) {


            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM hotel.clientes where id_cliente=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idCliente);
                    //Ejecutamos la sentencia
                    $sentencia->execute();

                    //Devolvemos los datos del cliente
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }

    function addCliente($cliente, $conexPDO)
    {

        $result = null;
        if (isset($cliente) && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO hotel.clientes (id_cliente, nombre, apellido, correo, telefono, direccion ) VALUES ( :id_cliente, :nombre, :apellido, :correo, :telefono, :direccion)");

                //Asociamos los valores a los parametros de la sentencia sql

                $sentencia->bindParam(":id_cliente", $cliente["id_cliente"]);
                $sentencia->bindParam(":nombre", $cliente["nombre"]);
                $sentencia->bindParam(":apellido", $cliente["apellido"]);
                $sentencia->bindParam(":correo", $cliente["correo"]);
                $sentencia->bindParam(":telefono", $cliente["telefono"]);
                $sentencia->bindParam(":direccion", $cliente["direccion"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    function delCliente($idCliente, $conexPDO)
    {
        $result = null;

        if (isset($idCliente) && is_numeric($idCliente)) {


            if ($conexPDO != null) {
                try {
                    //Borramos el cliente asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM hotel.clientes where id_cliente=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idCliente);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }

        return $result;
    }

    function updateCliente($cliente, $conexPDO)
    {

        $result = null;
        if (isset($cliente) && isset($cliente["id_cliente"]) && is_numeric($cliente["id_cliente"])  && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE hotel.clientes set id_cliente=:id_cliente, nombre=:nombre, apellido=:apellido, correo=:correo, telefono=:telefono, direccion=:direccion where id_cliente=:id_cliente");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":id_cliente", $cliente["id_cliente"]);
                $sentencia->bindParam(":nombre", $cliente["nombre"]);
                $sentencia->bindParam(":apellido", $cliente["apellido"]);
                $sentencia->bindParam(":correo", $cliente["correo"]);
                $sentencia->bindParam(":telefono", $cliente["telefono"]);
                $sentencia->bindParam(":direccion", $cliente["direccion"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }
}
