<?php
session_start();

// Eliminar todos los datos de la sesión
session_unset();

// Destruir la sesión actual
session_destroy();

// Redirigir a la página de login
header("Location: ../views/login.php"); 

exit();
