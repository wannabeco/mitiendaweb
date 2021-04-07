<form role="form" enctype="multipart/form-data"  ng-controller="gestionTienda" ng-init="initProductos()" id="formulario" ng-submit="procesaProducto(<?php echo $edita ?>)">    
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h2 class="modal-title"><?php echo $titulo ?></h2>
      <p class="text-justify">
        Completa la información para poder editar o crear una productos
      </p>
  </div>
  <div class="modal-body">

               <div class="row">
                 <div class="col col-lg-6 col-md-6">
                    <div class="form-group  label-floating">
                        <label class="control-label" for="idProducto">Categoría *</label>
                          <select tabindex="2" id="idProducto" name="idProducto"  class="form-control"  onchange="buscarSubCategorias(<?php echo $persistencia?>)">
                            <option value=""></option>
                            <?php foreach($selects['categorias'] as $catList){?>
                              <option <?php if(isset($datos['idProducto']) && $datos['idProducto'] == $catList['idProducto']){ ?>selected<?php } ?> value="<?php echo $catList['idProducto']?>"><?php echo $catList['nombreProducto']?></option>
                            <?php }?>
                          </select>
                          <p class="help-block">Seleccione la categoría a la que pertenecera</p>
                    </div>
                 </div>
                 <div class="col col-lg-6 col-md-6">
                    <div class="form-group label-floating" id="subcaSel">
                        <label class="control-label" for="idSubcategoria">Sub categoría *</label>
                          <select tabindex="2" autocomplete="off" id="idSubcategoria" name="idSubcategoria"  class="form-control" disabled>
                            <option value=""></option>
                          </select>
                          <p class="help-block">Seleccione la subcategoría a la que pertenecera</p>
                    </div>
                 </div>
               </div>


               <div class="row">
                 <div class="col col-lg-12 col-md-12">
                    <div class="form-group  label-floating">
                        <label class="control-label" for="nombrePresentacion">Nombre del producto *</label>
                          <input style="text-transform: uppercase" tabindex="2" autocomplete="off" id="nombrePresentacion" name="nombrePresentacion"  class="form-control" value="<?php echo (isset($datos['nombrePresentacion']))?$datos['nombrePresentacion']:''; ?>" type="text" >
                      <p class="help-block"></p>
                    </div>
                 </div>
               </div>

               <div class="row">

                 <div class="col col-lg-4 col-md-4">
                    <div class="form-group  label-floating">
                        <label class="control-label" for="codigoProducto">Código del producto</label>
                          <input style="text-transform: uppercase" tabindex="2" autocomplete="off" id="codigoProducto" name="codigoProducto"  class="form-control" value="<?php echo (isset($datos['codigoProducto']))?$datos['codigoProducto']:''; ?>" type="text" >
                         <p class="help-block">EJ: PROD00336</p>
                    </div>
                 </div>
                 <div class="col col-lg-4 col-md-4">
                    <div class="form-group  label-floating">
                        <label class="control-label" for="marca">Marca del producto *</label>
                          <input style="text-transform: uppercase" tabindex="2" autocomplete="off" id="marca" name="marca"  class="form-control" value="<?php echo (isset($datos['marca']))?$datos['marca']:''; ?>" type="text">
                      <p class="help-block">EJ: MARCA XYZ</p>
                    </div>
                 </div>

                 <div class="col col-lg-4 col-md-4">
                    <div class="form-group  label-floating">
                        <label class="control-label" for="nuevo">Producto nuevo</label>
                          <select tabindex="2" id="nuevo" name="nuevo"  class="form-control">
                            <option value="no" <?php if(isset($datos['nuevo']) && $datos['nuevo'] =='No'){ ?>selected<?php } ?>>NO</option>
                            <option value="si" <?php if(isset($datos['nuevo']) && $datos['nuevo'] =='Si'){ ?>selected<?php } ?>>SI</option>
                          </select>
                          <p class="help-block">Seleccione la categoría a la que pertenecera</p>
                    </div>
                 </div>

               </div>

               <div class="row">
                 <div class="col col-lg-12 col-md-12">
                    <div class="form-group  label-floating">
                        <label class="control-label" for="descripcionCorta">Descripción corta del producto *</label>
                          <textarea tabindex="2" autocomplete="off" id="descripcionCorta" name="descripcionCorta"  class="form-control" type="text" ><?php echo (isset($datos['descripcionCorta']))?$datos['descripcionCorta']:''; ?></textarea>
                      <p class="help-block">Breve información del producto para el cliente. 110 Caracteres</p>
                    </div>
                 </div>
               </div>
               <?php if($edita == 1){?>
                 <div class="row">
                   <div class="col col-lg-12 col-md-12">
                      <div class="form-group  label-floating">
                        <label class="control-label" for="fotoPresentacion">Foto actual</label>
                        <img src="<?php echo base_url()?>assets/uploads/files/<?php echo $datos['idTienda']?>/<?php echo $datos['fotoPresentacion']?>" width="
                        20%"><br>
                        <input type="hidden" name="fotoActual"  value="<?php echo (isset($datos['fotoPresentacion']))?$datos['fotoPresentacion']:'';?>">
                        <p class="text-justify">
                          Para reemplazar la foto actual solo deberá cargar una nueva
                        </p>
                      </div>
                   </div>
                 </div>
               <?php }?>
               <div class="row">
                 <div class="col col-lg-12 col-md-12">
                    <div class="form-group  label-floating">
                      <label class="control-label" for="fotoPresentacion">Foto principal del producto</label>
                      <input type="file" class="file" id="fotoPresentacion" name="fotoPresentacion" /><br>
                      
                      <p class="text-justify">
                        Podrá elegir de su computadora una fotografía para acompañar su perfil. Esta fotografía debe estar en formato PNG, JPG ó GIF, no debe ser mayor a 2 MB y debe guardar la proporción de tamaño de 800 X 800 máximo (Cuadrado perfecto).
                      </p>
                    </div>
                 </div>
               </div>
               
               <!-- <div class="row">
                  <div class="col col-lg-12 col-md-12"><br>
                    <h4><strong>¿El producto tiene variación? *</strong></h4>
                    <p>La variación de un producto es cuando este tiene color, talla, peso, tamaño y estos tienen valor diferente. Active esta casita si el producto lo tiene.</p>
                  </div>
                 
                 <div class="col col-lg-12 col-md-12">
                      <input tabindex="2" autocomplete="off" ng-click="activaVariacion()" id="variacion2" name="variacion" <?php if(isset($datos['variacion']) && $datos['variacion'] == '0'){ echo "checked"; }?> type="radio" value="0"> <label for="variacion2">NO</label>&nbsp;&nbsp;&nbsp;&nbsp;

                      <input tabindex="2" autocomplete="off" ng-click="activaVariacion()" id="variacion1" name="variacion" <?php if(isset($datos['variacion']) && $datos['variacion'] == '1'){ echo "checked"; }?> type="radio" value="1"> <label for="variacion1">SI</label>
                 </div>
              </div> -->

               <div class="row ocultaPorVariacion">
                <div class="col col-lg-12 col-md-12">
                  <?php if($edita == 1){?>
                    <p><br>Debe terminar la edición del producto para ajustar las variaciones</p>
                  <?php }else{?>
                    <p><br>Debe terminar con la creación del producto para continuar con las variaciones</p>
                  <?php }?>
                 </div>
               </div>
               <div class="row ocultaPorNoVariacion">

                 <div class="col col-lg-12 col-md-12">
                  <p><br>Como el producto no tiene variación debe estipularle un precio</p>
                 </div>
                 <div class="col col-lg-4 col-md-4">
                    <div class="form-group  label-floating">
                        <label class="control-label" for="valorPresentacion">Valor producto *</label>
                          <input style="text-transform: uppercase" tabindex="2" autocomplete="off" id="valorPresentacion" name="valorPresentacion"  class="form-control" value="<?php echo (isset($datos['valorPresentacion']))?$datos['valorPresentacion']:''; ?>" type="text">
                      <p class="help-block">Sin puntos, sin $</p>
                    </div>
                 </div>
                 <div class="col col-lg-4 col-md-4">
                    <div class="form-group  label-floating">
                        <label class="control-label" for="valorAntes">Valor anterior</label>
                          <input style="text-transform: uppercase" tabindex="2" autocomplete="off" id="valorAntes" name="valorAntes"  class="form-control" value="<?php echo (isset($datos['valorAntes']))?$datos['valorAntes']:''; ?>" type="text">
                      <p class="help-block">Sin puntos, sin $. Sólo si aplica</p>
                    </div>
                 </div>
                 <div class="col col-lg-4 col-md-4">
                    <div class="form-group  label-floating">
                        <label class="control-label" for="variacion">Descuento</label>
                          <input style="text-transform: uppercase" tabindex="2" autocomplete="off" id="descuento" name="descuento"  class="form-control" value="<?php echo (isset($datos['descuento']))?$datos['descuento']:''; ?>" type="text">
                      <p class="help-block">Sin puntos, sin %. Sólo si aplica</p>
                    </div>
                 </div>

               </div>



  
       <input type="hidden" name="idPresentacion" value="<?php echo $idPresentacion?>">

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
<script type="text/javascript">
  <?php if($edita == 1){?>
    $(document).ready(function(){
      angular.element(document.getElementById('formulario')).scope().buscarSubCategorias('<?php echo $datos['idSubcategoria']?>');
      //angular.element(document.getElementById('formulario')).scope().activaVariacion();
    });
  <?php }?>
  function buscarSubCategorias(id)
  {
    angular.element(document.getElementById('formulario')).scope().buscarSubCategorias(id);
  }
</script>