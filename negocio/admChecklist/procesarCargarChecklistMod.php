<?php

require_once '../../data/Checklist.php';
require_once '../../data/Contrato.php';
require_once '../../data/Usuario.php';
require_once '../../data/Funciones.php';
require_once '../../data/Producto.php';
require_once '../../data/Genero.php';
require_once '../../data/EstadoChecklist.php';

$sessionUsuario = new Usuario();
session_start();
$sessionUsuario = $_SESSION['usuario'];

$serviceChecklist = new Checklist();
$serviceFunciones = new Funciones();
$serviceProducto = new Producto();
$serviceGenero = new Genero();
$serviceEstadoCheck = new EstadoChecklist();

if (isset($_GET['idContratoModCheck'])):

    $idContrato = htmlspecialchars($_GET['idContratoModCheck']); //id del contrato
    $fechaChecklist = $serviceFunciones->formatoFechaGuardarDB($_GET['fechaChecklist']); //fecha de la consulta
    //objeto checklist obtenido en la busqueda
    $checklist = $serviceChecklist->getChecklistsPorContratoEstadoYFechas($idContrato, 0, $fechaChecklist);


    if (!empty($checklist)) ://verificando q el objeto no este vacio

        $idChecklist = $checklist->getIdChecklist();
        $generos = $serviceGenero->getGeneros();
        //CONTANDO PRODUCTOS Y CALCULANDO PORCENTAJE
        $totalProductos = $serviceProducto->contarProductosPorChecklist($idChecklist);
        $totalPChequeados = $serviceProducto->contarProductosChequeados($idChecklist);
        $porcCheck = ($totalPChequeados * 100) / $totalProductos;
        $porcCheck = number_format($porcCheck, 2, ",", ".");
        $estadoChecklist = $serviceEstadoCheck->getEstadoChecklistPorId($checklist->getIdEstadoChecklist());
        $estadosChecklist = $serviceEstadoCheck->getEstadosCheckist();


    endif;

endif;

if (isset($_POST['idEstadoCheck'])) :

    $idEstadoChecklist = htmlspecialchars($_POST['idEstadoCheck']);
    $idChecklist = htmlspecialchars($_POST['idChecklist']);
    echo $serviceChecklist->actualizarEstadoChecklist($idChecklist, $idEstadoChecklist);
    
    
endif;