<?php
session_start(); // Inicia la sesión
session_destroy(); // Destruye la sesión actual
header("Location: ../views/login.php"); // Redirige a la página de inicio de sesión
