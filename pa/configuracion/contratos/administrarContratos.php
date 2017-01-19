<?php require_once '../../../negocio/configuracion/contratos/procesarAgregarActualizarEliminarContrato.php'; ?>
<div class="row">
    <div class="col-sm-12">        
        <ol class="breadcrumb pull-right">
            <li ><a href="#inicio" onclick="cargarInicio()" class="principal">Sistema de Chequeo En l&iacute;nea</a></li>
            <li class="active">Mantenedor</li>
            <li class="active">Administrar Contratos</li>
        </ol>
    </div>
</div>
<!--CONTRATOS -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="panel panel-default sombraPanel">
            <div class="panel-heading colorAxioma">
                <h2 class="text-center color-principal blanco">Ingresar Contrato</h2>
            </div>
            <div class="panel-body paddingBottom text-center">
                <form id="formIngresarContrato" class="form-inline"> 
                    <div class="form-group">
                        <label for="nombreContrato">Nombre Contrato: </label>
                        <input type="text" class="form-control" id="nombreContrato" name="nombreContrato" placeholder="Ingrese Contrato">
                    </div>                   
                    <div class="form-group">
                        <label for="idArea">&Aacute;rea: </label>
                        <select id="idArea" name="idArea" class="form-control ">
                            <option value="">Seleccione &Aacute;rea</option>
                            <?php
                            if (isset($areas)):
                                foreach ($areas as $a) :
                                    ?>
                                    <option value="<?php echo $a->getIdArea(); ?>"><?php echo $a->getArea(); ?></option>
                                    <?php
                                endforeach;
                            endif;
                            ?>

                        </select> 
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" id="btnIngresarContrato" name="btnIngresarContrato" value="Ingresar Contrato">
                    </div>
                </form>
                <div class="row">
                    <br/>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
                        <div class="alert alert-success noDisplay mensajeExito">
                            <label><i class="fa fa-fw fa-briefcase"></i> Contrato Agregado exitosamente</label>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <br/>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
                        <div class="alert alert-danger noDisplay  mensajeError">
                            <label><i class="fa fa-fw fa-warning"></i> Error, no se pudo agregar el contrato</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="panel panel-default sombraPanel">
            <div class="panel-heading colorAxioma">
                <h2 class="text-center color-principal blanco">Actualizar / Eliminar Contrato</h2>
            </div>
            <div class="panel-body paddingBottom">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4">
                        <select id="idAreaBuscar" name="idAreaBuscar" class="form-control ">
                            <option value="">Seleccione &Aacute;rea</option>
                            <?php
                            if (isset($areas)):
                                foreach ($areas as $a) :
                                    ?>
                                    <option value="<?php echo $a->getIdArea(); ?>"><?php echo $a->getArea(); ?></option>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </select> 
                    </div>
                </div>              
                <div class="row">
                    <div id="divContratoAjax" class="table-responsive col-xs-12 col-sm-12 col-md-12 paddingTop">

                    </div>  
                </div>
            </div>
        </div>
    </div>    
</div>
<!-- FIN CONTRATOS -->

