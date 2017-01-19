<?php require_once '../../negocio/admChecklist/procesarCargarInputHistorial.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li ><a href="inicio.php" class="principal">Sistema de Chequeo En l&iacute;nea</a></li>
            <li>Adm.Checklist</li>
            <li class="active">Historial Checklist</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="panel panel-default sombraPanel">
            <div class="panel-heading colorAxioma">                
                <h2 class="text-center color-principal blanco">Historial Checklist</h2> 
            </div>
            <div class="panel-body paddingBottom">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                        <form id="formBuscarHistorialChecklist" class="form-inline" method="POST">
                            <div class="form-group">
                                <label>Contrato:</label>
                                <select id="idContrato" name="idContrato" class="form-control">
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

                            <button type="submit" class="btn color-principal blanco btn-sm"><i class="fa fa-search-plus"></i>&nbsp;Buscar</button>

                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
                        <div class="progress noDisplay gifCarga">
                            <div class="progress-bar progress-bar-striped active color-principal maxWidth" role="progressbar"
                                 aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
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
