<?php

namespace views;
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asignación de contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body class="text-center" id="contenido">
    <main class="form-signin">

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

        <form method="post" action="../controller/newPasswordSetController.php">
            <h1 class="h3 mb-3 fw-normal">Activación de cuenta</h1>

            <div class="form-floating">
                <input required type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value=<?= (isset($empleado) ? $empleado["email"] : "") ?>>
                <label for="email">Correo electrónico</label>
            </div>

            <div class="form-floating">
                <input required type="text" class="form-control" id="cod_activation" name="cod_activation" placeholder="Codigo de activación">
                <label for="cod_activation">Codigo de verificación</label>
            </div>

            <div class="form-floating">
                <input required type="password" class="form-control" id="password" name="password" placeholder="password">
                <label for="password">Contraseña Nueva</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Cambiar</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
        </form>
    </main>


</body>

</html>