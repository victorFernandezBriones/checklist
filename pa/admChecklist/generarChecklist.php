<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li ><a href="inicio.php" class="principal">Sistema de Chequeo En l&iacute;nea</a></li>
            <li>Adm.Checklist</li>
            <li class="active">Generar Checklist</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="panel panel-default sombraPanel">
            <div class="panel-heading colorAxioma">
                <h2 class="text-center color-principal blanco">Generar Checklist</h2>
            </div>
            <div class="panel-body paddingBottom text-center">
                <div class="row text-center">
                    <div class="col-md-12">
                        <form id="formGenerarChecklist" name="formGenerarChecklist" class="form-inline">
                            <div id="divFechaEnvio" class="form-group">
                                <label for="exampleInputName2">Fecha Env&iacute;o</label>
                                <input type="text" class="form-control" id="fechaEnvio" name="fechaEnvio" placeholder="Dia-Mes-Año">
                            </div>

                            <button type="submit" class="btn color-principal blanco">Generar Checklist</button>
                        </form>
                        <div class="row noDisplay gifCarga ">
                            <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">

                                <div class="progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped color-principal maxWidth active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                        <span class="sr-only">100% Complete (success)</span>
                                    </div>

                                </div>
                                <h4>Se están generando los checklist...Por favor espere</h4>
                            </div>
                        </div>
                        <div class="row mensajeExito noDisplay margin-top">
                            <div class="col-xs-12 col-sm-12 col-md-offset-3 col-md-6">
                                <div class="alert alert-success">                    
                                    <i class="fa fa-list"></i> 
                                    <label>Se han generado Checklist para los siguientes Contratos: </label>
                                    <p id="pContratosSinCheck"></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mensajeContratos margin-top noDisplay">
                            <div class="col-xs-12 col-sm-12 col-md-offset-3 col-md-6">
                                <div class="alert alert-danger ">                    
                                    <i class="fa fa-warning"></i> <label>Los siguientes contratos poseen checklist activos: </label>
                                    <p id="lblContratosConChecklist"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>