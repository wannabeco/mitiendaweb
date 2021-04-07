/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('gestionTienda', function($scope,$http,$q,constantes,$compile)
{
	$scope.categorias	=	[];
	$scope.categoria 	= "";
	$scope.init = function()
	{
		$scope.config 			=  configLogin;//configuración global
		$.material.init();
		$scope.consultarCategorias();
	}

	$scope.consultarCategorias = function()
	{
		var controlador = 	$scope.config.apiUrl+"GestionTienda/getCategoriasAdmin";
		var parametros  = 	{};
		constantes.consultaApi(controlador,parametros,function(json){
			$scope.categorias = json.datos;
			$scope.$apply();
		},'json');
	}

	$scope.procesaCategoria = function(edita)
	{
		var nombreCategoria = $("#nombreProducto").val();
		if(nombreCategoria == "")
		{
			constantes.alerta("Atención","Debe escribir un nombre para la categoría","info",function(){});
		}
		else
		{
			var mensajeConfirma = (edita==1)?"Esta a punto de editar la información de la categoría, ¿Desea continuar?":"Esta a punto de crear una categoría, ¿Desea continuar?";
			constantes.confirmacion("Atención",mensajeConfirma,"info",function()
			{
				var parametros  = $("#formulario").serialize();
				var controlador = 	$scope.config.apiUrl+"GestionTienda/procesaCategoria";
				var parametros  = 	parametros+"&edita="+edita;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						});
					}	
					else
					{
						constantes.alerta("Atención",json.mensaje,"danger",function(){
							//location.reload();
						});
					}

				},'json');
			});
			
		}
	}
	$scope.eliminaCategoria = function(idCategoria)
	{
		constantes.confirmacion("Atención","Está a punto de eliminar la categoría seleccionada,¿Desea continuar?","info",function()
		{
			var parametros  = $("#formulario").serialize();
			var controlador = 	$scope.config.apiUrl+"GestionTienda/eliminaCategoria";
			var parametros  = 	{idProducto:idCategoria};
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1)
				{
					constantes.alerta("Atención",json.mensaje,"success",function(){
						location.reload();
					});
				}	
				else
				{
					constantes.alerta("Atención",json.mensaje,"danger",function(){
						//location.reload();
					});
				}

			},'json');
		});
	}
	
	/*
	* Me abre una plantilla que me permitira editar o crear los módulos
	*/
	$scope.cargaPlantillaControl = function(idProducto,edita)
	{
		$('#modalUsuarios').modal("show");
		var controlador = 	$scope.config.apiUrl+"GestionTienda/plantillaCreaCategoria";
		var parametros  = 	"edita="+edita+"&idProducto="+idProducto;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modalCrea").html(json);
			//actualiza el DOM
			$scope.compileAngularElement("#formulario");
		},'');
	}

	$scope.compileAngularElement = function(elSelector) {

        var elSelector = (typeof elSelector == 'string') ? elSelector : null ;  
            // The new element to be added
        if (elSelector != null ) {
            var $div = $( elSelector );

                // The parent of the new element
                var $target = $("[ng-app]");

              angular.element($target).injector().invoke(['$compile', function ($compile) {
                        var $scope = angular.element($target).scope();
                        $compile($div)($scope);
                        // Finally, refresh the watch expressions in the new element
                        $scope.$apply();
                    }]);
            }

    }
    //Funciones para la creación y edición de las subcategorías.

	$scope.subCategorias	=	[];
    $scope.initSubcategorias = function()
	{
		$scope.config 			=  configLogin;//configuración global
		$.material.init();
		$scope.consultarSubCategorias();
	}
    $scope.consultarSubCategorias = function()
	{
		var controlador = 	$scope.config.apiUrl+"GestionTienda/getSubCategoriasAdmin";
		var parametros  = 	{};
		constantes.consultaApi(controlador,parametros,function(json){
			$scope.subCategorias = json.datos;
			$scope.$apply();
		},'json');
	}

	$scope.cargaPlantillaControlSubcat = function(idSubcategoria,edita)
	{
		$('#modalUsuarios').modal("show");
		var controlador = 	$scope.config.apiUrl+"GestionTienda/plantillaCreaSubCategoria";
		var parametros  = 	"edita="+edita+"&idSubcategoria="+idSubcategoria;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modalCrea").html(json);
			//actualiza el DOM
			$scope.compileAngularElement("#formulario");
		},'');
	}
	$scope.procesaSubCategoria = function(edita)
	{
		var idProducto = $("#idProducto").val();
		var nombreSubcategoria = $("#nombreSubcategoria").val();
		
		if(idProducto == "")
		{
			constantes.alerta("Atención","Debe seleccionar una categoría para enlazar la nueva subcategoría","info",function(){});
		}
		else if(nombreSubcategoria == "")
		{
			constantes.alerta("Atención","Debe escribir un nombre para la subcategoría","info",function(){});
		}
		else
		{
			var mensajeConfirma = (edita==1)?"Esta a punto de editar la información de la subcategoría, ¿Desea continuar?":"Esta a punto de crear una subcategoría, ¿Desea continuar?";
			constantes.confirmacion("Atención",mensajeConfirma,"info",function()
			{
				var parametros  = $("#formulario").serialize();
				var controlador = 	$scope.config.apiUrl+"GestionTienda/procesaSubCategoria";
				var parametros  = 	parametros+"&edita="+edita;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						});
					}	
					else
					{
						constantes.alerta("Atención",json.mensaje,"danger",function(){
							//location.reload();
						});
					}

				},'json');
			});
			
		}
	}
	$scope.eliminaSubCategoria = function(idSubCategoria)
	{
		constantes.confirmacion("Atención","Está a punto de eliminar la subcategoría seleccionada,¿Desea continuar?","info",function()
		{
			var parametros  = $("#formulario").serialize();
			var controlador = 	$scope.config.apiUrl+"GestionTienda/eliminaSubCategoria";
			var parametros  = 	{idSubcategoria:idSubCategoria};
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1)
				{
					constantes.alerta("Atención",json.mensaje,"success",function(){
						location.reload();
					});
				}	
				else
				{
					constantes.alerta("Atención",json.mensaje,"danger",function(){
						//location.reload();
					});
				}

			},'json');
		});
	}

	
	$scope.productosLista	=	[];
    $scope.initProductos = function()
	{
		$scope.config 			=  configLogin;//configuración global
		$.material.init();
		$scope.consultarProductos();
	}
	$scope.consultarProductos = function()
	{
		$scope.productosLista = [];
		var controlador = 	$scope.config.apiUrl+"GestionTienda/getProductosAdmin";
		var parametros  = 	{};
		constantes.consultaApi(controlador,parametros,function(json){
			$scope.productosLista = json.datos;
			$scope.$apply();
		},'json');
	}
	$scope.cargaPlantillaControlProductos = function(idPresentacion,edita)
	{
		$('#modalUsuarios').modal("show");
		var controlador = 	$scope.config.apiUrl+"GestionTienda/plantillaCreaSubProductos";
		var parametros  = 	"edita="+edita+"&idPresentacion="+idPresentacion;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modalCrea").html(json.html);
			$scope.compileAngularElement("#formulario");
			$("#fotoPresentacion").fileinput({allowedFileTypes: ['image']});
		},'json');
	}
	$scope.activaVariacion = function()
	{
		var tieneVariacion = $('input:radio[name=variacion]:checked').val();
		if(tieneVariacion == 1)
		{
			$(".ocultaPorVariacion").show();
			$(".ocultaPorNoVariacion").hide();
		}
		else//si no tiene
		{

			$(".ocultaPorVariacion").hide();
			$(".ocultaPorNoVariacion").show();
		}
	}

	

    $scope.buscarSubCategorias = function(persist)
    {
        var categoria = $("#idProducto").val();
        var controlador = $scope.config.apiUrl+"GestionTienda/getSubcategoriasSel";
		var parametros  = {categoria:categoria,persistencia:persist};
		constantes.consultaApi(controlador,parametros,function(json){
			$("#subcaSel").html(json)
		},'');
    }
    $scope.llenaIdProducto = function(id)
    {
    	$scope.idProducto = id;
    	$scope.$apply();
    }

    $scope.procesaProducto = function(edita)
    {
    	var idProducto 			= $("#idProducto").val();
		var idSubcategoria 		= $("#idSubcategoria").val();
    	var nombrePresentacion 	= $("#nombrePresentacion").val(); 
		var codigoProducto 		= $("#codigoProducto").val(); 
		var marca 				= $("#marca").val(); 
		var nuevo 				= $("#nuevo").val(); 
		var descripcionCorta 	= $("#descripcionCorta").val(); 
		var fotoPresentacion 	= $("#fotoPresentacion").val(); 
		var variacion 			= $('input:radio[name=variacion]:checked').val(); 
		var valorPresentacion 	= $("#valorPresentacion").val(); 
		var valorAntes 			= $("#valorAntes").val(); 
		var descuento 			= $("#descuento").val();
		//vallidacion de campos
		if(idProducto == "")
		{
			constantes.alerta("Atención","Debe seleccionar una categoría para enlazar el producto","info",function(){});
		}
		else if(idSubcategoria == "")
		{
			constantes.alerta("Atención","Debe seleccionar una subcategoría para enlazar el producto","info",function(){});
		}
		else if(nombrePresentacion == "")
		{
			constantes.alerta("Atención","Por favor escriba el nombre del producto","info",function(){});
		}
		else if(marca == "")
		{
			constantes.alerta("Atención","Por favor la marca del producto","info",function(){});
		}
		else if(nuevo == "")
		{
			constantes.alerta("Atención","Por favor indique si es un nuevo producto","info",function(){});
		}
		else if(descripcionCorta == "")
		{
			constantes.alerta("Atención","Escriba una descripción corta para el producto","info",function(){});
		}
		/*else if(variacion == undefined || variacion == "")
		{
			constantes.alerta("Atención","Indique si el producto tiene variación o no","info",function(){});
		}
		else if(variacion == 0 && valorPresentacion == "")
		{
			constantes.alerta("Atención","Escriba el precio de venta del producto","info",function(){});
		}*/
		else
		{
			var mensajeConfirma = (edita == 1)?"Está a punto de modificar la información del producto, ¿Desea continuar?":"Está a punto de crear un nuevo producto, ¿Desea continuar?";
			constantes.confirmacion("Atención",mensajeConfirma,"info",function(){
				var formData 	=   new FormData($("#formulario")[0]);
					formData.append("edita", edita);
		        var controlador = 	$scope.config.apiUrl+"GestionTienda/procesaProducto"; 
		        //hacemos la petición ajax  
		        parametros	=	formData;
		        $.ajax({
		            url: controlador,  
		            type: 'POST',
		            data: parametros,
		            dataType:"json",
		            cache: false,
		            contentType: false,
		            processData: false,
		            beforeSend: function(){
		                     
		            },
		            //una vez finalizado correctamente
		            success: function(json)
		            {
		            	if(json.continuar == 1)
						{
							constantes.alerta("Atención",json.mensaje,"success",function(){
								location.reload();
							})
						}
						else
						{
							constantes.alerta("Atención",json.mensaje,"warning",function(){})
						}
		            },
		            //si ha ocurrido un error
		            error: function(){
		              
		            }
		        });
			});
		}

		
    }
    //variaciones
    //$scope.productosLista	=	[];
    $scope.initVariaciones = function()
	{
		$scope.config 			=  configLogin;//configuración global
		$.material.init();
		//$scope.consultarProductos();
	}
	$scope.variacionesProducto = function(idPresentacion)
	{
		$('#modalUsuarios').modal("show");
		var controlador = 	$scope.config.apiUrl+"GestionTienda/plantillaVariaciones";
		var parametros  = 	"idPresentacion="+idPresentacion;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modalCrea").html(json);
			$scope.compileAngularElement("#formulario");
			//$("#fotoPresentacion").fileinput({allowedFileTypes: ['image']});
		},'');
	}
	$scope.agregarVariacion = function()
	{
		var random = Math.round(Math.random() * (1000 - 1) + 1);
		var dataInfovar = {nueva:1,idVariacion:random};
		var form = '';
		form += '<div class="row variacionesList" data-idvariacion="'+random+'" data-nueva="1" id="panelVariacion'+random+'">';
		 form += '  <div class="col col-lg-12 col-md-12">';
		form += '	<br><button type="button" class="close" title="Eliminar esta variación" ng-click="eliminaVariacion('+random+')">';
        form += '     	<span aria-hidden="true">&times;</span>';
        form += ' 	</button>';
        form += '  </div>';
        form += '  <div class="col col-lg-12 col-md-12">';
        form += '      <div class="form-group  label-floating">';
        form += '          <label class="control-label" for="nombreVariacion">Nombre variación</label>';
        form += '            <input style="text-transform: uppercase" tabindex="2" autocomplete="off" id="nombreVariacion'+random+'" name="nombreVariacion"  class="form-control" type="text">';
        form += '        <p class="help-block">Sin puntos, sin $</p>';
        form += '      </div>';
        form += '   </div>';
        form += '   <div class="col col-lg-4 col-md-4">';
        form += '      <div class="form-group  label-floating">';
        form += '          <label class="control-label" for="valorPresentacion">Valor *</label>';
        form += '            <input style="text-transform: uppercase" tabindex="2" autocomplete="off" id="valorPresentacion'+random+'" name="valorPresentacion"  class="form-control"  type="text">';
        form += '        <p class="help-block">Sin puntos, sin $</p>';
        form += '      </div>';
        form += '   </div>';
        form += '   <div class="col col-lg-4 col-md-4">';
        form += '      <div class="form-group  label-floating">';
        form += '          <label class="control-label" for="valorAntes">Valor anterior</label>';
        form += '            <input style="text-transform: uppercase" tabindex="2" autocomplete="off" id="valorAntes'+random+'" name="valorAntes"  class="form-control"  type="text">';
        form += '        <p class="help-block">Sin puntos, sin $. Sólo si aplica</p>';
        form += '      </div>';
        form += '   </div>';
        form += '   <div class="col col-lg-4 col-md-4">';
        form += '      <div class="form-group  label-floating">';
        form += '          <label class="control-label" for="variacion">Descuento</label>';
        form += '            <input style="text-transform: uppercase" tabindex="2" autocomplete="off" id="descuento'+random+'" name="descuento"  class="form-control" type="text">';
        form += '        <p class="help-block">Sin puntos, sin %. Sólo si aplica</p>';
        form += '      </div>';
        form += '   </div>';
        form += '</div>';
        //form += '<div style="height:1px;background:#ccc;width:100%"></div>';
        $("#contVariaciones").append(form);
        $scope.compileAngularElement("#formulario");
	}

	$scope.eliminaVariacion = function(idVariacion)
	{
		var element = $("#panelVariacion"+idVariacion);
		var nueva 	= $(element).data("nueva");
		constantes.confirmacion("Atención","Está seguro que desea eliminar esta variación del producto","info",function(){
			if(nueva == 1)//si es nueva solo elimino el panel
			{
				element.remove();
				swal.close();
			}
			else
			{

				var controlador = 	$scope.config.apiUrl+"GestionTienda/eliminaVariacion";
				var parametros  = 	{idVariacion:idVariacion}
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						//si no es nueva debo borrarla de la base de datos
						element.remove();
						swal.close();
					}
					else
					{
						constantes.alerta("Atención!",json.mensaje,"danger",function(){});
					}

				},'json');
			}
		});
		
	}

	$scope.eliminarProducto = function(idPresentacion)
	{
		constantes.confirmacion("Atención","Está a punto de eliminar el producto seleccionado, recuerde que esto también eliminará las variaciones que tenga,¿Desea continuar?","info",function(){
			var controlador = 	$scope.config.apiUrl+"GestionTienda/eliminaProducto";
			var parametros  = 	{idPresentacion:idPresentacion}
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1)
				{
					constantes.alerta("Atención!",json.mensaje,"success",function(){
						$scope.consultarProductos();
						swal.close();
					});
				}
				else
				{
					constantes.alerta("Atención!",json.mensaje,"danger",function(){
						$scope.consultarProductos();
						swal.close();
					});
				}

			},'json');
		});
	}

	$scope.procesaVariaciones = function()
	{
		var element = $(".variacionesList");
		var error = 0;
		$.each(element,function(e2,ele2){
			var idVariacion2 = $(ele2).data("idvariacion");
			var nombreVar2 	= $("#nombreVariacion"+idVariacion2).val();
			var valor2 		= $("#valorPresentacion"+idVariacion2).val();
			if(nombreVar2 == "")
			{
				error++;
			}
			else if(valor2 == "")
			{
				error++;
			}
		});

		

		if(error == 0)
		{
			var operados = 0;
			constantes.confirmacion("Atención","Está a punto de guardar la información de las variaciones, ¿Desea continuar?","info",function(){
				$.each(element,function(e,ele){
					var idVariacion 	= $(ele).data("idvariacion");
					var nueva 			= $(ele).data("nueva");
					var nombreVar 		= $("#nombreVariacion"+idVariacion).val();
					var valor 			= $("#valorPresentacion"+idVariacion).val();
					var descuento 		= $("#descuento"+idVariacion).val();
					var valorAntes 		= $("#valorAntes"+idVariacion).val();
					var idPresentacion 	= $("#idPresentacion").val();
					//valido
					//realizo el guardado de una en una, si es nueva la creo y si es antigua la actualizo.
					var controlador = 	$scope.config.apiUrl+"GestionTienda/procesaVariaciones";
					var parametros  = 	{nueva:nueva,idVariacion:idVariacion,nombreVar:nombreVar,valor:valor,idPresentacion:idPresentacion,descuento:descuento,valorAntes:valorAntes}
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1)
						{
							operados++;
						}

						if(operados == element.length)
						{
							constantes.alerta("Atención!","Se han procesado las variaciones del producto de manera correcta","success",function(){
								$scope.variacionesProducto(idPresentacion);
							});
						}

					},'json');
				});
			});
			
			
		}
		else
		{
			constantes.alerta("Atención!","Debe de revisar el campo nombre de la variación o valor de la variación ya que son obligatorios","info",function(){

			});
		}
		
	}

});
