<?php

/**
 * Description of ConexionPostgres
 *
 * @author vfernandez
 */

class ConexionPostgres {

    private $servidor = "10.100.0.4";
    private $usuario = "postgres";
    private $contrasena = "valenicolas";
    private $puerto = "5432";
    private $db = "db_inventario";
    public $conexion_id;
    public $error;

    public function __construct() {
        
    }

    /**
     * 
     * @return mysql_link Retorna el link de la conexion a la base de datos
     */
    public function conectar() {
        try {
            //metodo para establecer la conexion con la base de datos
            $this->conexion_id = pg_connect("host=" . $this->servidor . " port= " . $this->puerto . " dbname=" . $this->db . " user=" . $this->usuario . " password=" . $this->contrasena);

            if (!$this->conexion_id) {//si es false se retorna un mensaje de error
                return $this->error = "Error, no se ha podido conectar a la base de datos";
            }

            return $this->conexion_id; //retornando link de la conexion
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @tutorial package Metodo que cierra la conexion establecida con la base de datos
     * @return int Retorna un 1 si el metodo es exitoso
     */
    public function cerrarConexion() {
        mysqli_close($this->conexion_id);
        return 1;
    }

}
