<?php

require_once '../../data/Producto.php';
require_once '../../data/Checklist.php';

$serviceProducto = new Producto();
$serviceChecklist = new Checklist();

if (isset($_POST['flag'])) :

    $flag = htmlspecialchars($_POST['flag']);

    switch ($flag) {
        case 1://AGREGAR COMENTARIO

            $idProducto = htmlspecialchars($_POST['idProducto']);
            $comentario = htmlspecialchars($_POST['comentarioCheck']);

            echo $serviceProducto->actualizarProducto($idProducto, $comentario, 1); //flag para agregar comentario
            break;

        case 2://CAMBIAR CHEQUEO
            $idProducto = htmlspecialchars($_POST['idProducto']);
            $chequeo = htmlspecialchars($_POST['chequeo']);

            echo $serviceProducto->actualizarProducto($idProducto, $chequeo, 2);
            break;

        case 3: //CAMBIAR ESTADO CHECKLIST

            $idChecklist = htmlspecialchars($_POST['idChecklist']);
            echo $serviceChecklist->actualizarEstadoChecklist($idChecklist, 2); //CAMBIANDO ESTADO DE ENVIADO A CHEQUEADO !
            break;
    }
    
endif;
