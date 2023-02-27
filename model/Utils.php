<?php

namespace model;

use \PDO;
use \PDOException;

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
    public static function correo_registro($email, $cod_activation) {
        // Creamos el cuerpo del correo en formato HTML
        $mensaje = '<html><body>';
        $mensaje .= '<p>Estimado usuario,</p>';
        $mensaje .= '<p>Le damos la bienvenida a nuestro sitio web. Para completar el proceso de registro, por favor ingrese el siguiente código de activación:</p>';
        $mensaje .= '<p><strong>' . $cod_activation . '</strong></p>';
        $mensaje .= '<p>Gracias por unirse a nosotros.</p>';
        $mensaje .= '</body></html>';
        
        // Configuramos las cabeceras del correo
        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabeceras .= 'From: info@hotelzcf.com' . "\r\n";
        
        // Enviamos el correo electrónico
        if (mail($email, 'Activación de cuenta', $mensaje, $cabeceras)) {
          // El correo ha sido enviado correctamente
          return CORREO_ENVIADO;
        } else {
          // Ha habido un error al enviar el correo
          return ERROR_CORREO;
        }
      }
}

//$util = new Utils();

//var_dump($util->conectar());

//echo Utils::limpiar_datos("<scritp ...\2>");
//$empreado["nombre"]="Jose";
//$empreado["email"]="vgalflo309@g.educaand.es";

//Utils::correo_registro($empreado);
/*
//Ejemplo de filtrado de datos
$email = "john.doe@example.nation.com";

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo("$email is a valid email address");
} else {
  echo("$email is not a valid email address");
}
*/
//Ejemplo de añadir cookie
setcookie("nombre", "Pablo Galvan", time() + 3600, "/", "", 0);
