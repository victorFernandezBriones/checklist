<?php

require_once '../../../data/Usuario.php';
require_once '../../../data/Contrato.php';

$usuarioSession = new Usuario();
session_start();
$usuarioSession = $_SESSION['usuario'];
$serviceUsuario = new Usuario();
$serviceContrato= new Contrato();
$contrato = $serviceContrato->getContratoPorId($usuarioSession->getIdContrato());

if ($_POST) {

    $flag = htmlspecialchars($_POST['flag']);

    switch ($flag) {

        case 1://ACTUALIZAR PERFIL
            $idUsuario = htmlspecialchars($_POST['idUsuario']);
            $nombre = htmlspecialchars($_POST['nombre']);
            $apellidoP = htmlspecialchars($_POST['apellidoP']);
            $apellidoM = htmlspecialchars($_POST['apellidoM']);
            $correo = htmlspecialchars($_POST['correo']);



            //INSTANCEANDO Y SETEANDO OBJETO
            $usuario = new Usuario();
            $usuario->setIdUsuario($idUsuario);
            $usuario->setNombre($nombre);
            $usuario->setApellidoP($apellidoP);
            $usuario->setApellidoM($apellidoM);
            $usuario->setCorreo($correo);

            //actualizar usuario
            echo $serviceUsuario->actualizarUsuario($usuario, 2);
            $_SESSION['usuario'] = $serviceUsuario->getUsuarioPorId($usuarioSession->getIdUsuario()); //actualizando el usuario en la session

            break;

        case 2://CAMBIAR CONTRASEÑA

            $idUsuario = htmlspecialchars($_POST['idUsuario']);
            $contrasena = md5(htmlspecialchars($_POST['contrasena']));

            $usuario = new Usuario();
            $usuario->setIdUsuario($idUsuario);
            $usuario->setContrasena($contrasena);

            echo $serviceUsuario->actualizarUsuario($usuario, 3);
            break;
    }
}