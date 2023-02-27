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
    <title>Modificar Reserva</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

    <?php
    //dependiendo de la accion llamaremos a un controlador u otro con los datos
    switch ($accion) {
        case "modificar":
            $url_destino = "../controller/actualizarReserva.php";
            break;
        case "insertar":
            $url_destino = "../controller/insertarReserva.php";
            break;
        default:
            $url_destino = "../views/mostrarReserva.php";
    }
    ?>
    <div class="container">
        <form method="post" action="<?= $url_destino ?> " enctype="multipart/form-data">
            <div class="col-lg-11 col-sm-11 m-auto shadow-sm p-3 m-5 bg-body rounded mt-3">

                <div class="alert alert-info text-center" role="alert">
                    El archivo debe ser una imagen (JPG, JPEG, GIF o PNG) y no debe superar los 5000 KB.
                    <br>
                    No existe el empleado 10 ni el cliente 9, se mostrá un error si lo asignas.
                </div>

                <div class="form-group row mt-2 d-flex justify-content-center ">
                    <label for="id_reserva" class="col-lg-3 col-form-label">Id reserva:</label>
                    <div class="col-lg-6">
                        <input disabled type="text" class="form-control" id="id_reserva" name="id_reserva" value=<?= (isset($reserva) ? $reserva["id_reserva"] : "") ?>>
                    </div>
                </div>

                <div class="form-group row mt-2 d-flex justify-content-center">
                    <label for="imagen" class="col-lg-3 col-form-label">Imagen:</label>
                    <div class="col-lg-6">
                        <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/jpeg, image/png, image/gif">
                    </div>
                </div>

                <input type='hidden' name='imagen_antiguo' value=<?= (isset($reserva) ? $reserva["imagen"] : "") ?>>

                <div class="form-group row mt-2 d-flex justify-content-center">
                    <label for="fecha_entrada" class="col-lg-3 col-form-label">Fecha Entrada:</label>
                    <div class="col-lg-6">
                        <input type="datetime-local" class="form-control" id="fecha_entrada" name="fecha_entrada" value="<?php echo isset($reserva) ? $reserva['fecha_entrada'] : $fecha_por_defecto_entrada; ?>">
                    </div>
                </div>

                <div class=" form-group row mt-2 d-flex justify-content-center">
                    <label for="fecha_salida" class="col-lg-3 col-form-label">Fecha Salida:</label>
                    <div class="col-lg-6">
                        <input type="datetime-local" class="form-control" id="fecha_salida" name="fecha_salida" value="<?php echo isset($reserva) ? $reserva['fecha_salida'] : $fecha_por_defecto_salida; ?>">
                    </div>
                </div>

                <div class="form-group row mt-2 d-flex justify-content-center">
                    <label for="id_empleado" class="col-lg-3 col-form-label">Empleado</label>

                    <div class="col-lg-6">
                        <select class="form-control w-25 " id="id_empleado" name="id_empleado">
                            <?php
                            //Generamos las option del select id_empleado
                            for ($i = 1; $i <= 10; $i++) {
                                print("<option value='$i' ");
                                //Si la id_empleado de nuestro reserva a modificar es la que estamos escribiendo ahora
                                //La marcamos como seleccionada 
                                if (isset($reserva)) {
                                    if ($reserva["id_empleado"] == $i) print("selected");
                                }
                                print(">$i</option>\n");
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row mt-2 d-flex justify-content-center">
                    <label for="id_cliente" class="col-lg-3 col-form-label">Cliente</label>

                    <div class="col-lg-6">
                        <select class="form-control w-25" id="id_cliente" name="id_cliente">
                            <?php
                            //Generamos las option del select id_cliente
                            for ($i = 1; $i <= 9; $i++) {
                                print("<option value='$i' ");
                                //Si la id_cliente de nuestro reserva a modificar es la que estamos escribiendo ahora
                                //La marcamos como seleccionada 
                                if (isset($reserva)) {
                                    if ($reserva["id_cliente"] == $i) print("selected");
                                }
                                print(">$i</option>\n");
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <div class="p-3">
                        <a class="btn btn-danger shadow" href="mainController.php" role="button">Deshacer</a>

                    </div>
                    <div class="p-3">
                        <!--Añadimos un campo oculto con el identificador del cliente para poder modificar el registro en Bd-->
                        <input type="hidden" name="id_reserva" value='<?= (isset($reserva) ? $reserva["id_reserva"] : "") ?>' />
                        <button type="submit" name="modificar" value="true" class="btn btn-primary shadow"> Aplicar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>