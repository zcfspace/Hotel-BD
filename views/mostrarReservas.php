<?php

namespace views;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Lista de Reservas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row pt-3 ">
            <div class="col-lg-11 col-sm-11 m-auto">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </symbol>
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </symbol>
                    </svg>

                    <?php
                    if ($mensaje != null && isset($mensaje)) {
                        if ($mensaje == "correct") {
                    ?>
                            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                                    <use xlink:href="#check-circle-fill" />
                                </svg>

                                <?php
                                if (!empty($mensajeAMostrar)) {
                                    echo "<strong>" . $mensajeAMostrar . "</strong>";
                                } else {
                                    echo "<strong> Opereacion realizada correctamente </strong>";
                                }
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php
                        } else {
                            if ($mensaje == "error") {
                            ?>
                                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                                        <use xlink:href="#exclamation-triangle-fill" />
                                    </svg>
                                    <strong>Error al acceder al BD</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Imagen</th>
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

                        <?php foreach ($datosReservas as $reserva) {
                        ?>
                            <tr>
                                <td><?php echo $reserva->imagen ?></td>
                                <td> <button type="button" class="btn btn-link btn-detalle" data-bs-toggle="modal" data-bs-target="#modalReserva" data-id="<?php echo $reserva->id_reserva; ?>">
                                        <?php echo $reserva->id_reserva ?>
                                    </button></td>

                                <td><?php echo $reserva->fecha_entrada ?></td>
                                <td><?php echo $reserva->fecha_salida ?></td>
                                <td><?php echo $reserva->id_empleado ?></td>
                                <td><?php echo $reserva->id_cliente ?></td>
                                <td>
                                    <form method='POST' action='../controller/borrarReserva.php'>
                                        <input type='hidden' name='id_reserva' value='<?php echo $reserva->id_reserva; ?>' />
                                        <button class='button btn btn-danger'>Eliminar</button>
                                    </form>
                                </td>
                                <td><?php print("<form method='POST' action='../controller/actualizarReserva.php'>");
                                    print("<input type='hidden' name='id_reserva' value='" . $reserva->id_reserva . "'/>");
                                    print("<input type='hidden' name='imagen' value='" . $reserva->imagen . "'/>");
                                    print("<input type='hidden' name='fecha_entrada' value='" . $reserva->fecha_entrada . "'/>");
                                    print("<input type='hidden' name='fecha_salida' value='" . $reserva->fecha_salida . "'/>");
                                    print("<input type='hidden' name='id_empleado' value='" . $reserva->id_empleado . "'/>");
                                    print("<input type='hidden' name='id_cliente' value='" . $reserva->id_cliente . "'/>");
                                    print("<button name='modificar' value='false' class='btn btn-primary'>Modificar</button>");
                                    print("</form>"); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <div class="modal fade" id="modalReserva" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalReserva" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Detalle</h5>
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
                                        <td id="imagen"></td>
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
                                        <td id="id_habitacion"></td>
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
                                            <td id="id_servicio"></td>
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

                <?php
                print("<form method='POST' action='../controller/insertarReserva.php'>");
                print("<button class='btn btn-success'>Añadir Reserva</button>");
                print("</form>");
                ?>
            </div>

        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".btn-detalle").click(function() {
                var idReserva = $(this).data("id");

                $.ajax({
                    type: "POST",
                    url: "obtenerDetalleReserva.php",
                    data: {
                        idReserva: idReserva
                    },
                    success: function(datosReservaDetalle) {

                        var reserva = JSON.parse(datosReservaDetalle);

                        $('#imagen').text(reserva.imagen);
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
                        // maneja el error
                    }
                });
            });
        });
    </script>
</body>

</html>