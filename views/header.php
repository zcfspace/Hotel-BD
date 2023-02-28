<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="../controller/mainController.php" class="nav-link px-2 link-secondary">Reservas</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">Clientes</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">Habitaciones</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">Servicio</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">Factura</a></li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            </form>

            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../controller/img/user.png" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    <!-- <li><a class="dropdown-item" href="../controller/changePassword.php">Cambiar Constraseña</a></li> -->
                    <li><a class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#changePasswordOffcanvas" aria-controls="changePasswordOffcanvas">Cambiar Constraseña</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="../controller/logout.php">Cerrar sesión</a></li>
                </ul>

            </div>
        </div>

        <!-- Vista para cambio de contraseña -->
        <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="changePasswordOffcanvas" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="staticBackdropLabel">Cambiar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <!-- Formulario para cambiar de contraseña -->
                    <form id="changePassword" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                        <input type="hidden" name="id_empleado" value="<?= $_SESSION["idEmpleado"] ?>">
                        <div class="mb-3">
                            <label for="passwordCurrent" class="form-label">Contraseña Actual</label>
                            <input type="password" name="passwordCurrent" class="form-control" id="passwordCurrent">
                        </div>
                        <div class="mb-3">
                            <label for="passwordNew1" class="form-label">Contraseña Nueva</label>
                            <input type="password" name="passwordNew1" class="form-control" id="passwordNew1" aria-describedby="passwordHelp">
                            <div id="passwordHelp" class="form-text">La contraseña debe tener al menos 4 caracteres</div>
                        </div>
                        <div class="mb-3">
                            <label for="passwordNew2" class="form-label">Repita la Contraseña Nueva</label>
                            <input type="password" name="passwordNew2" class="form-control" id="passwordNew2">
                        </div>
                        <button type="submit" class="btn btn-primary">Cambiar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para mostrar resultado de cambio de contraseña -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Resultado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se mostrará la respuesta del servidor -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Funcion para validar el formulario antes de enviar al controlador
            function validarFormulario() {
                const passwordCurrent = document.getElementById('passwordCurrent');
                const passwordNew1 = document.getElementById('passwordNew1');
                const passwordNew2 = document.getElementById('passwordNew2');

                let isValid = true;

                // Validar si passwordCurrent tiene valor
                if (passwordCurrent.value === '') {
                    passwordCurrent.classList.add('is-invalid');
                    isValid = false;
                } else {
                    passwordCurrent.classList.remove('is-invalid');
                }

                // Validar si passwordNew1 tiene al menos 4 caracteres
                if (passwordNew1.value.length < 4) {
                    passwordNew1.classList.add('is-invalid');
                    isValid = false;
                } else {
                    passwordNew1.classList.remove('is-invalid');
                }

                // Validar si passwordNew1 y passwordNew2 son iguales
                if (passwordNew1.value !== passwordNew2.value) {
                    passwordNew2.classList.add('is-invalid');
                    isValid = false;
                } else {
                    passwordNew2.classList.remove('is-invalid');
                }

                // Si todas las validaciones pasan, enviar el formulario con AJAX
                if (isValid) {
                    $.ajax({
                        type: "POST",
                        url: "changePassword.php",
                        data: $("#changePassword").serialize(),
                        success: function(resultado) {

                            let AMostrar = JSON.parse(resultado);
                            //Mostrar el resultado en el modal
                            $("#changePasswordModal .modal-body").html(AMostrar);
                            $("#changePasswordModal").modal("show");

                            //Cerrar el offvancas si se cambio correctamente
                            if (AMostrar.includes('cambiada')) {
                                $('#changePasswordOffcanvas').offcanvas('hide');
                            }
                        }
                    });
                }
                return false; // Evita que el formulario se envíe por defecto
            }
        </script>
    </div>
</header>