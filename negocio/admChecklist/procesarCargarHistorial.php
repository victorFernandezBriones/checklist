<?php

require '../../data/Checklist.php';
require '../../data/EstadoChecklist.php';
require '../../data/Contrato.php';


$serviceChecklist = new Checklist();
$serviceFunciones = new Funciones();
$serviceEstadoCheck = new EstadoChecklist();
$serviceContrato = new Contrato();

if (isset($_GET['idContrato'])) :

    $idContrato = htmlspecialchars($_GET['idContrato']);

    $checklists = $serviceChecklist->getChecklistsPorContrato($idContrato);
    
endif;
