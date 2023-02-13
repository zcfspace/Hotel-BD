<!DOCTYPE html>
<html>

<head>
    <title>Detalles de la Reserva</title>
    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <!-- Botón que muestra el modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detallesModal">
        Ver detalles de la reserva
    </button>

    <!-- Modal que muestra los detalles de la reserva -->
    <div class="modal fade" id="detallesModal" tabindex="-1" role="dialog" aria-labelledby="detallesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detallesModalLabel">Detalles de la Reserva</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detallesModalBody">
                    <!-- Aquí se mostrarán los detalles de la reserva -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript que maneja el evento de clic en el botón y carga los detalles de la reserva -->
    <script>
        // Obtiene el botón
        const button = document.querySelector('button[data-toggle="modal"]');

        // Agrega un manejador de evento de clic al botón
        button.addEventListener('click', async () => {
            // Realiza una petición HTTP GET a obtener_detalles_reserva.php
            const response = await fetch('obtener_detalles_reserva.php');
            // Lee la respuesta como un objeto JSON
            const data = await response.json();

            // Obtiene el elemento donde se mostrarán los detalles de la reserva
            const detallesModal = document.getElementById('detallesModal');

            // Agrega el contenido a la modal
            detallesModal.innerHTML = `
        <h5 class="modal-title">Detalles de la reserva</h5>
        <div class="modal-body">
          <p>ID de la reserva: ${data.id}</p>
          <p>Fecha: ${data.fecha}</p>
          <p>Hora: ${data.hora}</p>
          <p>Nombre del cliente: ${data.nombreCliente}</p>
          <p>Número de personas: ${data.numPersonas}</p>
        </div>
      `;

            // Muestra la modal
            $('#detallesModal').modal('show');
        });