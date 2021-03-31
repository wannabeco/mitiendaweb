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
    $scope.login = 0;
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
        $scope.iniciarLogueo();
        // setTimeout(function(){
        //     $scope.leerCarrito();    
        // },4000);
        
	}
	
    $scope.iniciarLogueo = function()
    {
        setTimeout(function(){
            ////console.log("Entro aca también");
            var dataLogin      = $scope.getDataLogin();
            var login       = localStorage.getItem('login');
            $scope.login    = login;
            $scope.infoUsuario = dataLogin;
            $scope.$apply();
            // console.log(dataLogin);
            // console.log($scope.login);
            $scope.leerCarrito();
            $("#modalLogin").modal("hide");
        },500);
        
    }
    $scope.procesoRegistro = function()
    {
        var nombre      = $("#nombre").val();
        var apellido    = $("#apellido").val();
        var email       = $("#email").val();
        var celular     = $("#celular").val();
        var clave       = $("#claver").val();
        var rclave      = $("#rclave").val();

        if(nombre == "")
        {
            constantes.alerta("Atención","Debes escribir tu nombre","info",function(){});
        }
        else if(apellido == "")
        {
            constantes.alerta("Atención","Debes escribir tu apellido","info",function(){});
        }
        else if(email == "")
        {
            constantes.alerta("Atención","Debes escribir tu correo electrónico","info",function(){});
        }
        else if(email != "" && !constantes.validaMail(email))
        {
            constantes.alerta("Atención","El correo electrónico ingresado no es válido","info",function(){});
        }
        else if(celular == "")
        {
            constantes.alerta("Atención","Es importante escribir tu número de celular, ya que es el medio por el cual las tiendas se comunicarán contigo","info",function(){});
        }
        else if(clave == "")
        {
            constantes.alerta("Atención","Debes asignar una contraseña","info",function(){});
        } 
        else if(rclave == "")
        {
            constantes.alerta("Atención","Debes volver a escribir tu contraseña","info",function(){});
        }
        else if(rclave != "" && clave != rclave)
        {
            constantes.alerta("Atención","Las contraseñas no coinciden, por favor verifica","info",function(){});
        }
        else
        {
            constantes.confirmacion("Atención","Estás a punto de crear un usuario con los datos ingresdos, ¿Deseas continuar?","info",function(){
                var controlador = $scope.config.apiUrl+"Api/registroUsuarios";
                var parametros  = {nombre:nombre,apellido:apellido,email:email,celular:celular,rclave:rclave,terminos:1,movil:'movil'};
                constantes.consultaApi(controlador,parametros,function(json){
                    if(json.continuar == 1)
                    {
                        constantes.alerta("Atención",json.mensaje,"success",function(){
                            $("#modalRegistro").modal("hide");
                        });
                    }
                    else
                    {
                        constantes.alerta("Atención",json.mensaje,"error",function(){});
                    }
                },'json');
            });
        }


    }
    $scope.procesoLogin = function()
    {
        var usuario = $("#usuario").val();
        var clave = $("#clave").val();
        if(usuario == "")
        {
            constantes.alerta("Atención","Debes escribir tu correo electrónico","info",function(){});
        }
        else if(usuario != "" && !constantes.validaMail(usuario))
        {
            constantes.alerta("Atención","El correo electrónico ingresado no es válido","info",function(){});
        }
        else if(clave == "")
        {
            constantes.alerta("Atención","Debes ingresar tu contraseña","info",function(){});
        }
        else
        {
            var controlador = $scope.config.apiUrl+"Api/Login";
            var parametros  = {username:usuario,contrasena:clave,movil:'movil'};
            constantes.consultaApi(controlador,parametros,function(json){
                if(json.continuar == 1)
                {
                    localStorage.setItem('dataLogin', JSON.stringify(json.datos));
                    localStorage.setItem('login', 1);
                    $scope.iniciarLogueo();
                    $("#modalLogin").modal("hide");
                }
                else
                {

                    constantes.alerta("Atención",json.mensaje,"error",function(){});
                }
            },'json');
        }
    }
    $scope.cerrarSession = function()
    {
        constantes.confirmacion("Atención","Estás a punto de cerrar la sesión, ¿deseas continuar?","info",function(){
            localStorage.setItem('dataLogin', JSON.stringify({}));
            localStorage.setItem('login', 0);
            location.reload();
        });
    }

    $scope.likes = function(idProducto)
    {
        if($scope.login == 0)//abro el modal de logueo
        {
            $("#modalLogin").modal({show:true});
        }
        else //proceso el like
        {
            var controlador = $scope.config.apiUrl+"Home/procesaLike";
            var parametros  = {idProducto:idProducto,idUsuario:$scope.infoUsuario.idPersona,idTienda:$scope.config.infoTienda.idTienda};
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
        if($scope.login == 0)//abro el modal de logueo
        {
            $("#modalLogin").modal({show:true});
        }
        else //proceso el like
        {
            var variacion = $("#selVar"+idProducto).val();
            var controlador = $scope.config.apiUrl+"Home/agregarCarrito";
            var parametros  = {idUsuario:$scope.infoUsuario.idPersona,idProducto:idProducto,proveedor:"ApiWeb",idTienda:$scope.config.infoTienda.idTienda,variacion:variacion};
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
            var parametros  = {idUsuario:$scope.infoUsuario.idPersona,idRelacion:idRelacion,proveedor:"ApiWeb",idTienda:$scope.config.infoTienda.idTienda};
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
        var parametros  = {idUsuario:$scope.infoUsuario.idPersona,proveedor:"ApiWeb",idTienda:$scope.config.infoTienda.idTienda};
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
            var parametros  = {idUsuario:$scope.infoUsuario.idPersona,cantidad:$scope.productosCarrito[index].cantidad,idRelacion:idRelacion,proveedor:"ApiWeb",idTienda:$scope.config.infoTienda.idTienda};
            constantes.consultaApi(controlador,parametros,function(json){},'json');
            $scope.calculaTotalPedido();
        }
    }
    $scope.sumaCantidad = function(index,idRelacion)
    {
        $scope.productosCarrito[index].cantidad = parseInt($scope.productosCarrito[index].cantidad) + parseInt(1);
        var controlador = $scope.config.apiUrl+"Home/modificarCantidad";
        var parametros  = {idUsuario:$scope.infoUsuario.idPersona,cantidad:$scope.productosCarrito[index].cantidad,idRelacion:idRelacion,proveedor:"ApiWeb",idTienda:$scope.config.infoTienda.idTienda};
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
        if($scope.login == 0)//abro el modal de logueo
        {
            $("#modalLogin").modal({show:true});
        }
        else if(formaEnvio == 2 && direccion == "")
        {
            constantes.alerta("Atención","Debe escribir la direccion donde deseas que te envien el pedido","info",function(){});
        }
        else //proceso el like
        {
            constantes.confirmacion("Confirmación","Esta a punto de realizar un pedido con los productos agregados, ¿Desea continuar?","info",function(){
                //https://api.whatsapp.com/send/?phone=573114881738&text=Hola%2C+quisiera+hacer+un+pedido.%0A%0AQuiero+que+me+lo+env%C3%ADen+a%3A+Calle+falsa+123%0A%0ANombre%3A+Farez+Prieto%0A%0A--------------------------------%0A%0AP%C3%A1gina+web+econ%C3%B3mica+x+1+.+COP50000%0ACosto+de+env%C3%ADo+............+COP1%0A%0A--------------------------------%0A%0ATotal%3A+................+COP50001&app_absent=0
                var mensaje  = "Hola, mi nombre es "+$scope.infoUsuario.nombre+" "+$scope.infoUsuario.apellido+"%0A%0A";
                    mensaje += "Quisiera hacer un pedido con los siguientes productos.%0A%0A";
                    var totalPedido = 0;
                    for(var a in $scope.productosCarrito)
                    {
                        var valorCantidad = ($scope.productosCarrito[a].valorPresentacion * $scope.productosCarrito[a].cantidad);
                        mensaje += $scope.productosCarrito[a].nombrePresentacion+"%0A";
                        mensaje += $scope.productosCarrito[a].nombreVariacion+"%0A";
                        mensaje += "Cantidad: "+$scope.productosCarrito[a].cantidad+"%0A";
                        mensaje += "Valor unitario: $"+constantes.number_format($scope.productosCarrito[a].valorPresentacion,0,',','.')+"%0A";
                        mensaje += "Valor total $"+constantes.number_format(valorCantidad,0,',','.')+"%0A";
                        mensaje += "----------------------------------------------%0A%0A";
                        totalPedido += valorCantidad;
                    }
                    mensaje += "*TOTAL PEDIDO:* $"+constantes.number_format(totalPedido,0,',','.')+"%0A%0A";

                    mensaje += "Forma de pago: "+$scope.calculaFormaPago(formaPago)+"%0A";
                    mensaje += "Forma de envío: "+$scope.calculaFormaEnvio(formaEnvio)+"%0A";
                    if(formaEnvio == 2)
                    {
                        mensaje += "*Dirección:* "+direccion+"%0A";   
                    }
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
        return salida;
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
