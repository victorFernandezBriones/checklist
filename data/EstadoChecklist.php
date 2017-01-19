<?php

/**
 * Description of EstadoChecklist
 *
 * @author vfernandez
 */
class EstadoChecklist {

    private $idEstadoChecklist;
    private $estadoChecklist;

    public function __construct() {
        
    }

    function getIdEstadoChecklist() {
        return $this->idEstadoChecklist;
    }

    function getEstadoChecklist() {
        return $this->estadoChecklist;
    }

    function setIdEstadoChecklist($idEstadoChecklist) {
        $this->idEstadoChecklist = $idEstadoChecklist;
    }

    function setEstadoChecklist($estadoChecklist) {
        $this->estadoChecklist = $estadoChecklist;
    }

    /**
     * Método que obtiene un estado según su id
     * @param int $idEstadoChecklist id del estado a consultar
     * @return \EstadoChecklist Retorna un objeto como resultado
     */
    public function getEstadoChecklistPorId($idEstadoChecklist) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar();
            $sql = "SELECT * FROM estado_checklist WHERE id_estado_checklist='$idEstadoChecklist'";
            $rs = mysqli_query($cnx, $sql);

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO OBJETOS
                $estadoC = new EstadoChecklist();
                $estadoC->setIdEstadoChecklist($r['id_estado_checklist']);
                $estadoC->setEstadoChecklist($r['estado_checklist']);
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $estadoC; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function getEstadosCheckist() {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar();
            $sql = "SELECT * FROM estado_checklist";
            $rs = mysqli_query($cnx, $sql);
            $estadosChecklist = array();
            
            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO OBJETOS
                $estadoC = new EstadoChecklist();
                $estadoC->setIdEstadoChecklist($r['id_estado_checklist']);
                $estadoC->setEstadoChecklist($r['estado_checklist']);
                
                array_push($estadosChecklist, $estadoC);
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $estadosChecklist; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
