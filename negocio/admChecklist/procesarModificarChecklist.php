<?php

require_once '../../data/Checklist.php';
require_once '../../data/Contrato.php';
require_once '../../data/Usuario.php';

$sessionUsuario = new Usuario();
session_start();
$sessionUsuario = $_SESSION['usuario'];

$serviceContrato = new Contrato();


switch ($sessionUsuario->getIdTipoUsuario()):
    case 1: //ADMINISTRADOR
        $contratos = $serviceContrato->getContratos(); //TODOS LOS CONTRATOS

        break;

    case 2://ENCARGADO CHECKLIST, VE TODOS LOS CONTRATOS DEL AREA
        $contratoArea = $serviceContrato->getContratoPorId($sessionUsuario->getIdContrato());
        $contratos = $serviceContrato->getContratosPorArea($contratoArea->getArea()->getIdArea());

        break;


endswitch;


