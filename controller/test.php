// Generar el nuevo salt y hash de la nueva contraseña
$salt = Utils::generar_salt(16);
$password_hash = hash('sha256', $salt . $passwordNuevo);

// Actualizar la contraseña y el salt en la base de datos
$update = $conexPDO->prepare("UPDATE hotel.empleados SET password = ?, salt = ? WHERE id_empleado = ?");
$update->bindParam(1, $password_hash);
$update->bindParam(2, $salt);
$update->bindParam(3, $id_empleado);
$update->execute();