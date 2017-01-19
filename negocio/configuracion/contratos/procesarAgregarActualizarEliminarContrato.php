<?php

require_once '../../../data/Area.php';
require_once '../../../data/Contrato.php';
require_once '../../../data/Funciones.php';

$serviceArea = new Area();
$serviceContrato = new Contrato();
$serviceFunciones = new Funciones();

$areas = $serviceArea->getAreas();
$contratos = $serviceContrato->getContratos();


if ($_POST) {

    $flag = htmlspecialchars($_POST['flag']);

    switch ($flag) {//ACCION SEGUN EL VALOR DEL LA FLAG
        case 1://AGREGAR CONTRATO

            $contrato = new Contrato();

            $idArea = htmlspecialchars($_POST['idArea']);
            $nombreContrato = ucwords(htmlspecialchars($_POST['nombreContrato']));

            $contrato->setContrato($nombreContrato);
            $contrato->setIdArea($idArea);

            echo $serviceContrato->ingresarContrato($contrato);

            break;

        case 2: //ACTUALIZAR CONTRATO

            $contratoActualizar = new Contrato();

            $idContrato = htmlspecialchars($_POST['idContrato']);
            $nombreContrato = ucwords(htmlspecialchars($_POST['nombreContrato']));
            $idArea = htmlspecialchars($_POST['idArea']);


            $contratoActualizar->setContrato($nombreContrato);
            $contratoActualizar->setIdArea($idArea);
            $contratoActualizar->setIdContrato($idContrato);

            echo $serviceContrato->actualizarContrato($contratoActualizar);

            break;


        case 3://ELIMINAR CONTRATO

            $idContrato = htmlspecialchars($_POST['idContrato']);
            echo $serviceContrato->eliminarContrato($idContrato);

            break;
    }
}

