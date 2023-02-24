<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/login.css">

</head>

<body class="text-center" id="contenido">
  <main class="form-signin">
    <form method="post" action="../controller/.php">
      <img class="mb-4" src="../controller/img/bootstrap-logo.svg" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>

      <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Correo electrónico</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Contraseña</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>

      <div>
        <p>¿No tienes una cuenta? <a href="#" id="registro-link">Regístrate</a></p>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
    </form>
  </main>
  <script>
    $(document).ready(function() {
      // Obtener el botón o enlace de registro
      var registroLink = $('#registro-link');

      // Agregar un evento de clic al botón o enlace
      registroLink.click(function(event) {
        event.preventDefault(); // Evita que se recargue la página

        // Cargar el contenido de registro usando AJAX
        $.ajax({
          url: 'signUp.php',
          type: 'GET',
          success: function(response) {
            $('#contenido').html(response);
          }
        });
      });
    });
  </script>
</body>

</html>