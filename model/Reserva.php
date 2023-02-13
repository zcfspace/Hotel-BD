<?php

namespace model;

require_once("Utils.php");

use \PDO;
use \PDOException;

class Reserva
{
    /**Funcion que nos devuelve todos los reservas */
    public function getReservas($conexPDO)
    {
        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM hotel.reservas");
                //Ejecutamos la sentencia
                $sentencia->execute();
                //Devolvemos los datos del reserva
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
                $sentencia = $conexPDO->query("SELECT count(*) AS conteo FROM hotel.reservas");

                $conteo = $sentencia->fetchObject()->conteo;

                $devolver[0] = ceil($conteo / $numPag);
                $devolver[1] = $pagina;
                //Ejecutamos la sentencia
                $sentencia->execute();

                return $devolver;
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }


    /**
     * Funcion que nos devuelve todos los reservas con paginacion
     * */
    public function getReservasPag($conexPDO, $numPag)
    {
        if ($conexPDO != null) {
            try {

                $pagina = 1;
                if (isset($_GET["pagina"])) {
                    $pagina = $_GET["pagina"];
                }
                $limit = $numPag;

                $offset = ($pagina - 1) * $numPag;

                $sentencia = $conexPDO->prepare("SELECT * FROM hotel.reservas LIMIT ? OFFSET ?");
                $sentencia->bindValue(1, $limit, PDO::PARAM_INT);
                $sentencia->bindValue(2, $offset, PDO::PARAM_INT);

                $sentencia->execute();

                return $sentencia->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }

    /**
     * Devuelve el reserva asociado a la clave primaria introducida
     */
    public function getReserva($idReserva, $conexPDO)
    {
        if (isset($idReserva) && is_numeric($idReserva)) {
            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM hotel.reservas where id_reserva=? ORDER BY");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idReserva);
                    //Ejecutamos la sentencia
                    $sentencia->execute();
                    //Devolvemos los datos del reserva
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }


    /**
     * Devuelve el detalle de la reserva 
     */
    public function getReservaDetalle($idReserva, $conexPDO)
    {
        if (isset($idReserva) && is_numeric($idReserva)) {
            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT reservas.id_reserva, reservas.imagen, clientes.id_cliente, clientes.nombre as nombre_cliente, 
                                                    empleados.id_empleado, empleados.nombre as nombre_empleado, 
                                                    reservas.fecha_entrada, reservas.fecha_salida,
                                                        GROUP_CONCAT(DISTINCT servicios.id_servicio) as id_servicios, 
                                                        GROUP_CONCAT(DISTINCT servicios.nombre_servicio) as nombre_servicios,
                                                        GROUP_CONCAT(DISTINCT servicios.precio) as precios_servicios, 
                                                        GROUP_CONCAT(DISTINCT habitaciones.id_habitacion) as id_habitaciones, 
                                                        GROUP_CONCAT(DISTINCT habitaciones.numero) as numeros_habitaciones
                                                    FROM reservas
                                                    JOIN clientes ON reservas.id_cliente = clientes.id_cliente
                                                    JOIN empleados ON reservas.id_empleado = empleados.id_empleado
                                                    LEFT JOIN servicios_has_reservas ON reservas.id_reserva = servicios_has_reservas.Reservas_id_reserva
                                                    LEFT JOIN servicios ON servicios_has_reservas.Servicios_id_servicio = servicios.id_servicio
                                                    LEFT JOIN reservas_has_habitaciones ON reservas.id_reserva = reservas_has_habitaciones.Reservas_id_reserva
                                                    LEFT JOIN habitaciones ON reservas_has_habitaciones.Habitaciones_id_habitacion = habitaciones.id_habitacion
                                                    WHERE id_reserva=?
                                                    GROUP BY reservas.id_reserva;");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idReserva);
                    //Ejecutamos la sentencia
                    $sentencia->execute();
                    //Devolvemos los datos del reserva
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }

    /**
     * Devuelve las habitaciones de la reserva 
     */
    public function getReservaHabitaciones($idReserva, $conexPDO)
    {
        if (isset($idReserva) && is_numeric($idReserva)) {
            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT habitaciones.id_habitacion, habitaciones.numero
                                                    FROM reservas
                                                    JOIN reservas_has_habitaciones ON reservas.id_reserva = reservas_has_habitaciones.Reservas_id_reserva
                                                    JOIN habitaciones ON reservas_has_habitaciones.Habitaciones_id_habitacion = habitaciones.id_habitacion
                                                    WHERE id_reserva=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idReserva);
                    var_dump($sentencia);
                    //Ejecutamos la sentencia
                    $sentencia->execute();
                    //Devolvemos los datos del reserva
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }

    /**
     * Devuelve el servicios de la reserva 
     */
    public function getReservaServicios($idReserva, $conexPDO)
    {
        if (isset($idReserva) && is_numeric($idReserva)) {
            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT servicios.id_servicio, servicios.nombre_servicio, servicios.precio
                                                    FROM reservas
                                                    JOIN servicios_has_reservas ON reservas.id_reserva = servicios_has_reservas.Reservas_id_reserva
                                                    JOIN servicios ON servicios_has_reservas.Servicios_id_servicio = servicios.id_servicio
                                                    WHERE id_reserva=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idReserva);
                    var_dump($sentencia);
                    //Ejecutamos la sentencia
                    $sentencia->execute();
                    //Devolvemos los datos del reserva
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }
    function addReserva($reserva, $conexPDO)
    {
        $result = null;
        if (isset($reserva) && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO hotel.reservas (id_reserva, imagen, fecha_entrada, fecha_salida, id_empleado, id_cliente ) VALUES ( :id_reserva, :imagen, :fecha_entrada, :fecha_salida, :id_empleado, :id_cliente)");
                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":id_reserva", $reserva["id_reserva"]);
                $sentencia->bindParam(":imagen", $reserva["imagen"]);
                $sentencia->bindParam(":fecha_entrada", $reserva["fecha_entrada"]);
                $sentencia->bindParam(":fecha_salida", $reserva["fecha_salida"]);
                $sentencia->bindParam(":id_empleado", $reserva["id_empleado"]);
                $sentencia->bindParam(":id_cliente", $reserva["id_cliente"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    function delReserva($idReserva, $conexPDO)
    {
        $result = null;
        if (isset($idReserva) && is_numeric($idReserva)) {
            if ($conexPDO != null) {
                try {
                    //Borramos el reserva asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM hotel.reservas where id_reserva=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idReserva);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }
        return $result;
    }

    function updateReserva($reserva, $conexPDO)
    {
        $result = null;
        if (isset($reserva) && isset($reserva["id_reserva"]) && is_numeric($reserva["id_reserva"])  && $conexPDO != null) {
            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE hotel.reservas set id_reserva=:id_reserva, imagen=:imagen, fecha_entrada=:fecha_entrada, fecha_salida=:fecha_salida, id_empleado=:id_empleado, id_cliente=:id_cliente where id_reserva=:id_reserva");
                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":id_reserva", $reserva["id_reserva"]);
                $sentencia->bindParam(":imagen", $reserva["imagen"]);
                $sentencia->bindParam(":fecha_entrada", $reserva["fecha_entrada"]);
                $sentencia->bindParam(":fecha_salida", $reserva["fecha_salida"]);
                $sentencia->bindParam(":id_empleado", $reserva["id_empleado"]);
                $sentencia->bindParam(":id_cliente", $reserva["id_cliente"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
        return $result;
    }
}
