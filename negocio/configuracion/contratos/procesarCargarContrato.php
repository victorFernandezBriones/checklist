<?php

require_once '../../../data/Contrato.php';
require_once '../../../data/Area.php';

$serviceContrato = new Contrato();
$serviceArea= new Area();

if ($_GET) {

    $idArea = htmlspecialchars($_GET['idArea']);
    $contratos = $serviceContrato->getContratosPorArea($idArea);
    $areas=$serviceArea->getAreas();
}
