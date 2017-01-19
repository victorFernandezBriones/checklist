<?php require_once '../../../negocio/configuracion/contratos/procesarCargarContrato.php'; ?>

<label for="idArea" class="col-sm-3 control-label">Contratos: </label>
<div class="col-sm-4">
    <select id="idContrato" name="idContrato" class="form-control">       
        <?php
        if (count($contratos) != 0):
            foreach ($contratos as $c) :
                ?>
                <option value="<?php echo $c->getIdContrato(); ?>"><?php echo $c->getContrato(); ?></option>

                <?php
            endforeach;
        else:
            ?>
            <option value="">No Hay Contratos Disponibles</option>
        <?php
        endif;
        ?>
    </select>
</div>