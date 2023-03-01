<?php

namespace model;

use \PDO;
use \PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/includes/Exception.php';
require '../PHPMailer/includes/PHPMailer.php';
require '../PHPMailer/includes/SMTP.php';

// Definimos una constante global con el código de éxito del correo
define('CORREO_ENVIADO', 1);

// Definimos una constante global con el código de error del correo
define('ERROR_CORREO', -1);
class Utils
{


    /**
     * Funcion que se conecta a la BD y nos devuelve una conexion PDO activa
     */
    public static function conectar()
    {
        $conPDO = null;
        try {
            require_once("../global.php");
            $conPDO = new PDO("mysql:host=" . $DB_SERVER . ";dbname=" . $DB_SCHEMA, $DB_USER, $DB_PASSWD);
            return $conPDO;
        } catch (PDOException $e) {
            print "¡Error al conectar!: " . $e->getMessage() . "<br/>";
            return $conPDO;
            die();
        }
    }

    /**
     * Limpiamos el contenido de las variables
     */
    public static function limpiar_datos($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    /**
     * Funcion que genera una cadena aleatoria
     */
    public static function generar_salt($tam)
    {

        //Definimos un array de caracteres
        $letras = "0123456789";

        $salt = "";
        //Vamos añadiendo $tam caracteres aleatorios a la salt
        for ($i = 0; $i < $tam; $i++) {
            $salt .= $letras[rand(0, strlen($letras) - 1)];
        }

        //devolvemos la salt
        return $salt;
    }

    //La funcion genera un codigo número de 4 digitos aleatorio
    public static function generar_codigo_activacion()
    {
        return rand(1111, 9999);
    }

    //Funcion para enviar el codigo de activación
    public static function correo_registro($email, $cod_activation)
    {
        // Creamos una nueva instancia de PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuramos el servidor SMTP
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Configuramos el mensaje
            $mail->setFrom('', 'Remitente');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Activacion de cuenta';
            $mail->Body = '<html><body>';
            $mail->Body .= '<p>Estimado usuario,</p>';
            $mail->Body .= '<p>Le damos la bienvenida a nuestro sitio web. Para completar el proceso de registro, por favor ingrese el siguiente código de activación:</p>';
            $mail->Body .= '<p><strong>' . $cod_activation . '</strong></p>';
            $mail->Body .= '<p>Gracias por unirse a nosotros.</p>';
            $mail->Body .= '</body></html>';

            // Enviamos el correo electrónico
            $mail->send();

            // El correo ha sido enviado correctamente
            return CORREO_ENVIADO;
        } catch (Exception $e) {
            // Ha habido un error al enviar el correo
            return ERROR_CORREO;
        }
    }
}

//Ejemplo de añadir cookie
setcookie("nombre", "zcfspace", time() + 3600, "/", "", 0);
