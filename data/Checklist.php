<?php

/**
 * Description of Checklist
 *
 * @author vfernandez
 */
require_once 'Conexion.php';
require_once 'Funciones.php';

class Checklist {

    private $idChecklist;
    private $fechaEnvio;
    private $fechaRecepcion;
    private $idEstadoChecklist;
    private $idContrato;

    public function __construct() {
        
    }

    function getIdChecklist() {
        return $this->idChecklist;
    }

    function getFechaEnvio() {
        return $this->fechaEnvio;
    }

    function getFechaRecepcion() {
        return $this->fechaRecepcion;
    }

    function getIdEstadoChecklist() {
        return $this->idEstadoChecklist;
    }

    function setIdChecklist($idChecklist) {
        $this->idChecklist = $idChecklist;
    }

    function setFechaEnvio($fechaEnvio) {
        $this->fechaEnvio = $fechaEnvio;
    }

    function setFechaRecepcion($fechaRecepcion) {
        $this->fechaRecepcion = $fechaRecepcion;
    }

    function setIdEstadoChecklist($idEstadoChecklist) {
        $this->idEstadoChecklist = $idEstadoChecklist;
    }

    function getIdContrato() {
        return $this->idContrato;
    }

    function setIdContrato($idContrato) {
        $this->idContrato = $idContrato;
    }

    /**
     * Método que ingresa un registro en la tabla checklist
     * @param Checklist $checklist Objeto con los atributos a ingresar
     * @return int Retorna 1 si la operación es correcta, -1 si no lo es
     */
    public function ingresarChecklist($checklist) {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "INSERT INTO checklist(id_checklist,fecha_envio,fecha_recepcion,id_estado_checklist,id_contrato) "
                    . "VALUES('" . $checklist->getIdChecklist() . "','" . $checklist->getFechaEnvio() . "','" . $checklist->getFechaRecepcion() . "',"
                    . "'" . $checklist->getIdEstadoChecklist() . "','" . $checklist->getIdContrato() . "')"; //query

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //asignando flag segun resultado de la operacion
            //liberando recursos
            mysqli_close($cnx);

            return $exito; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

    /**
     * Método que actualiza el estado de un checklist
     * @param int $idChecklist id del ckecklist a actualizar
     * @param int $idEstadoChecklist id del estado a cambiar
     * @return int Retorna 1 si la operación es correcta, -1 si no lo es
     */
    public function actualizarEstadoChecklist($idChecklist, $idEstadoChecklist) {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $serviceFunciones = new Funciones();
            $fechaRecepcion = $serviceFunciones->obtenerFechaSinHora();
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "UPDATE checklist SET id_estado_checklist='$idEstadoChecklist',fecha_recepcion='$fechaRecepcion' "
                    . "WHERE id_checklist='$idChecklist'"; //query

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //asignando flag segun resultado de la operacion
            //liberando recursos
            mysqli_close($cnx);

            return $exito; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

    /**
     * Método que obtiene todos los checklist asociados a un contrato
     * @param int $idContrato id del contrato
     * @return array Retorna un array con los resultados
     */
    public function getChecklistsPorContrato($idContrato) {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT * FROM checklist WHERE id_contrato='$idContrato'"; //query
            $checklists = array(); //ARRAY PARA ALMACENAR LOS RESULTADOS
            $rs = mysqli_query($cnx, $sql);

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO OBJETOS
                $checklist = new Checklist();
                $checklist->setIdChecklist($r['id_checklist']);
                $checklist->setFechaEnvio($r['fecha_envio']);
                $checklist->setFechaRecepcion($r['fecha_recepcion']);
                $checklist->setIdEstadoChecklist($r['id_estado_checklist']);
                $checklist->setIdContrato($r['id_contrato']);

                //INSERTANDO OBJETOS AL ARRAY
                array_push($checklists, $checklist);
            }
            //liberando recursos
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $checklists; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

    /**
     * Método que obtiene el id maximo de la tabla checklist
     * @return int Retorna el id maximo de la tabla checklist
     */
    public function getMaxIdChecklist() {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT MAX(id_checklist) AS max FROM checklist"; //query
            $max = "";
            $rs = mysqli_query($cnx, $sql);

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO OBJETOS
                $max = $r['max'];
            }
            //liberando recursos
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $max; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

    /**
     * Método que obtiene el checklist activo por contrato
     * @param int $idContrato id del contrato
     * @param int $idEstado id del estado del checklist
     * @return Checklist Retorna un objeto con los resultados
     */
    public function getChecklistsPorContratoYEstado($idContrato, $idEstado) {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT * FROM checklist WHERE id_contrato='$idContrato'"
                    . " AND id_estado_checklist='$idEstado'"; //query

            $rs = mysqli_query($cnx, $sql);

            if (mysqli_num_rows($rs) > 0) {
                while ($r = mysqli_fetch_array($rs)) {
                    //INSTANCEANDO Y SETEANDO OBJETOS
                    $checklist = new Checklist();
                    $checklist->setIdChecklist($r['id_checklist']);
                    $checklist->setFechaEnvio($r['fecha_envio']);
                    $checklist->setFechaRecepcion($r['fecha_recepcion']);
                    $checklist->setIdEstadoChecklist($r['id_estado_checklist']);
                    $checklist->setIdContrato($r['id_contrato']);
                }
            } else {
                $checklist = "";
            }

            //liberando recursos
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $checklist; //retornando resultado           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

    /**
     * Metodo que obtiene el primer y ultimo dia del mes
     * @param date $fecha fecha a consultar
     * @return array Retorna un array con el primer y ultimo dia del mes
     */
    public function obtenerPrimeryUltimoDiaFecha($fecha) {
        $serviceCnx = new Conexion;
        $cnx = $serviceCnx->conectar();

        $sql = "SELECT LAST_DAY('$fecha'- INTERVAL 1 MONTH) + INTERVAL 1 DAY AS primerDia, LAST_DAY('$fecha') ultimoDia";
        $dias = array();
        $rs = mysqli_query($cnx, $sql);

        while ($d = mysqli_fetch_array($rs)) {
            $dias['primerDia'] = $d['primerDia'];
            $dias['ultimoDia'] = $d['ultimoDia'];
        }

        mysqli_free_result($rs);
        mysqli_close($cnx);

        return $dias;
    }

    /**
     * Método que obtiene un registro de checklist por contrato, estados y fecha
     * @param int $idContrato id del contrato
     * @param int $idEstado id del estado
     * @param Date $fecha fecha del checklist
     * @return Checklist Retorna un objeto con los resultados
     */
    public function getChecklistsPorContratoEstadoYFechas($idContrato, $idEstado, $fecha) {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $primerUltimoDiaMes = $this->obtenerPrimeryUltimoDiaFecha($fecha);

            if ($idEstado != 0) {
                $sql = "SELECT * FROM checklist WHERE id_contrato='$idContrato'"
                        . " AND id_estado_checklist='$idEstado' AND fecha_envio BETWEEN '" . $primerUltimoDiaMes['primerDia'] . "' "
                        . " AND '" . $primerUltimoDiaMes['ultimoDia'] . "' "; //query
            } else {
                $sql = "SELECT * FROM checklist WHERE id_contrato='$idContrato'"
                        . " AND fecha_envio BETWEEN '" . $primerUltimoDiaMes['primerDia'] . "' "
                        . " AND '" . $primerUltimoDiaMes['ultimoDia'] . "' "; //query
            }

            $rs = mysqli_query($cnx, $sql);

            if (mysqli_num_rows($rs) > 0) {
                while ($r = mysqli_fetch_array($rs)) {
                    //INSTANCEANDO Y SETEANDO OBJETOS
                    $checklist = new Checklist();
                    $checklist->setIdChecklist($r['id_checklist']);
                    $checklist->setFechaEnvio($r['fecha_envio']);
                    $checklist->setFechaRecepcion($r['fecha_recepcion']);
                    $checklist->setIdEstadoChecklist($r['id_estado_checklist']);
                    $checklist->setIdContrato($r['id_contrato']);
                }
            } else {
                $checklist = "";
            }

            //liberando recursos
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $checklist; //retornando resultado           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

    /**
     * Método que obtiene el checklist activo por contrato
     * @param int $idContrato id del contrato a consultar
     * @return Checklist Retorna un objeto con los resultados
     */
    public function getChecklistsPorActivosContrato($idContrato) {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT * FROM checklist WHERE id_contrato='$idContrato'"
                    . " AND id_estado_checklist < 3"; //query

            $rs = mysqli_query($cnx, $sql);

            if (mysqli_num_rows($rs) > 0) {
                while ($r = mysqli_fetch_array($rs)) {
                    //INSTANCEANDO Y SETEANDO OBJETOS
                    $checklist = new Checklist();
                    $checklist->setIdChecklist($r['id_checklist']);
                    $checklist->setFechaEnvio($r['fecha_envio']);
                    $checklist->setFechaRecepcion($r['fecha_recepcion']);
                    $checklist->setIdEstadoChecklist($r['id_estado_checklist']);
                    $checklist->setIdContrato($r['id_contrato']);
                }
            } else {
                $checklist = "";
            }

            //liberando recursos
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $checklist; //retornando resultado           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

    /**
     * Método que obtiene un registro de la tabla checklist segun su id
     * @param int $idChecklist id del checklist a consultar
     * @return Checklist Retorna un objetos con lso resultados
     */
    public function getChecklistPorId($idChecklist) {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT * FROM checklist WHERE id_checklist='$idChecklist'"; //query

            $rs = mysqli_query($cnx, $sql);

            if (mysqli_num_rows($rs) > 0) {

                while ($r = mysqli_fetch_array($rs)) {
                    //INSTANCEANDO Y SETEANDO OBJETOS
                    $checklist = new Checklist();
                    $checklist->setIdChecklist($r['id_checklist']);
                    $checklist->setFechaEnvio($r['fecha_envio']);
                    $checklist->setFechaRecepcion($r['fecha_recepcion']);
                    $checklist->setIdEstadoChecklist($r['id_estado_checklist']);
                    $checklist->setIdContrato($r['id_contrato']);
                }
            } else {
                $checklist = "";
            }

            //liberando recursos
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $checklist; //retornando resultado           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

    
    public function verificarChecklistActivo($idContrato, $fecha) {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT COUNT(*) AS total FROM checklist"
                    . " WHERE id_contrato='$idContrato' AND id_estado_checklist < 3"; //query

            $rs = mysqli_query($cnx, $sql);
            $total = 0;
            
            if (mysqli_num_rows($rs) > 0) {

                while ($r = mysqli_fetch_array($rs)) {
                    //INSTANCEANDO Y SETEANDO OBJETOS
                    $total = $r['total'];
                }
            } 

            //liberando recursos
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $total; //retornando resultado           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

}
