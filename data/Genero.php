<?php

/**
 * Description of Genero
 *
 * @author vfernandez
 */
require_once 'ConexionPostgres.php';

class Genero {

    private $nomGenero;
    private $codGenero;

    public function __construct() {
        
    }

    function getNomGenero() {
        return $this->nomGenero;
    }

    function getCodGenero() {
        return $this->codGenero;
    }

    function setNomGenero($nomGenero) {
        $this->nomGenero = $nomGenero;
    }

    function setCodGenero($codGenero) {
        $this->codGenero = $codGenero;
    }

    /**
     * Método que obtiene todos los generos presentes en la base de datos del sistema de inventario
     * @return array Retorna un array con los resultados obtenidos
     */
    public function getGeneros() {
        try {
            $serviceCnx = new ConexionPostgres(); //servicio para la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT * FROM generos"; //query
            $rs = pg_query($cnx, $sql); //resultset de la query
            $generos = array(); //ARRAY PARA ALMACENAR LOS RESULTADOS
            while ($r = pg_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO OBJETO
                $genero = new Genero();
                $genero->setCodGenero($r['cod_genero']);
                $genero->setNomGenero($r['nom_genero']);

                array_push($generos, $genero); //INGRESANDO OBJETO AL ARRAY
            }

            //LIBERANDO RESULTADOS
            pg_free_result($rs);
            pg_close($cnx);

            return $generos; //RETORNANDO RESULTADOS
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
