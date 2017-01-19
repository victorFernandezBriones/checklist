<?php

require_once '../../../data/Area.php';
require_once '../../../data/Usuario.php';
require_once '../../../data/Contrato.php';
require_once '../../../data/TipoUsuario.php';
require_once '../../../data/Mail.php';


//servicios
$serviceArea = new Area();
$serviceTipoUsuario = new TipoUsuario();
$serviceUsuario = new Usuario(); //servicio usuarios
$serviceMail = new Mail();
//cargando datos necesarios
$areas = $serviceArea->getAreas();
$tipoUsuarios = $serviceTipoUsuario->getTiposUsuarios();



if ($_POST) {

    $usuario = new Usuario();
    //atributos del objeto

    $nombre = ucwords(htmlspecialchars($_POST['nombre']));
    $apellidoP = ucwords(htmlspecialchars($_POST['apellidoP']));
    $apellidoM = ucwords(htmlspecialchars($_POST['apellidoM']));
    $correo = htmlspecialchars($_POST['correo']);
    $nombreUsuario = htmlspecialchars($_POST['nombreUsuario']);
    $contrasena = md5(htmlspecialchars($_POST['contrasena']));

    $idTipoUsuario = htmlspecialchars($_POST['idTipoUsuario']);
    $idContrato = htmlspecialchars($_POST['idContrato']);
    $idArea = htmlspecialchars($_POST['idArea']);
    $idUsuario = $serviceUsuario->getMaxIdUsuario() + 1;

    //seteando el objeto
    $usuario->setIdUsuario($idUsuario);
    $usuario->setNombre($nombre);
    $usuario->setApellidoP($apellidoP);
    $usuario->setApellidoM($apellidoM);
    $usuario->setCorreo($correo);
    $usuario->setNombreUsuario($nombreUsuario);
    $usuario->setContrasena($contrasena);
    $usuario->setIdContrato($idContrato);
    $usuario->setIdTipoUsuario($idTipoUsuario);
    $usuario->setIdEstadoUsuario(1);

    if ($serviceUsuario->ingresarUsuario($usuario) == 1) {
        //enviando mail
        $pass = htmlspecialchars($_POST['contrasena']);
        $titulo = "Cuenta usuario CheckList en línea";
        $serviceMail = new Mail();
        $mensaje = $serviceMail->bodyMailCreacionCuenta($nombreUsuario,$pass );
        $serviceMail->enviarMail($titulo, $mensaje, $correo);
        echo 1;
    }
}


