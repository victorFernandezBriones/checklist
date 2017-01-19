<?php

/**
 * Description of Responsable
 *
 * @author vfernandez
 */
require_once 'ConexionPostgres.php';

class Responsable {

    private $nombrePersonal;

    public function __construct() {
        
    }

    function getNombrePersonal() {
        return $this->nombrePersonal;
    }

    function setNombrePersonal($nombrePersonal) {
        $this->nombrePersonal = $nombrePersonal;
    }

    public function obtenerResponsablePorId($idResponsable) {
        try {
            $serviceCnx = new ConexionPostgres();
            $cnx = $serviceCnx->conectar();
            $sql = "SELECT nom_personal,ape_personal"
                    . " FROM personal WHERE cod_personal='$idResponsable' ";
            $responsable = "";
            $rs = pg_query($cnx, $sql);

            while ($r = pg_fetch_array($rs)) {
                $responsable = $r['nom_personal'] . " " . $r['ape_personal'];
            }

            //liberando recursos
            pg_close($cnx);
            pg_free_result($rs);

            return $responsable;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
