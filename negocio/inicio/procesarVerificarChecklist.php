<?php

require_once '../../data/Genero.php';
require_once '../../data/Producto.php';
require_once '../../data/Checklist.php';
require_once '../../data/Usuario.php';

$sessionUsuario = new Usuario();
session_start();
$sessionUsuario = $_SESSION['usuario'];

$serviceGenero = new Genero();
$serviceProducto = new Producto();
$serviceChecklist = new Checklist();



if (isset($_GET['nombreContrato'])):

    $idChecklist = htmlspecialchars($_GET['idChecklist']);
    $nombreContrato = htmlspecialchars($_GET['nombreContrato']);

    $generos = $serviceGenero->getGeneros();
    $totalProductos = $serviceProducto->contarProductosPorChecklist($idChecklist);
    $totalPChequeados = $serviceProducto->contarProductosChequeados($idChecklist);
    $porcCheck = number_format(($totalPChequeados * 100) / $totalProductos, 2, ",", ".");

endif;

if (isset($_POST['idChecklist'])) :

    $idChecklist = htmlspecialchars($_POST['idChecklist']);

    echo $serviceChecklist->actualizarEstadoChecklist($idChecklist, 3);

endif;

if (isset($_POST['comentarioFinal'])) :

    $comentarioFinal = trim(htmlspecialchars($_POST['comentarioFinal']));
    $idProducto = htmlspecialchars($_POST['idProducto']);

    echo $serviceProducto->actualizarProducto($idProducto, $comentarioFinal, 3);

endif;

if (isset($_POST['responsable'])) :

    $responsable = trim(ucwords(htmlspecialchars($_POST['responsable'])));
    $idProducto = htmlspecialchars($_POST['idProducto']);

    echo $serviceProducto->actualizarProducto($idProducto, $responsable, 4);
    
endif;