<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body class="text-center" id="contenido">
    <main class="form-signin">
        <form method="post" action="../controller/loginController.php" enctype="multipart/form-data">
            <img class="mb-4" src="../controller/img/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Registro de cuenta</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                <label for="email">Correo electrónico</label>
            </div>

            <div class="form-floating">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="pablo110">
                <label for="nombre">Nombre de usuario</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="password">Contraseña</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Acepto las condiciones
                </label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Siguiente</button>

            <div class="mt-3">
                <p>¿Tienes una cuenta? <a href="login.php">Entrar</a></p>
            </div>

            <p class="mt-3 mb-3 text-muted">&copy; 2023</p>
        </form>
    </main>
</body>

</html>