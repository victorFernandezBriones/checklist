<?php require_once '../negocio/inicio/cargarDatosChecklist.php'; ?>

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
                <?php if (!empty($checklist)): ?>
                    <h2 id="tituloChecklist" class="text-center color-principal blanco"><?php echo "Checklist Correspondiente al " . $serviceFunciones->formatoFecha($checklist->getFechaEnvio()); ?></h2>
                <?php else: ?>
                    <h2 class="text-center color-principal blanco">No hay Checklist pendientes</h2>
                <?php
                endif;
                ?>

            </div>
            <div class="panel-body paddingBottom">
                <?php if (!empty($checklist)) : ?>
                    <div id="divChecklist" class="row ">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label class="text-left">Total Productos: <span id="spanTotalProd"><?php echo $totalProductos; ?></span></label>
                                    <br/>
                                    <label class="text-left">Productos Chequeados:<span id="spanProdCheck">&nbsp;<?php echo $totalPChequeados; ?></span></label> 
                                    <br/>
                                    <label class="text-left">Porcentaje Chequeados:<span id="spanPorcCheck">&nbsp;<?php echo $porcChequeados . "%"; ?></span></label> 
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 text-right">
                                    <button id="btnEnviarChecklist" class="btn btn-danger waves-effect sombraPanel"><i class="fa fa-mail-forward"></i>&nbsp;Enviar Checklist</button>
                                    <input type="hidden" id="idChecklist" value="<?php echo $checklist->getIdChecklist(); ?>">

                                </div>

                            </div>
                            <div class="table-responsive">
                                <?php
                                if (isset($generos)) :
                                    $cont = 1;
                                    $contInput = 0;
                                    foreach ($generos as $g) :
                                        $productos = $serviceProducto->getProductosPorGeneroYChecklist($checklist->getIdChecklist(), $g->getCodGenero());
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
                                                        <th>Comentario</th>
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
                                                                <td>
                                                                    <p id="<?php echo "pComentarioCheck" . $contInput; ?>"><?php
                                                                        if ($p->getComentarioCheck() != "") {
                                                                            echo $p->getComentarioCheck();
                                                                        }
                                                                        ?></p>
                                                                    <?php if ($p->getComentarioCheck() == ""): ?>

                                                                        <button id="<?php echo "btnAgregarComentario" . $contInput; ?>" onclick="cargarIdProductoModal(<?php echo $p->getIdProducto(); ?>, '<?php echo "btnAgregarComentario" . $contInput; ?>', '<?php echo "pComentarioCheck" . $contInput; ?>')" class="btn btn-success" data-toggle="modal" data-target="#modalAgregarComentario"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
                                                                        <?php
                                                                    endif;
                                                                    ?>
                                                                </td>                                                           
                                                                <td class="tdCheckbox">
                                                                    <input type="checkbox" class="checkbox" value="<?php echo $p->getIdProducto(); ?>" <?php echo $p->getChequeado() == 1 ? 'Checked' : ''; ?>>
                                                                </td>
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
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<!-- Modal Para agregar comentario-->
<div class="modal fade" id="modalAgregarComentario" tabindex="-1" role="dialog" aria-labelledby="modalAgregarComentario">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="color-principal blanco text-center">Ingresar Comentario</h4>
            </div>
            <div class="modal-body">
                <form id="formAgregarComentario" class="form-horizontal">
                    <input type="hidden" id="idProductoModal" name="idProductoModal" value="">
                    <input type="hidden" id="idBotonEsconderModal" name="idBotonEsconderModal" value="">
                    <input type="hidden" id="nombrePMod" name="nombrePMod" value="">


                    <div class="form-group"> 
                        <label class="col-sm-2 control-label">Comentario:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control noResize" rows="4" id="comentarioCheckProducto" class="comentarioCheckProducto" placeholder="Ingrese Comentario"></textarea>

                        </div>


                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-success waves-effect" onclick="agregarComentario(3)">Guardar Comentario</button>
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
                <button type="button" class="btn btn-success waves-effect" onclick="agregarResponsable(2)">Modificar</button>
            </div>
        </div>
    </div>
</div>
