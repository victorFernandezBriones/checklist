<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contrato
 *
 * @author vfernandez
 */
require_once 'ConexionPostgres.php';
require_once 'Conexion.php';
require_once 'ContratoArea.php';
require_once 'Area.php';

class Contrato {

    private $idContrato;
    private $contrato;
    private $idEstadoContrato;
    private $idArea;

    public function __construct() {
        
    }

    function getIdContrato() {
        return $this->idContrato;
    }

    function getContrato() {
        return $this->contrato;
    }

    function setIdContrato($idContrato) {
        $this->idContrato = $idContrato;
    }

    function setContrato($contrato) {
        $this->contrato = $contrato;
    }

    function getIdArea() {
        return $this->idArea;
    }

    function setIdArea($idArea) {
        $this->idArea = $idArea;
    }

    function getIdEstadoContrato() {
        return $this->idEstadoContrato;
    }

    function setIdEstadoContrato($idEstadoContrato) {
        $this->idEstadoContrato = $idEstadoContrato;
    }

    /**
     * Método que obtiene todos los contratos presentes en el sistema
     * @return array Retorna una array con los resultados
     */
    public function getContratos() {
        try {

            $serviceConexion = new Conexion();
            $cnx = $serviceConexion->conectar(); //link de conexion
            $sql = "SELECT * FROM contrato c JOIN area a USING(id_area) ";
            $rs = mysqli_query($cnx, $sql); //resultset
            $contratos = array(); //array para las areas

            while ($r = mysqli_fetch_array($rs)) {
                //seteando el objeto                
                $contrato = new Contrato();
                $contrato->setIdContrato($r['id_contrato']);
                $contrato->setContrato($r['contrato']);
                $contrato->setIdEstadoContrato($r['id_estado_contrato']);
                $contrato->setIdArea($r['id_area']);

                $area = new Area();
                $area->setIdArea($r['id_area']);
                $area->setArea($r['area']);

                $contratoArea = new ContratoArea();
                $contratoArea->setContrato($contrato);
                $contratoArea->setArea($area);


                array_push($contratos, $contratoArea); //llenando el array con las areas de la DB
            }

            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $contratos; //retornando el array 
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Método que obtiene contratos segun su estado de actividad
     * @param int $idEstadoContrato id del estado del contrato a consultar
     * @return array Retorna un array con los resultados
     */
    public function getContratosPorEstado($idEstadoContrato) {
        try {

            $serviceConexion = new Conexion();
            $cnx = $serviceConexion->conectar(); //link de conexion
            $sql = "SELECT * FROM contrato c JOIN area a USING(id_area) WHERE c.id_estado_contrato='$idEstadoContrato'";
            $rs = mysqli_query($cnx, $sql); //resultset
            $contratos = array(); //array para las areas

            while ($r = mysqli_fetch_array($rs)) {
                //seteando el objeto                
                $contrato = new Contrato();
                $contrato->setIdContrato($r['id_contrato']);
                $contrato->setContrato($r['contrato']);
                $contrato->setIdEstadoContrato($r['id_estado_contrato']);
                $contrato->setIdArea($r['id_area']);

                $area = new Area();
                $area->setIdArea($r['id_area']);
                $area->setArea($r['area']);

                $contratoArea = new ContratoArea();
                $contratoArea->setContrato($contrato);
                $contratoArea->setArea($area);


                array_push($contratos, $contratoArea); //llenando el array con las areas de la DB
            }

            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $contratos; //retornando el array 
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Método que obtiene todos los contratos por area
     * @param int $idArea id del area
     * @return Array Retorna un array con todos los contratos asociados a un area
     */
    public function getContratosPorArea($idArea) {
        try {

            $serviceConexion = new Conexion();
            $cnx = $serviceConexion->conectar(); //link de conexion
            $sql = "SELECT * FROM contrato WHERE id_area='$idArea' ORDER BY contrato"; //query
            $rs = mysqli_query($cnx, $sql); //resultset
            $contratos = array(); //array para las areas

            while ($r = mysqli_fetch_array($rs)) {
                //seteando el objeto                
                $contrato = new Contrato();
                $contrato->setIdArea($r['id_area']);
                $contrato->setIdContrato($r['id_contrato']);
                $contrato->setIdEstadoContrato($r['id_estado_contrato']);
                $contrato->setContrato($r['contrato']);


                array_push($contratos, $contrato);    //llenando el array con las areas de la DB
            }

            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $contratos; //retornando el array 
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Método que obtiene un contrato segun una id
     * @param int $idContrato id del contrato a buscar
     * @return \ContratoArea Retorna un objeto con los datos del contrato y el area
     */
    public function getContratoPorId($idContrato) {
        try {

            $serviceConexion = new Conexion();
            $cnx = $serviceConexion->conectar(); //link de conexion
            $sql = "SELECT * FROM contrato c JOIN area a USING(id_area) WHERE c.id_contrato='$idContrato'"; //query
            $rs = mysqli_query($cnx, $sql); //resultset          

            while ($r = mysqli_fetch_array($rs)) {
                //seteando el objeto                
                $contrato = new Contrato();
                $contrato->setIdArea($r['id_area']);
                $contrato->setIdContrato($r['id_contrato']);
                $contrato->setIdEstadoContrato($r['id_estado_contrato']);
                $contrato->setContrato($r['contrato']);

                $area = new Area();
                $area->setIdArea($r['id_area']);
                $area->setArea($r['area']);

                $contratoArea = new ContratoArea();
                $contratoArea->setContrato($contrato);
                $contratoArea->setArea($area);
            }

            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $contratoArea; //retornando el array 
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
