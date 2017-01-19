<?php

/**
 * Description of Producto
 *
 * @author vfernandez
 */
require_once 'ConexionPostgres.php';
require_once 'Conexion.php';

class Producto {

    private $idProducto;
    private $codProductoInventario;
    private $descripcion;
    private $numBien;
    private $annio;
    private $cantidad;
    private $comentarios;
    private $comentarioCheck;
    private $comentarioFinal;
    private $chequeado;
    private $idGenero;
    private $responsable;
    private $idChecklist;
    private $idEstadoProducto;

    public function __construct() {
        
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getNumBien() {
        return $this->numBien;
    }

    function getAnnio() {
        return $this->annio;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getComentarios() {
        return $this->comentarios;
    }

    function getIdGenero() {
        return $this->idGenero;
    }

    function getResponsable() {
        return $this->responsable;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setNumBien($numBien) {
        $this->numBien = $numBien;
    }

    function setAnnio($annio) {
        $this->annio = $annio;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setComentarios($comentarios) {
        $this->comentarios = $comentarios;
    }

    function setIdGenero($idGenero) {
        $this->idGenero = $idGenero;
    }

    function setResponsable($responsable) {
        $this->responsable = $responsable;
    }

    function getIdChecklist() {
        return $this->idChecklist;
    }

    function setIdChecklist($idChecklist) {
        $this->idChecklist = $idChecklist;
    }

    function getChequeado() {
        return $this->chequeado;
    }

    function setChequeado($chequeado) {
        $this->chequeado = $chequeado;
    }

    function getIdEstadoProducto() {
        return $this->idEstadoProducto;
    }

    function setIdEstadoProducto($idEstadoProducto) {
        $this->idEstadoProducto = $idEstadoProducto;
    }

    function getComentarioCheck() {
        return $this->comentarioCheck;
    }

    function setComentarioCheck($comentarioCheck) {
        $this->comentarioCheck = $comentarioCheck;
    }

    function getComentarioFinal() {
        return $this->comentarioFinal;
    }

    function setComentarioFinal($comentarioFinal) {
        $this->comentarioFinal = $comentarioFinal;
    }

    
    function getCodProductoInventario() {
        return $this->codProductoInventario;
    }

    function setCodProductoInventario($codProductoInventario) {
        $this->codProductoInventario = $codProductoInventario;
    }

        
    
    //********************************************//
    //           SISTEMA DE INVENTARIO           //
    //******************************************//

    /**
     * Método que obtiene todos los productos activos asociados a un contrato y a un genero
     * @param int $idContrato id del contrato a consultar
     * @param int $idGenero id del genero de los bienes (utilizado para agrupar)
     * @return array Retorna un array con los resultados
     */
    public function getProductosActivosPorContrato($idContrato) {
        try {
            $serviceConexion = new ConexionPostgres(); //Servicio de la conexion
            $cnx = $serviceConexion->conectar(); //link de la conexion
            $sql = "SELECT b.cod_bien,b.modelo,m.nom_marca,t.nom_tipo,num_bien,b.annio,b.cantidad,b.caracteristicas, "
                    . "g.cod_genero,h.id_responsable FROM bienes b, historial h, areas a, contratos c,"
                    . "marcas m, estados e,tipos t,generos g WHERE b.num_serie=h.id_numserie AND h.ultimo=1 "
                    . "AND h.id_area=a.cod_area AND h.id_contrato=c.cod_contrato AND b.id_estado=e.cod_estado AND b.id_marca=m.cod_marca "
                    . "AND b.id_propietario = '10' AND b.id_estado='2' AND h.id_area='1' "
                    . "AND h.id_contrato='$idContrato' AND t.cod_tipo=b.id_tipo AND b.id_genero = g.cod_genero";


            $productos = array(); //array para almacenar los resultados
            $rs = pg_query($cnx, $sql); //resultset de la query

            while ($r = pg_fetch_array($rs)) {//obteniendo resultados
                //instanceando y seteando objeto
                $producto = new Producto();

                $producto->setDescripcion($r['nom_tipo'] . " " . $r['nom_marca'] . " " . $r['modelo']);
                $producto->setNumBien($r['num_bien']);
                $producto->setAnnio($r['annio']);
                $producto->setCantidad($r['cantidad']);
                $producto->setComentarios($r['caracteristicas']);
                $producto->setIdGenero($r['cod_genero']);
                $producto->setResponsable($r['id_responsable']);
                $producto->setCodProductoInventario($r['cod_bien']);
                //guardando resultado en el array
                array_push($productos, $producto);
            }

            //liberando recursos
            pg_free_result($rs);
            pg_close($cnx);

            return $productos;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    //************************************************//
    //              SISTEMA CHECKLIST                //
    //**********************************************//
    /**
     * Método que inserta un registro en la tabla producto
     * @param Producto $producto objeto con los atributos a guardar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function ingresarProductosChecklist($producto) {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "INSERT INTO producto(cod_producto_inventario,descripcion,serie,annio,cantidad,comentarios,chequeado,responsable,"
                    . "id_genero,id_checklist,id_estado_producto) "
                    . "VALUES('" . $producto->getCodProductoInventario() . "','" . $producto->getDescripcion() . "','" . $producto->getNumBien() . "','" . $producto->getAnnio() . "','" . $producto->getCantidad() . "',"
                    . "'" . $producto->getComentarios() . "',-1,'" . $producto->getResponsable() . "','" . $producto->getIdGenero() . "',"
                    . "'" . $producto->getIdChecklist() . "','1')"; //query

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //asignando flag segun resultado de la operacion
            //liberando recursos
            mysqli_close($cnx);

            return $exito; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

    /**
     * Método que obtiene todos los productos asociados a un checklist
     * @param int $idChecklist id del checklist
     * @return array Retorna un array con los resultados
     */
    public function getProductosPorGeneroYChecklist($idChecklist, $idGenero) {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT * FROM producto WHERE id_checklist='$idChecklist' AND id_genero='$idGenero'"; //query
            $rs = mysqli_query($cnx, $sql);
            $productos = array();

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO OBJETOS
                $producto = new Producto();
                $producto->setDescripcion($r['descripcion']);
                $producto->setNumBien($r['serie']);
                $producto->setAnnio($r['annio']);
                $producto->setCantidad($r['cantidad']);
                $producto->setComentarios($r['comentarios']);
                $producto->setComentarioCheck($r['comentario_check']);
                $producto->setComentarioFinal($r['comentario_final']);
                $producto->setResponsable($r['responsable']);
                $producto->setIdChecklist($r['id_checklist']);
                $producto->setIdGenero($r['id_genero']);
                $producto->setChequeado($r['chequeado']);
                $producto->setIdEstadoProducto($r['id_estado_producto']);
                $producto->setIdProducto($r['id_producto']);
                $producto->setCodProductoInventario($r['cod_producto_inventario']);

                array_push($productos, $producto); //ingresado objetos al array
            }
            //liberando recursos
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $productos; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

    /**
     * Método que cuenta el total de productos asociados a un checklist
     * @param int $idChecklist id del checklist
     * @return int retorna la cantidad de objetos asociados a un checklist
     */
    public function contarProductosPorChecklist($idChecklist) {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT * FROM producto WHERE id_checklist='$idChecklist'"; //query

            $rs = mysqli_query($cnx, $sql);
            $totalProductos = mysqli_num_rows($rs);


            //liberando recursos
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $totalProductos; //retornando resultado           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

    /**
     * Método que actualiza comentarios, chequeo y estado del producto
     * @param int $idProducto id del producto a actualizar
     * @param int $atributoActualizar atributo que se actualizará
     * @param int $flag flag para identificar el atributo a actualizar
     * @return int Retorna 1 si la operación es correcta, -1 si no lo es
     */
    public function actualizarProducto($idProducto, $atributoActualizar, $flag) {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            switch ($flag) {
                case 1://ACTUALIZAR COMENTARIO_CHECK DEL PRODUCTO
                    $sql = "UPDATE producto SET comentario_check='$atributoActualizar' WHERE id_producto='$idProducto'"; //query

                    break;

                case 2: //ACTUALIZAR ESTADO CHEQUEADO

                    $sql = "UPDATE producto SET chequeado='$atributoActualizar' WHERE id_producto='$idProducto'"; //query

                    break;

                case 3://ACTUALIZAR COMENTARIO FINAL
                    $sql = "UPDATE producto SET comentario_final='$atributoActualizar' WHERE id_producto='$idProducto'"; //query
                    break;

                case 4://MODIFICAR RESPONSABLE
                    $sql = "UPDATE producto SET responsable='$atributoActualizar' WHERE id_producto='$idProducto'"; //query
                    break;
            }


            $exito = mysqli_query($cnx, $sql);

            //liberando recursos
            mysqli_close($cnx);

            return $exito; //retornando resultado           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

    /**
     * Método que obtiene el número de productos chequeados 
     * @param int $idChecklist id del checklist que contiene los productos
     * @return int Retorna el total de elementos chequeados
     */
    public function contarProductosChequeados($idChecklist) {
        try {
            $serviceCnx = new Conexion(); //servicio de la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT id_producto FROM producto "
                    . "WHERE chequeado =1 AND id_checklist='$idChecklist'"; //query

            $rs = mysqli_query($cnx, $sql);
            $totalChequeados = mysqli_num_rows($rs);
            //liberando recursos
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $totalChequeados == "" ? 0 : $totalChequeados; //retornando resultado           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString(); //mensaje de excepcion
        }
    }

}
