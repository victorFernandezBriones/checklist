<!--BREADCRUM -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li ><a href="#inicio" onclick="cargarInicio()" class="principal">Sistema de Chequeo En l&iacute;nea</a></li>
            <li class="active">Inicio</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="panel panel-default sombraPanel">
            <div class="panel-heading colorAxioma">
                <h2 class="text-center color-principal blanco">Contratos</h2>
            </div>
            <div class="panel-body paddingBottom text-center">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="table-responsive">                            
                            <table class="table table-hover tabla-contratos">
                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Fecha Env&iacute;o</th>
                                        <th>Fecha Recepci&oacute;n</th>
                                        <th>Estado Checklist</th>
                                        <th>Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--encargado de documentos -->
                                    <?php
                                    switch ($sessionUsuario->getIdTipoUsuario()):
                                        case 1://ADMIN
                                            if (isset($contratos)) :
                                                foreach ($contratos as $c) :
                                                    $checklist = $serviceChecklist->getChecklistsPorActivosContrato($c->getContrato()->getIdContrato()); //ESTADO ACTIVO
                                                    if (!empty($checklist)):
                                                        $estadoCheck = $serviceEstadoCheck->getEstadoChecklistPorId($checklist->getIdEstadoChecklist());
                                                        switch ($checklist->getIdEstadoChecklist()):
                                                            case 1://ENVIADO
                                                                $colorFila = "alert alert-warning";
                                                                break;

                                                            case 2://CHEQUEADO
                                                                $colorFila = "alert alert-success";
                                                                break;
                                                        endswitch;
                                                        ?>
                                                        <tr class="<?php echo $colorFila; ?>">
                                                            <td><?php echo $c->getContrato()->getContrato(); ?> </td>
                                                            <td><?php echo $serviceFunciones->formatoFecha($checklist->getFechaEnvio()); ?></td>
                                                            <td><?php echo $checklist->getFechaRecepcion() != '0000-00-00' ? $serviceFunciones->formatoFecha($checklist->getFechaRecepcion()) : 'No Registra'; ?></td>
                                                            <td><?php echo $estadoCheck->getEstadoChecklist(); ?></td>
                                                            <td>
                                                                <button class="btn color-principal blanco" onclick="cargarChecklist(<?php echo $checklist->getIdChecklist(); ?>, '<?php echo $c->getContrato()->getContrato(); ?>')"><i class="fa fa-search-plus"></i>&nbsp;Detalle</button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    endif;
                                                endforeach;
                                            endif;

                                            break;

                                        case 2:

                                            if (isset($contratos)) :
                                                foreach ($contratos as $c) :
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $c->getContrato(); ?> </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <button class="btn btn-primary" onclick="cargarChecklist(<?php echo $c->getIdContrato(); ?>)"><i class="fa fa-search-plus"></i>&nbsp;Detalle</button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                endforeach;
                                            endif;

                                            break;

                                    endswitch;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
