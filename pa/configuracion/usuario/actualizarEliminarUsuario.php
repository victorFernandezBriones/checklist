<?php require_once '../../../negocio/configuracion/usuarios/procesarActualizarEliminarUsuarios.php'; ?>
<div class="row">
    <div class="col-sm-12">        
        <ol class="breadcrumb pull-right">
            <li ><a href="#inicio" onclick="cargarInicio()" class="principal">Sistema de Chequeo En l&iacute;nea</a></li>
            <li class="active">Mantenedor</li>
            <li class="active">Administrar Usuarios</li>
        </ol>
    </div>
</div>
<div class="panel panel-default sombraPanel">
    <div class="panel-heading colorAxioma">
        <h2 class="text-center color-principal blanco">Actualizar / Eliminar Usuario</h2>
    </div>
    <div class="panel-body paddingBottom">

        <div class="row mensajeExito noDisplay">
            <div class="col-xs-12 col-sm-12 col-md-offset-3 col-md-6">
                <div class="alert alert-success">                  
                    <i class="fa fa-user"></i> <label>Usuario Actualizado Exitosamente</label>
                </div>
            </div>
        </div>
        <div class="row mensajeError noDisplay">
            <div class="col-xs-12 col-sm-12 col-md-offset-3 col-md-6">
                <div class="alert alert-danger ">                  
                    <i class="fa fa-warning"></i> <label>Error, no se ha podido Actualizar al Usuario</label>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-condensed table-hover"> 
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>                       
                        <th>Perfil</th>
                        <th>Estado</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>                    
                    </tr>
                </thead>
                <tbody>           
                    <?php
                    if (isset($usuarios)):
                        $cont = 0;
                        foreach ($usuarios as $u) :
                            ?>
                            <tr id="<?php echo "f" . $cont; ?>">
                                <td><input id="<?php echo "nombre" . $cont; ?>" name="<?php echo "nombre" . $cont; ?>" type="text" class="form-control" value="<?php echo $u->getNombre(); ?>"></td>
                                <td><input id="<?php echo "apellidoP" . $cont; ?>" name="<?php echo "apellidoP" . $cont; ?>" type="text" class="form-control" value="<?php echo $u->getApellidoP(); ?>"></td>
                                <td><input id="<?php echo "apellidoM" . $cont; ?>" name="<?php echo "apellidoM" . $cont; ?>" type="text" class="form-control" value="<?php echo $u->getApellidoM(); ?>"></td>                               
                                <td>
                                    <select id="<?php echo "idTipoUsuario" . $cont; ?>" name="<?php echo "idTipoUsuario" . $cont; ?>" class="form-control">
                                        <?php
                                        if (isset($tiposUsuarios)) :
                                            foreach ($tiposUsuarios as $tu) :
                                                ?>
                                                <option value="<?php echo $tu->getIdTipoUsuario(); ?>" <?php echo $tu->getIdTipoUsuario() == $u->getIdTipoUsuario() ? 'Selected' : ''; ?> ><?php echo $tu->getTipoUsuario(); ?></option>

                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select id="<?php echo "idEstado" . $cont; ?>" name="<?php echo "idEstado" . $cont; ?>" class="form-control">
                                        <?php
                                        if (isset($estados)) :
                                            foreach ($estados as $e) :
                                                ?>
                                                <option value="<?php echo $e->getIdEstadoUsuario(); ?>" <?php echo $e->getIdEstadoUsuario() == $u->getIdEstadoUsuario() ? 'Selected' : ''; ?> ><?php echo $e->getEstadoUsuario(); ?></option>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </td>
                                <td><input type="button" id="btnActualizarUsuario" name="btnActualizarUsuario" class="btn btn-success" value="Actualizar" onclick="actualizarUsuario(<?php echo $u->getIdUsuario(); ?>, '<?php echo "nombre" . $cont; ?>', '<?php echo "apellidoP" . $cont; ?>', '<?php echo "apellidoM" . $cont; ?>', '<?php echo "idTipoUsuario" . $cont; ?>', '<?php echo "idEstado" . $cont; ?>');"></td>
                                <td><input type="button" id="btnEliminarUsuario" name="btnEliminarUsuario" class="btn btn-danger" onclick="eliminarUsuario(<?php echo $u->getIdUsuario(); ?>, '<?php echo "f" . $cont; ?>')" value="Eliminar"></td>
                            </tr>  
                            <?php
                            $cont++;
                        endforeach;
                    endif;
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</div>