<?php

require_once 'data/Usuario.php';
require_once 'data/Log.php';
require_once 'data/Funciones.php';


if ($_POST) {

    $serviceUsuario = new Usuario();
    $serviceLog = new Log();
    $serviceFunciones = new Funciones();

    $nombreUsuario = htmlspecialchars($_POST['usuario']);
    $contrasena = md5(htmlspecialchars($_POST['contrasena']));
    
    $usuario = $serviceUsuario->verificarLogin($nombreUsuario, $contrasena);

    if ($usuario != NULL) {

        //GRABANDO ACCION EN EL LOG
        $log = new Log();
        $log->setAccion("Usuario inicio sesión");
        $log->setNombreUsuario($usuario->getNombre() . " " . $usuario->getApellidoP());
        $log->setIdUsuario($usuario->getIdUsuario());
        $log->setFechaAccion($serviceFunciones->obtenerFechaConHora());

        $serviceLog->ingresarLog($log);

        session_start();
        $_SESSION['usuario'] = $usuario;
        header("location:pa/inicio.php");
    } else {

        $error = "Error, usuario o contraseña incorrectas";
    }
}

