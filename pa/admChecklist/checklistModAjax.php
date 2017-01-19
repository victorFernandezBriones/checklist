<?php
require_once '../../negocio/admChecklist/procesarCargarChecklistMod.php';
if (!empty($checklist)):
    ?>
    <hr/>
    <div class="row ">
        <div class="col-md-12">

            <div class="row margin-top" >
                <div class="col-xs-12 col-sm-12 col-md-4">                   

                    <label class="text-left">Total Productos:<span id="spanTotalProd"> <?php echo " " . $totalProductos; ?></span></label>
                    <br/>
                    <label class="text-left">Productos Chequeados:<span id="spanProdCheck"><?php echo " " . $totalPChequeados; ?></span></label>
                    <br/>
                    <label class="text-left">Porcentaje Chequeados:<span id="spanPorcCheck"><?php echo " " . $porcCheck . " %"; ?></span></label> 

                </div>

                <div class="col-xs-12 col-sm-12 col-md-8">          
                    <label class="text-left">Fecha Env&iacute;o: <?php echo " " . $serviceFunciones->formatoFecha($checklist->getFechaEnvio()); ?></label>
                    <br/>
                    <label class="text-left">Fecha Recepci&oacute;n: <?php echo $serviceFunciones->formatoFecha($checklist->getFechaRecepcion()) == '00-00-0000' ? 'No Registra' : $serviceFunciones->formatoFecha($checklist->getFechaRecepcion()); ?></label>
                    <br/>  
                    <form class="form-inline">
                        <div class="form-group">
                            <label>Estado Checklist: </label>    
                        </div>
                        <div class="form-group">

                            <select id="idEstadoChecklist" class="form-control">
                                <?php
                                if (isset($estadosChecklist)):
                                    foreach ($estadosChecklist as $ec) :
                                        ?>
                                        <option value="<?php echo $ec->getIdEstadoChecklist(); ?>"  <?php echo $ec->getIdEstadoChecklist() == $checklist->getIdEstadoChecklist() ? 'Selected' : ''; ?> ><?php echo $ec->getEstadoChecklist(); ?></option>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>

                        </div>
                        <button id="btnCambiarEstadoCheck" name="btnCambiarEstadoCheck" type="button" class="btn btn-success btn-sm" onclick="cambiarEstadoCheck('idEstadoChecklist',<?php echo $idChecklist; ?>)"><i class="fa fa-refresh"></i>&nbsp;Cambiar</button>
                    </form>
                </div>
            </div>

            <br/>

            <div class="table-responsive">
                <?php
                if (isset($generos)) :
                    $cont = 1;
                    $contInput = 1;
                    foreach ($generos as $g) :
                        $productos = $serviceProducto->getProductosPorGeneroYChecklist($idChecklist, $g->getCodGenero());
                        if (!empty($productos)) :
                            ?>

                            <table class="tabla-checklist">
                                <thead>
                                    <tr>
                                        <th><?php echo $cont; ?></th>
                                        <th><?php echo ucwords(strtolower($g->getNomGenero())); ?></th>
                                        <th>Serie</th>
                                        <th>A&ntilde;o</th>
                                        <th>Cantidad</th>
                                        <th>Responsable</th>
                                        <th>Detalle</th>     
                                        <th>Comentario Contrato</th>
                                        <th>Comentario Final</th>
                                        <th>Check Contrato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contDos = 1;
                                    if (!empty($productos)) :
                                        foreach ($productos as $p) :
                                            ?>
                                            <tr>
                                                <td><?php echo $cont . "." . $contDos; ?></td>
                                                <td><?php echo $p->getDescripcion(); ?></td>
                                                <td><?php echo $p->getNumBien(); ?></td>
                                                <td><?php echo $p->getAnnio(); ?></td>
                                                <td><?php echo $p->getCantidad(); ?></td>
                                                <td>
                                                    <p id="<?php echo "pResponsable" . $contInput; ?>"><?php echo $p->getResponsable(); ?></p>
                                                    <button class="btn btn-primary btn-sm" onclick="cargarIdProductoModalResponsable(<?php echo $p->getIdProducto(); ?>, '<?php echo "pResponsable" . $contInput; ?>')" data-toggle="modal" data-target="#modalAgregarResponsable"><i class="fa fa-user"></i>&nbsp;Modificar</button>

                                                </td>
                                                <td><?php echo $p->getComentarios(); ?></td>                                                           
                                                <td><?php echo $p->getcomentarioCheck(); ?></td>  

                                                <td>
                                                    <p id="<?php echo "pComentarioFinal" . $contInput; ?>"><?php
                                                        if ($p->getComentarioFinal() != "") {
                                                            echo $p->getComentarioFinal();
                                                        }
                                                        ?></p>
                                                    <?php if ($p->getComentarioFinal() == ""): ?>

                                                        <button id="<?php echo "btnAgregarComentarioFinal" . $contInput; ?>" onclick="cargarIdProductoModal(<?php echo $p->getIdProducto(); ?>, '<?php echo "btnAgregarComentarioFinal" . $contInput; ?>', '<?php echo "pComentarioFinal" . $contInput; ?>')" class="btn btn-success" data-toggle="modal" data-target="#modalAgregarComentarioFinal"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
                                                        <?php
                                                    endif;
                                                    ?>
                                                </td>                                                         
                                                <td><input  type="checkbox" class="chequeo" value="<?php echo $p->getIdProducto(); ?>" <?php echo $p->getChequeado() == 1 ? 'Checked' : ''; ?>></td>
                                            </tr>
                                            <?php
                                            $contDos++;
                                            $contInput++;
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>

                            <?php
                            $cont++;
                        endif;
                    endforeach;
                    if ($cont == 1):
                        echo "<h1>No posee Productos Activos</h1>";
                    endif;
                endif;
                ?>
            </div>

        </div>
    </div>

<?php else: ?> 
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger text-center margin-top"> 
                <i class="fa fa-warning"></i>&nbsp;No se encontraron resultados
            </div>

        </div>
    </div>

<?php endif; ?>


<!-- Modal Para agregar comentario-->
<div class="modal fade" id="modalAgregarComentarioFinal" tabindex="-1" role="dialog" aria-labelledby="modalAgregarComentarioFinal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="text-center">Ingresar Comentario</h4>
            </div>
            <div class="modal-body">
                <form id="formAgregarComentario" class="form-horizontal">
                    <input type="hidden" id="idProductoModal" name="idProductoModal" value="">
                    <input type="hidden" id="idBotonEsconderModal" name="idBotonEsconderModal" value="">
                    <input type="hidden" id="nombrePMod" name="nombrePMod" value="">


                    <div class="form-group"> 
                        <label class="col-sm-2 control-label">Comentario:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control noResize" rows="4" id="comentarioFinalProducto" placeholder="Ingrese Comentario"></textarea>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-success waves-effect" onclick="agregarComentarioFinal()">Guardar Comentario</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Para Cambiar Responsable-->
<div class="modal fade" id="modalAgregarResponsable" tabindex="-1" role="dialog" aria-labelledby="modalAgregarResponsable">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="text-center">Cambiar Responsable</h4>
            </div>
            <div class="modal-body">
                <form id="formAgregarComentario" class="form-horizontal">
                    <input type="hidden" id="idProductoModalResp" name="idProductoModal" value="">                    
                    <input type="hidden" id="nombrePModResp" name="nombrePModResp" value="">

                    <div class="form-group"> 
                        <label class="col-sm-2 control-label">Responsable:</label>
                        <div class="col-sm-10">
                            <input type="text" id="nombreResponsable" class="form-control" placeholder="Ingrese Responsable"> 

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-success waves-effect" onclick="agregarResponsable()">Modificar</button>
            </div>
        </div>
    </div>
</div>

