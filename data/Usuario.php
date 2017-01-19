<?php

/**
 * Description of Usuario
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class Usuario {

    //ATRIBUTOS
    private $idUsuario;
    private $nombre;
    private $apellidoP;
    private $apellidoM;
    private $correo;
    private $nombreUsuario;
    private $contrasena;
    private $idTipoUsuario;
    private $idContrato;
    private $idEstadoUsuario;

    public function __construct() {
        
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidoP() {
        return $this->apellidoP;
    }

    function getApellidoM() {
        return $this->apellidoM;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    function getContrasena() {
        return $this->contrasena;
    }

    function getIdTipoUsuario() {
        return $this->idTipoUsuario;
    }

    function getIdContrato() {
        return $this->idContrato;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidoP($apellidoP) {
        $this->apellidoP = $apellidoP;
    }

    function setApellidoM($apellidoM) {
        $this->apellidoM = $apellidoM;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    function setIdTipoUsuario($idTipoUsuario) {
        $this->idTipoUsuario = $idTipoUsuario;
    }

    function setIdContrato($idContrato) {
        $this->idContrato = $idContrato;
    }

    function getIdEstadoUsuario() {
        return $this->idEstadoUsuario;
    }

    function setIdEstadoUsuario($idEstadoUsuario) {
        $this->idEstadoUsuario = $idEstadoUsuario;
    }

    //-----------------------------//
    //          METODOS           //
    //---------------------------//

    /**
     * Método que obtiene todos los usuarios del sistema
     * @return Array Metodo que devuele un array con todos los usuario de la base de datos
     */
    public function getUsuarios() {
        try {
            $serviceConexion = new Conexion();
            $cnx = $serviceConexion->conectar(); //link de conexion
            $sql = "SELECT * FROM usuario"; //query
            $rs = mysqli_query($cnx, $sql); //resultset
            $usuarios = array(); //array para los usuarios

            while ($r = mysqli_fetch_array($rs)) {
                //seteando el objeto                
                $usuario = new Usuario();
                $usuario->setIdUsuario($r['id_usuario']);
                $usuario->setNombre($r['nombre']);
                $usuario->setApellidoP($r['apellido_p']);
                $usuario->setApellidoM($r['apellido_m']);
                $usuario->setCorreo($r['correo']);
                $usuario->setNombreUsuario($r['nombre_usuario']);
                $usuario->setContrasena($r['contrasena']);
                $usuario->setIdTipoUsuario($r['id_tipo_usuario']);
                $usuario->setIdContrato($r['id_contrato']);
                $usuario->setIdEstadoUsuario($r['id_estado_usuario']);

                array_push($usuarios, $usuario); //llenando el array con los usuarios de la db                
            }

            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $usuarios; //retornando el array            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Método que obtiene el id max de la tabla usuario
     * @return int id maximo de la tabla
     */
    public function getMaxIdUsuario() {
        try {
            $serviceConexion = new Conexion();
            $cnx = $serviceConexion->conectar(); //link de conexion
            $sql = "SELECT MAX(id_usuario) as max FROM usuario"; //query
            $rs = mysqli_query($cnx, $sql); //resultset

            $idUsuario = "";
            while ($r = mysqli_fetch_array($rs)) {
                //seteando el objeto                
                $idUsuario = $r['max'];
            }

            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $idUsuario; //retornando el array            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Método que obtiene todos los usuarios asociados a un contrato
     * @param int $idContrato id del contrato a consultar
     * @return array Retorna un array con los usuario obtenidos segun el parametro ingresado
     */
    public function getUsuariosPorContrato($idContrato) {
        try {
            $serviceConexion = new Conexion();
            $cnx = $serviceConexion->conectar(); //link de conexion
            $sql = "SELECT * FROM usuario WHERE id_Contrato='$idContrato'"; //query
            $rs = mysqli_query($cnx, $sql); //resultset
            $usuarios = array(); //array para los usuarios

            while ($r = mysqli_fetch_array($rs)) {
                //seteando el objeto                
                $usuario = new Usuario();
                $usuario->setIdUsuario($r['id_usuario']);
                $usuario->setNombre($r['nombre']);
                $usuario->setApellidoP($r['apellido_p']);
                $usuario->setApellidoM($r['apellido_m']);
                $usuario->setCorreo($r['correo']);
                $usuario->setNombreUsuario($r['nombre_usuario']);
                $usuario->setContrasena($r['contrasena']);
                $usuario->setIdTipoUsuario($r['id_tipo_usuario']);
                $usuario->setIdContrato($r['id_contrato']);
                $usuario->setIdEstadoUsuario($r['id_estado_usuario']);

                array_push($usuarios, $usuario); //llenando el array con los usuarios por contrato               
            }

            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $usuarios; //retornando el array            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getEncargadoChecklistPorContrato($idContrato) {
        try {
            $serviceConexion = new Conexion();
            $cnx = $serviceConexion->conectar(); //link de conexion
            $sql = "SELECT * FROM usuario WHERE id_Contrato='$idContrato' "
                    . "AND id_tipo_usuario=3"; //query
            $rs = mysqli_query($cnx, $sql); //resultset
            $usuario = "";
            if (mysqli_num_rows($rs) > 0) {
                while ($r = mysqli_fetch_array($rs)) {
                    //seteando el objeto                
                    $usuario = new Usuario();
                    $usuario->setIdUsuario($r['id_usuario']);
                    $usuario->setNombre($r['nombre']);
                    $usuario->setApellidoP($r['apellido_p']);
                    $usuario->setApellidoM($r['apellido_m']);
                    $usuario->setCorreo($r['correo']);
                    $usuario->setNombreUsuario($r['nombre_usuario']);
                    $usuario->setContrasena($r['contrasena']);
                    $usuario->setIdTipoUsuario($r['id_tipo_usuario']);
                    $usuario->setIdContrato($r['id_contrato']);
                    $usuario->setIdEstadoUsuario($r['id_estado_usuario']);
                }
            }


            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $usuario; //retornando el array            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Método que obtiene un usuario segun su ID
     * @param int $idUsuario id del usuario
     * @return Usuario Retorna un obj tipo usuario de acuerdo al parametro ingresado
     */
    public function getUsuarioPorId($idUsuario) {
        try {
            $serviceConexion = new Conexion();
            $cnx = $serviceConexion->conectar(); //link de conexion
            $sql = "SELECT * FROM usuario WHERE id_usuario='$idUsuario'"; //query
            $rs = mysqli_query($cnx, $sql); //resultset

            $usuario = null;
            while ($r = mysqli_fetch_array($rs)) {
                //seteando el objeto                
                $usuario = new Usuario();
                $usuario->setIdUsuario($r['id_usuario']);
                $usuario->setNombre($r['nombre']);
                $usuario->setApellidoP($r['apellido_p']);
                $usuario->setApellidoM($r['apellido_m']);
                $usuario->setCorreo($r['correo']);
                $usuario->setNombreUsuario($r['nombre_usuario']);
                $usuario->setContrasena($r['contrasena']);
                $usuario->setIdTipoUsuario($r['id_tipo_usuario']);
                $usuario->setIdContrato($r['id_contrato']);
                $usuario->setIdEstadoUsuario($r['id_estado_usuario']);
            }

            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $usuario; //retornando el array    
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Método que verifica el login de un usuario
     * @param String $nombreUsuario nombre del usuario
     * @param String $contrasena Contraseña del usuario
     * @return \Usuario Retorna un objeto con los resultados
     */
    public function verificarLogin($nombreUsuario, $contrasena) {
        try {

            $serviceConexion = new Conexion();
            $cnx = $serviceConexion->conectar(); //link de conexion
            $sql = "SELECT * FROM usuario WHERE nombre_usuario='$nombreUsuario' AND contrasena='$contrasena' AND id_estado_usuario=1"; //query
            $rs = mysqli_query($cnx, $sql); //resultset
            $usuario = "";
            while ($r = mysqli_fetch_array($rs)) {
                //seteando el objeto                
                $usuario = new Usuario();
                $usuario->setIdUsuario($r['id_usuario']);
                $usuario->setNombre($r['nombre']);
                $usuario->setApellidoP($r['apellido_p']);
                $usuario->setApellidoM($r['apellido_m']);
                $usuario->setCorreo($r['correo']);
                $usuario->setNombreUsuario($r['nombre_usuario']);
                $usuario->setContrasena($r['contrasena']);
                $usuario->setIdTipoUsuario($r['id_tipo_usuario']);
                $usuario->setIdContrato($r['id_contrato']);
                $usuario->setIdEstadoUsuario($r['id_estado_usuario']);
            }

            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $usuario; //retornando el objeto         
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Método que elimina un usuario segun su ID
     * @param int $idUsuario id del usuario
     * @return int Retorna un 1 si la operacion es correcta, -1 si no lo es
     */
    public function eliminarUsuarioPorId($idUsuario) {
        try {

            $serviceConexion = new Conexion();
            $cnx = $serviceConexion->conectar(); //link de conexion
            $sqlTablaDependiente = "DELETE FROM usuario_subcontrato WHERE id_usuario='$idUsuario'"; //query para eliminar la tabla Usuario_subcontrato

            mysqli_query($cnx, $sqlTablaDependiente); //si se pudo eliminar los registros de la tabla dependiente entonces se borra al usuario
            $sql = "DELETE FROM usuario WHERE id_usuario='$idUsuario'"; //query
            $exito = mysqli_query($cnx, $sql) == true ? 1 : -1; //resultado de la query, asignando valor a la bandera         
            //liberando recursos          
            mysqli_close($cnx);

            return $exito; //retornando la flag  
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Método que actualiza un registro en la tabla usuario
     * @param Objeto $usuario Objeto con todos los atributos del usuario
     * @return int Retorna un 1 si la operacion es correcta, -1 si no lo es
     */
    public function actualizarUsuario($usuario, $flag) {
        try {

            $serviceConexion = new Conexion();
            $cnx = $serviceConexion->conectar(); //link de conexion
            switch ($flag) {
                case 1://ACTUALIZAR USUARIO MODULO ADMIN
                    $sql = "UPDATE usuario SET nombre='" . $usuario->getNombre() . "',apellido_p='" . $usuario->getApellidoP() . "', apellido_m='" . $usuario->getApellidoM() . "',"
                            . "id_tipo_usuario='" . $usuario->getIdTipoUsuario() . "',id_estado_usuario='" . $usuario->getIdEstadoUsuario() . "' WHERE id_usuario='" . $usuario->getIdUsuario() . "'  "; //query

                    break;

                case 2://ADMINISTRAR PERFIL
                    $sql = "UPDATE usuario SET nombre='" . $usuario->getNombre() . "',apellido_p='" . $usuario->getApellidoP() . "', apellido_m='" . $usuario->getApellidoM() . "',"
                            . "correo='" . $usuario->getCorreo() . "' WHERE id_usuario='" . $usuario->getIdUsuario() . "'  "; //query
                    break;

                case 3://ACTUALIZAR CONTRASEÑA
                    $sql = "UPDATE usuario SET contrasena='" . $usuario->getContrasena() . "' WHERE id_usuario='" . $usuario->getIdUsuario() . "'";
                    break;
            }

            $rs = mysqli_query($cnx, $sql); //resultset

            $exito = -1; //variable que indica si la accion se ejecuto correctamente

            if ($rs) { //si el resulset es true entonces se devuelve un 1, sino se mantiene el -1 anterior               
                $exito = 1;
            }

            //liberando recursos

            mysqli_close($cnx);

            return $exito; //retornando la flag  
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * 
     * @param Objetivo $usuario Objeto con los atributos a insertar en la BD
     * @return int Retorna un 1 si la operacion es correcta, -1 si no lo es
     */
    public function ingresarUsuario($usuario) {
        try {

            $serviceConexion = new Conexion();
            $cnx = $serviceConexion->conectar(); //link de conexion
            $sql = "INSERT INTO usuario(id_usuario,nombre,apellido_p,apellido_m,correo,nombre_usuario,contrasena,id_tipo_usuario,id_contrato,id_estado_usuario) "
                    . "VALUES('" . $usuario->getIdUsuario() . "','" . $usuario->getNombre() . "','" . $usuario->getApellidoP() . "','" . $usuario->getApellidoM() . "','" . $usuario->getCorreo() . "','"
                    . "" . $usuario->getNombreUsuario() . "','" . $usuario->getContrasena() . "','" . $usuario->getIdTipoUsuario() . "','" . $usuario->getIdContrato() . "',"
                    . "" . $usuario->getIdEstadoUsuario() . ")";



            $exito = -1; //variable que indica si la accion se ejecuto correctamente

            if (mysqli_query($cnx, $sql)) { //si el resulset es true entonces se devuelve un 1, sino se mantiene el -1 anterior               
                $exito = 1;
            }

            //liberando recursos           
            mysqli_close($cnx);

            return $exito; //retornando la flag  
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
