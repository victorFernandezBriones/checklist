<?php

require_once '../../data/Checklist.php';
require_once '../../data/Contrato.php';
require_once '../../data/Producto.php';
require_once '../../data/Funciones.php';
require_once '../../data/Usuario.php';
require_once '../../data/Responsable.php';
require_once '../../data/Mail.php';

$sessionUsuario = new Usuario();
session_start();
$sessionUsuario = $_SESSION['usuario'];


$serviceChecklist = new Checklist();
$serviceContrato = new Contrato();
$serviceProducto = new Producto();
$serviceFunciones = new Funciones();
$serviceResponsable = new Responsable();
$serviceUsuario = new Usuario();
$serviceMail = new Mail();

if (isset($_POST)) :

    $fechaEnvio = $serviceFunciones->formatoFechaGuardarDB($_POST['fechaEnvio']);

    switch ($sessionUsuario->getIdTipoUsuario()):
        case 1://ADMINISTRADOR
            $contratos = $serviceContrato->getContratos(); //OBTENIENDO TODOS LOS CONTRATOS
            break;

        case 2://ENCARGADO CHECKLIST POR AREA
            $contratoArea = $serviceContrato->getContratoPorId($sessionUsuario->getIdContrato());
            $idArea = $contratoArea->getArea()->getIdArea(); //OBTENIENDO EL AREA DEL USUARIO
            $contratos = $serviceContrato->getContratosPorArea($idArea); //OBTENIENDO LOS CONTRATOS POR AREA

            break;

    endswitch;
//BANDERAS PARA ENVIAR MENSAJE DE ERROR O EXITO DE LA OPERACION
    $totalProductos = 0;
    $totalProductosIngresados = 0;
    //INGRESANDO CHECKLIST POR CONTRATOS...CONSULTANDO CON EL SISTEMA DE INVENTARIO
    $mensajeContratosConCheck = "";
    $mensajeContratosSinCheck = "";

    foreach ($contratos as $c) :

        //verificando si el contrato tiene Checklist activos
        $verChecklist = $serviceChecklist->verificarChecklistActivo($c->getContrato()->getIdContrato(), '');

        if ($c->getContrato()->getIdContrato() != 1 && $verChecklist == 0) {
            $mensajeContratosSinCheck.=$c->getContrato()->getContrato() . " --- ";
//            //INSTANCEANDO Y SETEANDO OBJETO
            $idChecklist = $serviceChecklist->getMaxIdChecklist() + 1;
            $checklist = new Checklist();
            $checklist->setIdChecklist($idChecklist);
            $checklist->setFechaEnvio($fechaEnvio);
            $checklist->setIdContrato($c->getContrato()->getIdContrato());
            $checklist->setIdEstadoChecklist(1); //ESTADO ACTIVO          

            if ($serviceChecklist->ingresarChecklist($checklist) == 1) {

                //BUSCANDO LOS PRODUCTOS ASOCIADOS AL CONTRATO PARA GENERAR EL CHECKLIST...DICHOS PRODUCTOS SE GUARDAN EN LA BASE DE DATOS DE ESTE SISTEMA
                $productos = $serviceProducto->getProductosActivosPorContrato($c->getContrato()->getIdContrato()); //consultando
                $totalProductos+=count($productos);
                //VERFICANDO QUE LA VARIABLE ESTE SETEADA Y NO ESTE VACIA
                if (isset($productos) && !empty($productos)) {
                    //recorriendo el array con productos. generando objetos y guardandolos en la tabla producto de la base de datos

                    foreach ($productos as $p) {
                        $p->setIdChecklist($idChecklist);
                        $p->getResponsable();

                        if ($p->getResponsable() != "") {
                            $p->getResponsable();
                            $responsable = $serviceResponsable->obtenerResponsablePorId($p->getResponsable());

                            $p->setResponsable($responsable);
                        }
                        $totalProductosIngresados+= $serviceProducto->ingresarProductosChecklist($p);
                    }
                }
            }

            $encargadoCheck = $serviceUsuario->getEncargadoChecklistPorContrato($c->getContrato()->getIdContrato());
            if ($encargadoCheck != "") {
                $correo = $encargadoCheck->getCorreo();
                //ENVIO DE MAIL AL USUARIO
                $titulo = "Generación de Checklist";
                $mensaje = $serviceMail->bodyMailCreacionChecklist($serviceFunciones->formatoFecha($fechaEnvio));

                $serviceMail->enviarMail($titulo, $mensaje, $correo);
            }
        } else {
            if ($c->getContrato()->getIdContrato() != 1) {
                $mensajeContratosConCheck .= $c->getContrato()->getContrato() . " --- "; //
            }
        }

    endforeach;


    $mensajeResultados = array('contratosConCheck' => $mensajeContratosConCheck, "contratosSinCheck" => $mensajeContratosSinCheck);
    echo json_encode($mensajeResultados);
    
endif;



