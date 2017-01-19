<?php

/**
 * Description of TipoUsuario
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class TipoUsuario {

    private $idTipoUsuario;
    private $tipoUsuario;

    public function __construct() {
        
    }

    function getIdTipoUsuario() {
        return $this->idTipoUsuario;
    }

    function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    function setIdTipoUsuario($idTipoUsuario) {
        $this->idTipoUsuario = $idTipoUsuario;
    }

    function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }

    /**
     * Método que obtiene todos los tipos de usuarios almacenados en la BD
     * @return array Retorna una array con los resultados
     */
    public function getTiposUsuarios() {
        try {

            $serviceCnx = new Conexion(); //service de la conexion
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM tipo_usuario"; //QUERY
            $rs = mysqli_query($cnx, $sql); //RESULT SET
            $tipoUsuarios = array(); //ARRAY PARA ALMACENAR LOS RESULTADOS

            while ($r = mysqli_fetch_array($rs)) {//OBTENIENDO RESULTADOS
                //instanceando y seteando objeto
                $tipoUsuario = new TipoUsuario();
                $tipoUsuario->setIdTipoUsuario($r['id_tipo_usuario']);
                $tipoUsuario->setTipoUsuario($r['tipo_usuario']);


                array_push($tipoUsuarios, $tipoUsuario); //AGREGANDO RESULTADOS AL ARRAY
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $tipoUsuarios; //RETORNANDO RESULTADO
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Metodo que retorna el tipo de Usuario segun su id
     * @param type $idTipoUsuario
     * @return \TipoUsuario
     */
    public function getTipoUsuarioPorId($idTipoUsuario) {
        try {

            $serviceCnx = new Conexion(); //service de la conexion
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM tipo_usuario WHERE id_tipo_usuario='$idTipoUsuario'"; //QUERY
            $rs = mysqli_query($cnx, $sql); //RESULT SET
           
            while ($r = mysqli_fetch_array($rs)) {//OBTENIENDO RESULTADOS
                //instanceando y seteando objeto
                $tipoUsuario = new TipoUsuario();
                $tipoUsuario->setIdTipoUsuario($r['id_tipo_usuario']);
                $tipoUsuario->setTipoUsuario($r['tipo_usuario']);
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $tipoUsuario; //RETORNANDO RESULTADO
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
