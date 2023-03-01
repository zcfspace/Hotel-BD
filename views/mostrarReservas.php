<?php

namespace views;

// session_start();

// if (!isset($_SESSION["accesoPermitido"]) || $_SESSION["accesoPermitido"] !== true) {
//     // redireccionar a otra página o mostrar un mensaje de error
//     header("Location: ../controller/mainController.php");
//     exit();
// }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Lista de Reservas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <div class="row pt-3">
            <div class="col-lg-11 col-sm-11 m-auto shadow-sm px-5 py-4 bg-body rounded">
                <!-- Alerta error/correct -->
                <div>
                    <svg class="visually-hidden">
                        <!-- Iconos correct-->
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </symbol>
                        <!-- Icono error -->
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </symbol>
                    </svg>

                    <!-- Mostramos los mensajes -->
                    <?php if (!empty($mensaje)) : ?>
                        <?php if ($mensaje === "correct") : ?>
                            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                                    <use xlink:href="#check-circle-fill" />
                                </svg>
                                <strong><?= $mensajeAMostrar ?? "Operación realizada correctamente" ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php elseif ($mensaje === "error") : ?>
                            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Error:">
                                    <use xlink:href="#exclamation-triangle-fill" />
                                </svg>
                                <strong><?= $mensajeAMostrar ?? "Se ha producido un error" ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- Bonton para añadir reserva -->
                <div class="text-end pb-4 pe-2">
                    <form method='post' action='../controller/insertarReserva.php'>
                        <button class='btn btn-success'>Añadir Reserva</button>
                    </form>
                </div>

                <!-- Tabla reserva -->
                <table class="table table-striped table-hover text-center shadow p-3 mb-5 bg-body rounded">
                    <thead>
                        <tr>
                            <!-- <th scope="col"></th> -->
                            <th scope="col">Id Reserva</th>
                            <th scope="col">Fecha Entrada</th>
                            <th scope="col">Fecha Salida</th>
                            <th scope="col">Id Empleado</th>
                            <th scope="col">Id Cliente</th>
                            <th scope="col"> </th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Mostramos los datos en las tablas -->
                        <?php foreach ($datosReservas as $reserva) { ?>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-detalle" data-bs-toggle="modal" data-bs-target="#modalReserva" data-id="<?= $reserva->id_reserva ?>">
                                        <?= $reserva->id_reserva ?>
                                    </button>
                                </td>
                                <td><?= $reserva->fecha_entrada ?></td>
                                <td><?= $reserva->fecha_salida ?></td>
                                <td><?= $reserva->id_empleado ?></td>
                                <td><?= $reserva->id_cliente ?></td>
                                <td>
                                    <form method="post" action="../controller/borrarReserva.php">
                                        <input type="hidden" name="imagen_borrar" value="<?= $reserva->imagen ?>">
                                        <input type="hidden" name="id_reserva" value="<?= $reserva->id_reserva ?>">
                                        <button class="button btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="../controller/actualizarReserva.php">
                                        <?php //Asignamos los valores de $reserva a los input
                                        foreach (get_object_vars($reserva) as $key => $value) { ?>
                                            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
                                        <?php } ?>
                                        <button name="modificar" value="false" class="btn btn-primary">Modificar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- Modal detalle -->
                <div class="modal fade" id="modalReserva" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalReserva" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detalle</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover">
                                    <tr>
                                        <th scope="row">Id Reserva</th>
                                        <td id="id_reserva"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Imagen</th>
                                        <td id="imagen" class="w-50"><img class="w-100" src="" alt="imagenReserva"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Id Cliente</th>
                                        <td id="id_cliente"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nombre Cliente</th>
                                        <td id="nombre_cliente"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Id Empleado</th>
                                        <td id="id_empleado"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nombre Empleado</th>
                                        <td id="nombre_empleado"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fecha de Entrada</th>
                                        <td id="fecha_entrada"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fecha de Salida</th>
                                        <td id="fecha_salida"></td>
                                    </tr>
                                </table>

                                <table class="table table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col" colspan="2">Habitaciones reservadas</th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <th scope="row">Id Habitacion</th>
                                        <td id="id_habitacion" class="w-50"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Numero Habitacion</th>
                                        <td id="numero"></td>
                                    </tr>

                                    </tbody>
                                </table>

                                <table class="table table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col" colspan="2">Servicio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Id Servicio</th>
                                            <td id="id_servicio" class="w-50"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nombre Servicio</th>
                                            <td id="nombre_servicio"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Precio</th>
                                            <td id="precio"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Paginacion -->
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php if ($numPag[1] > 1) { ?>
                            <li class="page-item">
                                <a class="page-link" href="./mainController.php?pagina=<?php echo $numPag[1] - 1 ?>">
                                    Anterior
                                </a>
                            </li>
                        <?php } ?>

                        <?php for ($x = 1; $x <= $numPag[0]; $x++) { ?>
                            <li class="page-item <?php if ($x == $numPag[1]) echo "active" ?>">
                                <a class="page-link" href="./mainController.php?pagina=<?php echo $x ?>">
                                    <?php echo $x ?></a>
                            </li>
                        <?php } ?>

                        <?php if ($numPag[1] < $numPag[0]) { ?>
                            <li class="page-item">
                                <a class="page-link" href="./mainController.php?pagina=<?php echo $numPag[1] + 1 ?>">
                                    Siguiente
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    </div>

    <script>
        //Script para asignar los detalles de reserva
        $(document).ready(function() {
            //Obtener el id de reseva
            $(".btn-detalle").click(function() {
                var idReserva = $(this).data("id");

                //Obtener los datos relacionado de la reserva
                $.ajax({
                    type: "POST",
                    url: "obtenerDetalleReserva.php",
                    data: {
                        idReserva: idReserva
                    },

                    //Obtenemos los datos en un json
                    success: function(datosReservaDetalle) {
                        //Convertimos en un objeto js
                        var reserva = JSON.parse(datosReservaDetalle);

                        //Asingamos los valores 
                        $('#imagen img').attr('src', reserva.imagen ? reserva.imagen : '../controller/img/no_img.png');
                        $('#id_reserva').text(reserva.id_reserva);
                        $('#id_cliente').text(reserva.id_cliente);
                        $('#nombre_cliente').text(reserva.nombre_cliente);
                        $('#id_empleado').text(reserva.id_empleado);
                        $('#nombre_empleado').text(reserva.nombre_empleado);
                        $('#fecha_salida').text(reserva.fecha_salida);
                        $('#fecha_entrada').text(reserva.fecha_entrada);

                        //Habitacion
                        $('#id_habitacion').text(reserva.id_habitaciones);
                        $('#numero').text(reserva.numeros_habitaciones);

                        //Servicio
                        $('#id_servicio').text(reserva.id_servicios);
                        $('#nombre_servicio').text(reserva.nombre_servicios);
                        $('#precio').text(reserva.precios_servicios);

                        $('#modalReserva').modal('show');

                    },
                    error: function() {
                        console.log("error al obtener datos");
                    }
                });
            });
        });
    </script>
</body>

</html>