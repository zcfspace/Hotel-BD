<?php 

namespace model;
use \PDO;
use \PDOException;

class Utils {

   
    /**
     * Funcion que se conecta a la BD y nos devuelve una conexion PDO activa
     */
    public static function conectar()
    {
        $conPDO=null;
        try {
            require_once("../global.php");
            $conPDO = new PDO("mysql:host=".$DB_SERVER.";dbname=".$DB_SCHEMA, $DB_USER, $DB_PASSWD);
            return $conPDO;

         } catch (PDOException $e) {
            print "¡Error al conectar!: " . $e->getMessage() . "<br/>";
            return $conPDO;
            die();
        }
      
    }

    
}

//$util = new Utils();

//var_dump($util->conectar());