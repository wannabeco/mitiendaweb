<form role="form"  ng-controller="gestionTienda" ng-init="init()" id="formulario" ng-submit="procesaCategoria(<?php echo $edita ?>)">    
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h2 class="modal-title"><?php echo $titulo ?></h2>
      <p class="text-justify">
        Completa la información para poder editar o crear una categoría
      </p>
  </div>
  <div class="modal-body">    
      <div class="form-group  label-floating">
          <label class="control-label" for="nombreProducto">Nombre de la categoria</label>
            <input style="text-transform: uppercase" tabindex="2" autocomplete="off" id="nombreProducto" name="nombreProducto"  class="form-control" value="<?php echo (isset($datos['nombreProducto']))?$datos['nombreProducto']:''; ?>" type="text">
        <p class="help-block"></p>
        <input type="hidden" name="idProducto" value="<?php echo $idProducto?>">

      </div>
  </div>
  <div class="modal-footer">
    <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
    <?php if(getPrivilegios()[0]['crear'] == 1 && $edita == 0){ ?>
      <button type="submit" class="btn btn-raised btn-primary"><?php echo $labelBtn ?></button>
    <?php } ?>
    <?php if(getPrivilegios()[0]['editar'] == 1 && $edita == 1){ ?>
      <button type="submit" class="btn btn-raised btn-primary"><?php echo $labelBtn ?></button>
    <?php } ?>
  </div>
</form>