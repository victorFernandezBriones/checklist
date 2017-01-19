<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mail
 *
 * @author vfernandez
 */

class Mail {

    /**
     * 
     * @param String $titulo titulo del correo
     * @param String $mensaje Cuerpo o mensaje del correo
     * @param String $correo Direccion de destino del correo
     */
    public function enviarMail($titulo, $mensaje, $correo) {

        if (!is_object($mail)) {
            require_once('class.phpmailer.php');
            $mail = new PHPMailer;
        }

        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "mail.axioma.cl"; // SMTP a utilizar. Por ej. smtp.elserver.com
        $mail->Username = "sisaxioma@axioma.cl"; // Correo completo a utilizar
        $mail->Password = "%.2019Xx23"; // Contraseña
        $mail->Port = 587; // Puerto a utilizar
        $mail->From = "sisaxioma@axioma.cl"; // Desde donde enviamos (Para mostrar)
        $mail->FromName = "Sistema de Chequeo en Línea";
        $mail->AddAddress($correo); // Esta es la dirección a donde enviamos

        $mail->IsHTML(true); // El correo se envía como HTML
        $mail->Subject = $titulo; // Este es el titulo del email.
        $body = $mensaje;
        $mail->CharSet = 'UTF-8';
        $mail->Body = $body; // Mensaje a enviar
        $mail->AltBody = "";
        $mail->ContentType = "text/html";

        $mail->Send(); // Envía el correo.
    }

    /**
     * 
     * @param string $nombreUsuario nombre del usuario
     * @param String $contrasena Contraseña del usuario
     * @return string Devuelve el cuerpo del mensaje en formato html
     */
    public function bodyMailCreacionCuenta($nombreUsuario, $contrasena) {
        try {

            $tabla = "<h1><strong>Sistema de Chequeo en Línea</strong></h1>";
            $tabla.="<hr>";
            $tabla .= "<table>"
                    . "<tr>"
                    . "<td>"
                    . "Se informa que se ha creado una cuenta de usuario con las siguientes credenciales:"
                    . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>"
                    . "Nombre Usuario: <strong>" . $nombreUsuario . "</strong>"
                    . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>"
                    . "Contraseña: <strong>" . $contrasena . "</strong>"
                    . "</td>"
                    . "</tr>"
                    . "</table>";
            $tabla.="<hr>";
            $tabla.="<div style='width:50%'> <img alt='logoAxioma' src='http://consultoravial.cl/aplicaciones/boletasGarantia/media/logoAxiomaOficial.png'/>  </div>";

            return $tabla;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    
    /**
     * Método que genera el cuerpo del mail a enviar por la creación
     * @param type $fechaChecklist
     * @return string
     */
    public function bodyMailCreacionChecklist($fechaChecklist) {
        try {

            $tabla = "<h1><strong>Sistema de Chequeo en Línea</strong></h1>";
            $tabla.="<hr>";
            $tabla .= "<table>"
                    . "<tr>"
                    . "<td>"
                    . "Se informa que se ha creado un checklist con fecha ".$fechaChecklist
                    . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>"
                    . "Por favor, completarlo a la brevedad."
                    . "</td>"
                    . "</tr>"                    
                    . "</table>";
            $tabla.="<hr>";
            $tabla.="<div style='width:50%'> <img alt='logoAxioma' src='http://consultoravial.cl/aplicaciones/boletasGarantia/media/logoAxiomaOficial.png'/>  </div>";

            return $tabla;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

}
