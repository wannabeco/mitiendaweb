/*
* Controlador que maneja todas las funcionalidades de la aplicación
* @author Farez Prieto @orugal
*/
project.controller('paginaController', function($scope,$http,$q,constantes)
{
    $scope.categorias = [];
    $scope.categoria = "";//la que selecciona el usuario
    $scope.subcategorias = [];
    $scope.productos = [];
    $scope.subcategoria = "";
    $scope.disableSubca = true;
    $scope.botonesLogin = true;
    $scope.infoUsuario  = true;
    $scope.logueado     = 0;
    $scope.cantCarrito  = 0;
    //para paginar
    $scope.currentPage = 1;
    $scope.numPerPage = 12;
    $scope.maxSize = 5;
    $scope.todosLosProductos = [];

    $scope.productosCarrito = [];
    $scope.cantCarrito = 0;
    $scope.formaEnvio = 1;

    $scope.dataVar = [];

    $scope.initPagina = function()
    {
		$scope.config = configLogin;
		//$scope.getPedidosHome();
        $scope.leerCategorias();
        setTimeout(function(){
            $scope.leerCarrito();    
        },4000);
        
	}
	
    $scope.iniciarLogueo = function()
    {
        setTimeout(function(){
            ////console.log("Entro aca también");
            var dataLogin = $scope.getDataLogin();
            $scope.logueado    = localStorage.getItem('logueado')
            $scope.infoUsuario = dataLogin;
            //console.log(dataLogin);
            //console.log($scope.logueado);
            $scope.$digest();
            $scope.leerCarrito();
            $("#modalLogin").modal("hide");
        },2000);
        
    }
    $scope.cerrarSession = function()
    {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            location.reload();
        });
    }

    $scope.likes = function(idProducto)
    {
        if($scope.logueado == 0)//abro el modal de logueo
        {
            $("#modalLogin").modal({show:true});
        }
        else //proceso el like
        {
            var controlador = $scope.config.apiUrl+"Home/procesaLike";
            var parametros  = {idProducto:idProducto,idUsuario:$scope.infoUsuario.id,idTienda:$scope.config.infoTienda.idTienda};
            constantes.consultaApi(controlador,parametros,function(json){
                if(json.continuar == 1)
                {
                    $scope.toast(json.mensaje,"success");
                }
                else
                {
                    $scope.toast(json.mensaje,"error");
                }

                $scope.getProductos();
            },'json');
        }
        //alert(idProducto)
    }

    $scope.toast = function(mensaje,tipo)
    {
        $.toast({
            text: mensaje, // Text that is to be shown in the toast
            icon: tipo, // Type of toast icon
            showHideTransition: 'fade', // fade, slide or plain
            allowToastClose: true, // Boolean value true or false
            hideAfter: 1500, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
            stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
            position: 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
            textAlign: 'center',  // Text alignment i.e. left, right or center
            loader: true,  // Whether to show loader or not. True by default
            loaderBg: '#9EC600',  // Background color of the toast loader
        });
    }


    $scope.leerCategorias = function()
    {
        var controlador = $scope.config.apiUrl+"Home/getCategorias";
		var parametros  = {idTienda:$scope.config.infoTienda.idTienda};
		constantes.consultaApi(controlador,parametros,function(json){
			$scope.categorias = json.datos;
            $scope.categoria  = json.datos[0]['idProducto'];
            $scope.buscarSubCategorias();
            setTimeout(function(){$scope.getProductos();},300);
		},'json');
    }
    $scope.buscarSubCategorias = function()
    {
        $scope.subcategoria = "";
        var controlador = $scope.config.apiUrl+"Home/getSubcategorias";
		var parametros  = {categoria:$scope.categoria,idTienda:$scope.config.infoTienda.idTienda};
		constantes.consultaApi(controlador,parametros,function(json){
            if(json.continuar == 1)
            {
                $scope.subcategorias = json.datos;
                $scope.disableSubca = false;
                $scope.getProductos();
            }
            else
            {
                $scope.subcategorias = json.datos;
                $scope.disableSubca = true;
                $scope.subcategoria = "";
                $scope.getProductos();
            }
            //$scope.$digest();
		},'json');
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

    $scope.cargaDataVariacion = function(vari,idPresentacion,prod)
    {
        $scope.dataVar[prod] = $scope.productos[prod].variaciones[vari];
    }


    $scope.cargaDataVariacionUnitaria = function(vari,idPresentacion,prod)
    {
        $scope.dataVar[prod] = $scope.productos[prod].variaciones[vari];
        console.log(vari);
        console.log($scope.dataVar);
        $scope.$apply();
    }

    $scope.getProductos = function()
    {
        var controlador = $scope.config.apiUrl+"Home/getProductos";
		var parametros  = {categoria:$scope.categoria,subcategoria:$scope.subcategoria,idTienda:$scope.config.infoTienda.idTienda};
		constantes.consultaApi(controlador,parametros,function(json){
            //console.dir($scope.productos);
            if(json.datos.length > 0)
            {
                $scope.productos = json.datos;
            }
            else
            {

                $scope.productos = [];
            }

            $scope.dataVar = [];
            $scope.$apply();


            // $scope.numPages = function () {
            //  return Math.ceil($scope.productos.length / $scope.numPerPage);
            // };

            // $scope.$watch('currentPage + numPerPage', function() {
            //     var begin = (($scope.currentPage - 1) * $scope.numPerPage)
            //     , end = begin + $scope.numPerPage;
                
            //     $scope.todosLosProductos = $scope.productos.slice(begin, end);
            // })


		},'json');
    }
    $scope.procesaLikes = function(likes)
    {
        var nuevosLikes = 0;
        if(likes >= 1000 && likes < 1000000)
        {
            nuevosLikes = (likes / 1000)+"K";
        }
        else if(likes >= 1000000)
        {
            nuevosLikes = (likes / 1000000)+"M";
        }
        else
        {
            nuevosLikes = likes;
        }
        return nuevosLikes;
    }

	$scope.getPedidosHome = function()
	{
		//alert("sdfsdf");
		var controlador = $scope.config.apiUrl+"App/ajaxPedidos";
		var parametros  = {};
		constantes.consultaApi(controlador,parametros,function(json){
			//alert(json)
			$("#listaPedidos").html(json);
		},'html');

		setTimeout(function(){
			$scope.getPedidosHome()
		},40000);

	}

    $scope.getDataLogin = function()
    {
        return JSON.parse(localStorage.getItem('dataLogin'));
    }

    $scope.agregarCarrito = function(idProducto)
    {
        if($scope.logueado == 0)//abro el modal de logueo
        {
            $("#modalLogin").modal({show:true});
        }
        else //proceso el like
        {
            var variacion = $("#selVar"+idProducto).val();
            var controlador = $scope.config.apiUrl+"Home/agregarCarrito";
            var parametros  = {idUsuario:$scope.infoUsuario.id,idProducto:idProducto,proveedor:$scope.infoUsuario.tipoLogin,idTienda:$scope.config.infoTienda.idTienda,variacion:variacion};
            constantes.consultaApi(controlador,parametros,function(json){
                if(json.continuar == 1)
                {
                    $scope.toast(json.mensaje,"success");
                    $scope.leerCarrito();
                }
                else
                {
                    constantes.alerta("Atención",json.mensaje,"info",function(){});
                }
            },'json');
        }
    }
    $scope.quitarDelCarrito = function(idRelacion)
    {
        constantes.confirmacion("Confirmación","¿Está seguro que desea eliminar este producto de su carrito de pedido?",'info',function(){
            var controlador = $scope.config.apiUrl+"Home/quitarDelCarrito";
            var parametros  = {idUsuario:$scope.infoUsuario.id,idRelacion:idRelacion,proveedor:$scope.infoUsuario.tipoLogin,idTienda:$scope.config.infoTienda.idTienda};
            constantes.consultaApi(controlador,parametros,function(json){
                swal.close()
                $scope.toast(json.mensaje,"success");
                $scope.leerCarrito();
            },'json');
        });
    }

    $scope.leerCarrito = function()
    {
        var controlador = $scope.config.apiUrl+"Home/leerCarrito";
        var parametros  = {idUsuario:$scope.infoUsuario.id,proveedor:$scope.infoUsuario.tipoLogin,idTienda:$scope.config.infoTienda.idTienda};
        //console.dir(parametros);
        constantes.consultaApi(controlador,parametros,function(json){
            $scope.productosCarrito = json.datos;
            $scope.cantCarrito = json.datos.length;
            $scope.calculaTotalPedido();
            $scope.$apply();
        },'json');
    }


    $scope.restaCantidad = function(index,idRelacion)
    {
        if($scope.productosCarrito[index].cantidad > 1)
        {
            $scope.productosCarrito[index].cantidad = parseInt($scope.productosCarrito[index].cantidad) - parseInt(1);
            var controlador = $scope.config.apiUrl+"Home/modificarCantidad";
            var parametros  = {idUsuario:$scope.infoUsuario.id,cantidad:$scope.productosCarrito[index].cantidad,idRelacion:idRelacion,proveedor:$scope.infoUsuario.tipoLogin,idTienda:$scope.config.infoTienda.idTienda};
            constantes.consultaApi(controlador,parametros,function(json){},'json');
            $scope.calculaTotalPedido();
        }
    }
    $scope.sumaCantidad = function(index,idRelacion)
    {
        $scope.productosCarrito[index].cantidad = parseInt($scope.productosCarrito[index].cantidad) + parseInt(1);
        var controlador = $scope.config.apiUrl+"Home/modificarCantidad";
        var parametros  = {idUsuario:$scope.infoUsuario.id,cantidad:$scope.productosCarrito[index].cantidad,idRelacion:idRelacion,proveedor:$scope.infoUsuario.tipoLogin,idTienda:$scope.config.infoTienda.idTienda};
        constantes.consultaApi(controlador,parametros,function(json){},'json');
        $scope.calculaTotalPedido();
    }
    $scope.totalPedido = 0;
    $scope.calculaTotalPedido = function()
    {
        var total = 0
        for(a in $scope.productosCarrito)
        {
            total += ($scope.productosCarrito[a].valorPresentacion * $scope.productosCarrito[a].cantidad);
        }
        $scope.totalPedido = total;
    }
    $scope.hacerPedido = function()
    {
        var formaPago   = $("#formaPago").val();
        var formaEnvio  = $("#selEnvio").val();
        var direccion   = $("#direccion").val();
        alert(formaEnvio);
        if($scope.logueado == 0)//abro el modal de logueo
        {
            $("#modalLogin").modal({show:true});
        }
        else if(formaEnvio == 2 && direccion == "")
        {
            constantes.alerta("Debe escribir la direccion donde desea que le envíen el pedido","info",function(){});
        }
        else //proceso el like
        {
            constantes.confirmacion("Confirmación","Esta a punto de realizar un pedido con los productos agregados, ¿Desea continuar?","info",function(){
                //https://api.whatsapp.com/send/?phone=573114881738&text=Hola%2C+quisiera+hacer+un+pedido.%0A%0AQuiero+que+me+lo+env%C3%ADen+a%3A+Calle+falsa+123%0A%0ANombre%3A+Farez+Prieto%0A%0A--------------------------------%0A%0AP%C3%A1gina+web+econ%C3%B3mica+x+1+.+COP50000%0ACosto+de+env%C3%ADo+............+COP1%0A%0A--------------------------------%0A%0ATotal%3A+................+COP50001&app_absent=0
                var mensaje  = "Hola, mi nombre es "+$scope.infoUsuario.nombre+"%0A%0A";
                    mensaje += "Quisiera hacer un pedido con los siguientes productos.%0A%0A";
                    for(var a in $scope.productosCarrito)
                    {
                        mensaje += $scope.productosCarrito[a].nombrePresentacion+"%0A";
                        mensaje += $scope.productosCarrito[a].nombreVariacion+"%0A";
                        mensaje += "$"+($scope.productosCarrito[a].valorPresentacion * $scope.productosCarrito[a].cantidad)+"%0A";
                        mensaje += "Cantidad: "+$scope.productosCarrito[a].cantidad+"%0A";
                        mensaje += "----------------------------------------------%0A";
                    }
                    mensaje += "Forma de pago: "+$scope.calculaFormaPago(formaPago)+"%0A";
                    mensaje += "Forma de envío: "+$scope.calculaFormaEnvio(formaEnvio)+"%0A";
                    mensaje += "%0A%0A";
                    mensaje += "Muchas gracias!.";
                    console.log(mensaje);
                    window.open('https://api.whatsapp.com/send?phone='+$scope.config.infoTienda.celularTienda+'&text='+mensaje, '_blank');
                    swal.close();
            });
        }
    }
    $scope.calculaFormaPago = function(formaPago)
    {
        var salida = "";
        if(formaPago == 1)
        {
            salida = "TARJETA DE CRÉDITO";
        }
        else if(formaPago == 2)
        {
            salida = "TARJETA DÉBITO";
        }
        else if(formaPago == 3)
        {
            salida = "NEQUI";
        }
        else if(formaPago == 4)
        {
            salida = "DAVIPLATA";
        }
        else if(formaPago == 5)
        {
            salida = "EFECTIVO";
        }
        return salida;
    }
    $scope.calculaFormaEnvio = function(formaPago)
    {
        var salida = "";
        if(formaPago == 1)
        {
            salida = "RECOGER EN LA TIENDA";
        }
        else if(formaPago == 2)
        {
            salida = "ENVIAR A MI DIRECCIÓN";
        }
    }

   // setTimeout(function(){
   //      $scope.numPages = function () {
   //       return Math.ceil($scope.productos.length / $scope.numPerPage);
   //      };

   //      $scope.$watch('currentPage + numPerPage', function() {
   //          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
   //          , end = begin + $scope.numPerPage;
            
   //          $scope.todosLosProductos = $scope.productos.slice(begin, end);
   //      })
   // },2000);
    


});
