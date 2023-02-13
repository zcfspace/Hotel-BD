<?php
// Conecta a la base de datos
$conn = mysqli_connect('localhost', 'usuario_bd', 'password_bd', 'nombre_bd');

// Obtiene el ID de la reserva desde la URL (ejemplo: obtener_detalles_reserva.php?id=42)
$id = $_GET['id'];

// Realiza una consulta a la base de datos para obtener los detalles de la reserva con el ID especificado
$query = "SELECT * FROM reservas WHERE id = $id";
$result = mysqli_query($conn, $query);

// Obtiene los datos de la reserva como un array asociativo
$reserva = mysqli_fetch_assoc($result);

// Devuelve los datos de la reserva en formato JSON
header('Content-Type: application/json');
echo json_encode($reserva);
