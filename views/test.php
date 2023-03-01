<?php
$para = 'czhe581@g.educaand.es';
$titulo = 'Asunto del correo electrónico';
$mensaje = 'Este es un correo electrónico enviado desde PHP.';
$cabeceras = 'From: tu_email@gmail.com' . "\r\n" .
    'Reply-To: tu_email@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if (mail($para, $titulo, $mensaje, $cabeceras)) {
    echo "Correo enviado correctamente";
} else {
    echo "Error al enviar el correo";
}
