<?php if(count($productos) == 0){?>
<div class="col-lg-12">
    <div class="alert alert-info">
	      <div class="container">
	        <div class="alert-icon">
	          <i class="material-icons">info_outline</i>
	        </div>
	        <b>Atención:</b> No hay productos en las categorias seleccionadas
	      </div>
	    </div>
	</div>
<?php }else{ ?>
	<?php foreach($productos as $index=>$prod){?>
		<div class="col-md-4 col-lg-4 ">
		    <div class="card text-center tarjetaProd" id="contProd<?php echo $prod['idPresentacion']?>">
		        <div class="card-body">
		            
		            <span class="badge badge-danger nuevoProd" <?php if($prod['nuevo'] != 0){?>style="display:block;"<?php }else{?>style="display:none;"<?php }?> >Nuevo</span>

		            <span class="badge badge-warning descProd"  id="lblDescuento<?php echo $prod['idPresentacion']?>" >
		            	<?php $prod['variaciones'][0]['valorAnterior']?>
		            </span>

		            <?php if($prod['fotoPresentacion'] != ""){?>
			            <img src="<?php echo base_url()?>assets/uploads/files/<?php echo $prod['idTienda']?>/<?php echo $prod['fotoPresentacion']?>" height="200px" alt="">
			        <?php }else{ ?>
			            <img src="<?php echo base_url()?>assets/img/sinImagen.png" height="200px" width="100%" alt="" >
			        <?php }?>

		            <h4 class="card-title tituloProducto"><?php echo $prod['nombrePresentacion']?></h4>
		            <h4 class="card-title precioProducto" id="precios<?php echo $prod['idPresentacion']?>">

		                <span <?php if(count($prod['variaciones']) > 0 && $prod['variaciones'][0]['valorAnterior'] != 0){?>class="mostrar"<?php }else{?>class="ocultar"<?php }?> >Ahora: </span><?php if(count($prod['variaciones']) > 0){ ?>$<?php echo number_format($prod['variaciones'][0]['valorPresentacion'],0,',','.') ?><?php }?>


		                <?php if(count($prod['variaciones']) > 0 && $prod['variaciones'][0]['valorAnterior'] != 0){?>
			                <span class="valorAntes" id="valorAntes<?php echo $prod['idPresentacion']?>"> Antes: <?php echo $prod['variaciones'][0]['valorAnterior']?></span>
			            <?php }?>
		            </h4>
		            <p class="card-text parrafoTextoProducto"><?php echo substr($prod['descripcionCorta'],0,110) ?></p>

		            <?php if(count($prod['variaciones']) > 0){?>
			            <select class="form-control text-center" id="selVar<?php echo $prod['idPresentacion']?>" data-index="<?php echo $index?>" rel="<?php echo $prod['idPresentacion']?>" onchange="cambiaVariacion(this)">
			            	<?php foreach($prod['variaciones'] as $var){?>
				                <option value="<?php echo $var['idVariacion']?>"><?php echo $var['nombreVariacion']?></option>
				            <?php }?>
			            </select>
			        <?php }?>

		            <br>
		            <?php if($prod['agotado'] == "No"){?>
			            <a class="text-white btn btn-info" ng-click="agregarCarrito(<?php echo $prod['idPresentacion']?>)"><i class="material-icons">shopping_cart</i> Añadir al carrito</a>
			        <?php }else{?>
			            <button class="text-white btn btn-default" disabled>PRODUCTO AGOTADO</button>
			        <?php }?>
		            <a class="text-white btn btn-info" style="padding-left:15px !important;padding-right:15px !important;" ng-click="likes(<?php echo $prod['idPresentacion']?>)"><i class="material-icons">favorite</i> <?php echo $prod['likes']?></a>
		        </div>
		    </div>
		</div>  
	<?php }?>
<?php }?>