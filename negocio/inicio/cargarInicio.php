<?php

require_once '../data/Usuario.php';
require_once '../data/TipoUsuario.php';
require_once '../data/Contrato.php';
require_once '../data/Checklist.php';
require_once '../data/Funciones.php';
require_once '../data/EstadoChecklist.php';

$sessionUsuario = new Usuario();
session_start();
$sessionUsuario = $_SESSION['usuario'];

$serviceTipoUsuario = new TipoUsuario();
$serviceContrato = new Contrato();
$serviceChecklist = new Checklist();
$serviceFunciones = new Funciones();
$serviceEstadoCheck = new EstadoChecklist();


$tipoUsuario = $serviceTipoUsuario->getTipoUsuarioPorId($sessionUsuario->getIdTipoUsuario());

//carga de contratos segun usuario
switch ($sessionUsuario->getIdTipoUsuario()) {

    case 1: //ADMINISTRADOR
        $contratos = $serviceContrato->getContratos(); //TODOS LOS CONTRATOS

        break;

    case 2://ENCARGADO CHECKLIST, VE TODOS LOS CONTRATOS DEL AREA
        $contratoArea = $serviceContrato->getContratoPorId($sessionUsuario->getIdContrato());
        $contratos = $serviceContrato->getContratosPorArea($contratoArea->getArea()->getIdArea());

        break;
}



