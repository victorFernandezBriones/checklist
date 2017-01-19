<?php require_once '../../../negocio/configuracion/usuarios/procesarIngresarUsuario.php'; ?>
<div class="row">
    <div class="col-sm-12">        
        <ol class="breadcrumb pull-right">
            <li ><a href="#inicio" onclick="cargarInicio()" class="principal">Sistema de Chequeo En l&iacute;nea</a></li>
            <li class="active">Mantenedor</li>
            <li class="active">Crear Usuario</li>
        </ol>
    </div>
</div>

<div class="panel panel-default sombraPanel">
    <div class="panel-heading colorAxioma">
        <h2 class="text-center color-principal blanco">Ingresar Usuario</h2>
    </div>
    <div class="panel-body paddingBottom">

        <form id="formIngresarUsuario" name="formIngresarUsuario" class="form-horizontal">
            <div class="form-group">
                <label for="nombre" class="col-sm-3 control-label">Nombre: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre">
                </div>
            </div>
            <div class="form-group">
                <label for="apellidoP" class="col-sm-3 control-label">Apellido Paterno: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="apellidoP" name="apellidoP" placeholder="Ingrese Apellido Paterno">
                </div>
            </div>
            <div class="form-group">
                <label for="apellidoM" class="col-sm-3 control-label">Apellido Materno: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="apellidoM" name="apellidoM" placeholder="Ingrese Apellido Materno">
                </div>
            </div>
            <div class="form-group">
                <label for="correo" class="col-sm-3 control-label">Correo: </label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="ejemplo@ejemplo.cl">
                </div>
            </div>
            <div class="form-group">
                <label for="nombreUsuario" class="col-sm-3 control-label">Nombre Usuario: </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" placeholder="Ingrese nombre de usuario">
                </div>
            </div>
            <div class="form-group">
                <label for="contrasena" class="col-sm-3 control-label">Contrase&ntilde;a: </label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="**********">
                </div>
            </div>
            <div class="form-group">
                <label for="reContrasena" class="col-sm-3 control-label">Re-ingrese Contrase&ntilde;a: </label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="reContrasena" name="reContrasena" placeholder="**********">
                </div>
            </div>
            <div class="form-group">
                <label for="idArea" class="col-sm-3 control-label">&Aacute;rea: </label>
                <div class="col-sm-4">
                    <select id="idArea" name="idArea" class="form-control">
                        <option value="">Seleccione</option>
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
            <div class="form-group" >
                <div id="contratoAjax"></div>

            </div> 
            <div class="form-group">
                <label for="idTipoUsuario" class="col-sm-3 control-label">Tipo Usuario: </label>
                <div class="col-sm-4">
                    <select id="idTipoUsuario" name="idTipoUsuario" class="form-control">
                        <option value="">Seleccione</option>
                        <?php
                        if (isset($tipoUsuarios)):
                            foreach ($tipoUsuarios as $tu) :
                                ?>
                                <option value="<?php echo $tu->getIdTipoUsuario(); ?>"><?php echo $tu->getTipoUsuario(); ?></option>

                                <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="idPerfil" class="col-sm-3 control-label"></label>
                <div class="col-sm-4">
                    <input type="submit" id="btnAgregarUsuario" name="btnAgregarUsuario" class="btn btn-success" value="Agregar Usuario">
                </div>
            </div>

        </form>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
                <div class="progress noDisplay gifCarga">
                    <div class="progress-bar progress-bar-striped active color-principal maxWidth" role="progressbar"
                         aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>

        <div class="row mensajeExito noDisplay">
            <div class="col-xs-12 col-sm-12 col-md-offset-3 col-md-6">
                <div class="alert alert-success">                    
                    <i class="fa fa-user"></i> <label>Usuario Agregado Exitosamente</label>
                </div>
            </div>
        </div>
        <div class="row mensajeError noDisplay">
            <div class="col-xs-12 col-sm-12 col-md-offset-3 col-md-6">
                <div class="alert alert-danger ">                    
                    <i class="fa fa-warning"></i> <label>Error, no se ha podido agregar al Usuario</label>
                </div>
            </div>
        </div>
    </div>
</div>




