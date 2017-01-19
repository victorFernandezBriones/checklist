
<div class="sidebar-inner slimscrollleft ">
    <div class="user-details color-secundario">
        <div class="pull-left">
            <img src="media/icono.png" alt="" class="thumb-md img-circle">
        </div>
        <div class="user-info">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $sessionUsuario->getNombre() . " " . $sessionUsuario->getApellidoP(); ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#" onclick="cargarPerfilUsuario()"><i class="fa fa-user"></i> Perfil<div class="ripple-wrapper"></div></a></li>                                     
                    <li><a href="../index.php"><i class="fa fa-power-off"></i> Salir</a></li>
                </ul>
            </div>

            <p class="text-muted m-0"><?php echo $tipoUsuario->getTipoUsuario(); ?></p>
        </div>
    </div>
    <!--- Divider -->
    <div id="sidebar-menu">
        <ul>
            <li>
                <a href="inicio.php" class="waves-effect"><i class="fa fa-home"></i><span> Inicio </span></a>
            </li>

            <?php if ($sessionUsuario->getIdTipoUsuario() != 3) : ?>
                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="fa fa-list"></i><span>Adm. CheckList </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#generarChecklist" onclick="cargarGenerarChecklist()">Generar Checklist</a>
                        </li>
                        <li>
                            <a href="#modificarChecklist" onclick="cargarModificarChecklist()">Modificar Checklist</a>
                        </li>
                        <li>
                            <a href="#historialChecklist" onclick="cargarHistorialChecklist()">Historial Checklist</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#Estadisticas" onclick="cargarEstadisticas()" class="waves-effect"><i class="fa fa-bar-chart"></i><span> Estad&iacute;sticas </span></a>
                </li>
                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="fa fa-wrench"></i><span> Mantenedor </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#CrearUsuario" onclick="cargarIngresarUsuario()"> Crear Usuario</a>
                        </li>
                        <li>
                            <a href="#ActualizarEliminarUsuario" onclick="cargarActualizarEliminarUsuario()" > Administrar Usuarios</a>
                        </li>
                        <li>
                            <a href="#MantenerContratos" onclick="cargarMantenerContratos()" > Administrar Contratos</a>
                        </li>
                    </ul>
                </li>

            <?php endif; ?>


        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>