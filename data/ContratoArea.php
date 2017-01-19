<?php

/**
 * Description of ContratoArea
 *
 * @author vfernandez
 */


class ContratoArea {
    //put your code here
    private $contrato;
    private $area;
    
    public function __construct() {
        
    }
    
    function getContrato() {
        return $this->contrato;
    }

    function getArea() {
        return $this->area;
    }

    function setContrato($contrato) {
        $this->contrato = $contrato;
    }

    function setArea($area) {
        $this->area = $area;
    }


}
