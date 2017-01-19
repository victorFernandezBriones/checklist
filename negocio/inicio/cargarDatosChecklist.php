<?php

require_once '../data/Genero.php';
require_once '../data/Producto.php';
require_once '../data/Checklist.php';
require_once '../data/Usuario.php';
require_once '../data/Funciones.php';



$serviceGenero = new Genero();
$serviceProducto = new Producto();
$serviceChecklist = new Checklist();
$serviceFunciones = new Funciones();


$generos = $serviceGenero->getGeneros();
$checklist = $serviceChecklist->getChecklistsPorContratoYEstado($sessionUsuario->getIdContrato(), 1);

if (!empty($checklist)) {
    $totalProductos = $serviceProducto->contarProductosPorChecklist($checklist->getIdChecklist());
    $totalPChequeados = $serviceProducto->contarProductosChequeados($checklist->getIdChecklist());

    $porcChequeados = number_format(($totalPChequeados * 100) / $totalProductos, 2, ",", ".");
}


