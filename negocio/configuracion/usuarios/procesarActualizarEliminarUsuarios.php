<?php

require_once '../../../data/Usuario.php';
require_once '../../../data/TipoUsuario.php';
require_once '../../../data/EstadoUsuario.php';

//servicios
$serviceUsuario = new Usuario();
$serviceTipoUsuario = new TipoUsuario();

$serviceEstadoUsuario = new EstadoUsuario();
//cargando datos necesarios
$usuarios = $serviceUsuario->getUsuarios();
$tiposUsuarios = $serviceTipoUsuario->getTiposUsuarios();
$estados = $serviceEstadoUsuario->getEstados();

if ($_POST) {

    $flag = htmlspecialchars($_POST['flag']);
    $idUsuario = htmlspecialchars($_POST['idUsuario']);

    switch ($flag) {

        case 1://Actualizar Usuarios
            
            $idUsuario = htmlspecialchars($_POST['idUsuario']);
            $nombre = htmlspecialchars($_POST['nombre']);
            $apellidoP = htmlspecialchars($_POST['apellidoP']);
            $apellidoM = htmlspecialchars($_POST['apellidoM']);            
            $idTipoUsuario = htmlspecialchars($_POST['idTipoUsuario']);
            $idEstado = htmlspecialchars($_POST['idEstado']);

            $usuario = new Usuario();
            $usuario->setIdUsuario($idUsuario);
            $usuario->setNombre($nombre);
            $usuario->setApellidoP($apellidoP);
            $usuario->setApellidoM($apellidoM);           
            $usuario->setIdTipoUsuario($idTipoUsuario);
            $usuario->setIdEstadoUsuario($idEstado);

            echo $serviceUsuario->actualizarUsuario($usuario,1);


            break;

        case 2://Eliminar Usuarios

            echo $serviceUsuario->eliminarUsuarioPorId($idUsuario);

            break;
    }
}
