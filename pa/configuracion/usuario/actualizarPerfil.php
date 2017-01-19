<?php require_once '../../../negocio/configuracion/usuarios/procesarActualizarPerfil.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <div class="bg-picture text-center" style="background-image:url('media/fondoMaterialDesign.jpg')">
            <div class="bg-picture-overlay"></div>
            <div class="profile-info-name">   
                <img src="media/icono.png" class="thumb-lg img-circle img-thumbnail">
                
                <h3 class="text-white"><?php echo $usuarioSession->getNombre() . " " . $usuarioSession->getApellidoP(); ?></h3>
            </div>
        </div>
        <!--/ meta -->
    </div>
</div>
<div class="row user-tabs sombraPanel">
    <div class="col-sm-9 col-lg-6">
        <ul class="nav nav-tabs tabs">
            <li class="active tab">
                <a id="perfilA" href="#perfil" data-toggle="tab" aria-expanded="false" class="active"> 
                    <span class="visible-xs"><i class="fa fa-home"></i></span> 
                    <span class="hidden-xs">Sobre mi</span> 
                </a> 
            </li>             
            <li class="tab"> 
                <a id="actualizarPerfilA" href="#editar" data-toggle="tab" aria-expanded="false"> 
                    <span class="visible-xs"><i class="fa fa-cog"></i></span> 
                    <span class="hidden-xs">Configuración</span> 
                </a> 
            </li> 
            <div class="indicator"></div>
        </ul> 
    </div>    
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="tab-content profile-tab-content"> 
            <div class="tab-pane active" id="perfil"> 
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <!-- Personal-Information -->
                        <div class="panel panel-default panel-fill sombraPanel">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Informaci&oacute;n Personal</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <div class="about-info-p">
                                    <strong>Nombre Completo</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $usuarioSession->getNombre() . " " . $usuarioSession->getApellidoP() . " " . $usuarioSession->getApellidoM(); ?></p>
                                </div>                               
                                <div class="about-info-p">
                                    <strong>Email</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $usuarioSession->getCorreo(); ?></p>
                                </div> 
                                <div class="about-info-p">
                                    <strong>Contrato</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $contrato->getContrato()->getContrato(); ?></p>
                                </div> 
                            </div> 
                        </div>
                    </div>                   
                </div>
            </div> 


            <div class="tab-pane" id="editar">
                <!-- Personal-Information -->
                <div class="panel panel-default panel-fill sombraPanel">
                    <div class="panel-heading"> 
                        <h3 class="panel-title">Editar Perfil</h3> 
                    </div> 
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12 col-md-12">
                                <form id="formActualizarPerfil" name="formActualizarPerfil" role="form">
                                    <div class="form-group">
                                        <label for="nombre" >Nombre:</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuarioSession->getNombre(); ?>">
                                        <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $usuarioSession->getIdUsuario(); ?>">

                                    </div>
                                    <div class="form-group">
                                        <label for="apellidoP" >Apellido Paterno:</label>
                                        <input type="text" class="form-control" id="apellidoP" name="apellidoP" value="<?php echo $usuarioSession->getApellidoP(); ?>">

                                    </div>
                                    <div class="form-group">
                                        <label for="apellidoM">Apellido Materno:</label>
                                        <input type="text" class="form-control" id="apellidoM" name="apellidoM" value="<?php echo $usuarioSession->getApellidoM(); ?>">

                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correo:</label>
                                        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $usuarioSession->getCorreo(); ?>">

                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success waves-effect waves-light w-md btn-lg" type="submit">Actualizar</button>
                                    </div> 
                                </form>
                                <div class="row">
                                    <br/>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="alert alert-success noDisplay mensajeExito">
                                            <label><i class="fa fa-fw fa-user"></i> Perfil actualizado exitosamente</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <br/>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="alert alert-danger noDisplay  mensajeError">
                                            <label><i class="fa fa-fw fa-warning"></i> Error, no se ha podido actualizar el perfil</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 col-md-12">
                                <form id="formCambiarContrasena" role="form">
                                    <div class="form-group">
                                        <label for="contrasena">Contrase&ntilde;a</label>
                                        <input type="password" class="form-control" id="contrasenaN" name="contrasenaN" placeholder="***************">
                                    </div>
                                    <div class="form-group">
                                        <label for="reContrasena">Re-Contrase&ntilde;a</label>
                                        <input type="password" class="form-control" id="reContrasena" name="reContrasena" placeholder="***************">
                                    </div>

                                    <button class="btn btn-success waves-effect waves-light w-md btn-lg" type="submit">Actualizar</button>
                                </form>
                                <div class="row">
                                    <br/>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="alert alert-success noDisplay mensajeExitoMod">
                                            <label><i class="fa fa-fw fa-user"></i> Contrase&ntilde;a actualizada exitosamente</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <br/>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="alert alert-danger noDisplay  mensajeErrorMod">
                                            <label><i class="fa fa-fw fa-warning"></i> Error, no se ha podido actualizar la contrase&ntilde;a</label>
                                        </div>
                                    </div>

                                </div>
                            </div>                            
                        </div>

                    </div> 
                </div>
                <!-- Personal-Information -->
            </div> 
        </div> 
    </div>
</div>