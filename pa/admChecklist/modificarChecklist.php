<?php require_once '../../negocio/admChecklist/procesarModificarChecklist.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li ><a href="inicio.php" class="principal">Sistema de Chequeo En l&iacute;nea</a></li>
            <li>Adm.Checklist</li>
            <li class="active">Modificar Checklist</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="panel panel-default sombraPanel">
            <div class="panel-heading colorAxioma">                
                <h2 class="text-center color-principal blanco">Modificar Checklist</h2> 
            </div>
            <div class="panel-body paddingBottom">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-md-offset-1">
                        <form id="formBuscarChecklist" class="form-inline" method="POST">
                            <div class="form-group">
                                <label>Contrato:</label>
                                <select id="idContratoModCheck" name="idContratoModCheck" class="form-control">
                                    <option value="">Seleccione</option>
                                    <?php
                                    if (isset($contratos)) :
                                        foreach ($contratos as $c):
                                            ?>
                                            <option value="<?php echo $c->getContrato()->getIdContrato(); ?>"><?php echo $c->getContrato()->getContrato(); ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group divFecha">
                                <label>Fecha Checklist:</label>
                                <input id="fechaChecklist" name="fechaChecklist" type="text" class="form-control" placeholder="Día-Mes-Año">
                            </div>
                            <button type="submit" class="btn color-principal blanco btn-sm"><i class="fa fa-search-plus"></i>&nbsp;Buscar</button>

                        </form>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 ajaxChecklist">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>