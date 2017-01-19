<?php require_once '../../negocio/admChecklist/procesarCargarHistorial.php'; ?> 
<div class="table-responsive margin-top">
    <table id="tablaHistorialChecklist" class="table table-hover">
        <thead>
            <tr>
                <th>Fecha Env&iacute;o</th>
                <th>Fecha Recepci&oacute;n</th>
                <th>Estado Checklist</th>
                <th>Detalle</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($checklists)):
                foreach ($checklists as $c):
                    $contrato = $serviceContrato->getContratoPorId($c->getIdContrato());
                    $estadoChecklist = $serviceEstadoCheck->getEstadoChecklistPorId($c->getIdEstadoChecklist());
                    ?>
                    <tr>
                        <td><?php echo $serviceFunciones->formatoFecha($c->getFechaEnvio()); ?></td>
                        <td><?php echo $serviceFunciones->formatoFecha($c->getFechaRecepcion()) != '00-00-0000' ? $serviceFunciones->formatoFecha($c->getFechaRecepcion()) : 'No registra.'; ?></td>
                        <td><?php echo $estadoChecklist->getEstadoChecklist(); ?></td>
                        <td class="text-center">
                            <button onclick="cargarChecklist(<?php echo $c->getIdChecklist() ?>, '<?php echo $contrato->getContrato()->getContrato(); ?>')" class="btn color-principal blanco">
                                <i class="fa fa-search-plus"></i>&nbsp;Detalle
                            </button>
                        </td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
</div>