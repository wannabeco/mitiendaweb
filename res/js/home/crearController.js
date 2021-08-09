
project.controller('crearController', function($scope,$http,$q,constantes)
{
    
	$scope.config = configLogin;
    $scope.municipios = [];
    $scope.initCrear = function()
    {
        console.log("crear");
    }
    //código para las pestañas de la página
    $scope.cambiaPestana = function(p)
    {
        $(".nav-item").addClass("disabled")
        $(".nav-item").removeClass("active")
        $(p).removeClass("disabled")
        $(p).addClass("active")
    }

    //consulto la tienda que necesito
    $scope.consultaMunicipio = function()
    {
        var depto = $("#idDepartamento").val();
        var controlador = $scope.config.apiUrl+"Inicio/getMunicipios";
        var parametros  = {idDepartamento:depto};
        constantes.consultaApi(controlador,parametros,function(json){
            if(json.continuar == 1)
            {
                $scope.municipios = json.datos;
                $("#idCiudad").removeAttr("disabled");
                $scope.$digest();
            }
            
        },'json');
    }
    $scope.crearTienda = function()
    {
        var nombreTienda = $("#nombreTienda").val();
        var idTipoTienda = $("#idTipoTienda").val();
        var idDepartamento = $("#idDepartamento").val();
        var idCiudad = $("#idCiudad").val();
        var direccionTienda = $("#direccionTienda").val();
        var telefonoTienda = $("#telefonoTienda").val();
        var correoTienda = $("#correoTienda").val();
        var celularTienda = $("#celularTienda").val();
        var urlAmigable = $("#urlAmigable").val();
        var logoTienda = $("#logoTienda").val();
        var bannerTienda = $("#bannerTienda").val();
        var nombre = $("#nombre").val();
        var apellido = $("#apellido").val();
        var email = $("#email").val();
        var celular = $("#celular").val();
        var clave = $("#clave").val();
        var rclave = $("#rclave").val();
        //validación de capos
        if(nombreTienda == "")
        {
            constantes.alerta("Atención","Debes escribir el nombre de tu negocio","info",function(){
                $("#panel1").addClass("is-focused");
            });
        }
        else if(idTipoTienda == "")
        {
            constantes.alerta("Atención","Debes seleccionar el tipo de negocio","info",function(){
                $("#panel2").addClass("is-focused");
            });
        }
        else if(idDepartamento == "")
        {
            constantes.alerta("Atención","Debes seleccionar el departamento donde está ubicado tu negocio","info",function(){
                $("#panel3").addClass("is-focused");
            });
        }
        else if(idCiudad == "")
        {
            constantes.alerta("Atención","Debe seleccionar la ciudad donde está ubicado tu negocio","info",function(){
                $("#panel4").addClass("is-focused");
            });
        }
        else if(direccionTienda == "")
        {
            constantes.alerta("Atención","Por favor escribe la dirección física de tu negocio","info",function(){
                $("#panel5").addClass("is-focused");
            });
        }
        else if(telefonoTienda == "")
        {
            constantes.alerta("Atención","Por favor escribe un teléfono de contacto para tus clientes","info",function(){
                $("#panel6").addClass("is-focused");
            });
        }
        else if(correoTienda == "")
        {
            constantes.alerta("Atención","Por favor escribe el correo electrónico que utiliza tu tienda","info",function(){
                $("#panel7").addClass("is-focused");
            });
        }
        else if(celularTienda == "")
        {
            constantes.alerta("Atención","Por favor escribe el número de Whatsapp donde deben llegar los pedidos que tus clientes realicen.","info",function(){
                $("#panel8").addClass("is-focused");
            });
        }
        else if(urlAmigable == "")
        {
            constantes.alerta("Atención","La url amigable ayuda a los clientes a llegar al espacio digital de tu tienda, debes ser muy original.","info",function(){
                $("#panel9").addClass("is-focused");
            });
        }
        else if(logoTienda == "")
        {
            constantes.alerta("Atención","Selecciona el logo de tu negocio, este dará más identidad al sitio.","info",function(){
                $("#panelLogo").addClass("is-focused");
            });
        }
        else if(nombre == "")
        {
            constantes.alerta("Atención","Por favor escribe el nombre del encargado o dueño del negocio.","info",function(){
                $("#panel10").addClass("is-focused");
            });
        }
        else if(apellido == "")
        {
            constantes.alerta("Atención","Por favor escribe el apellido del encargado o dueño del negocio.","info",function(){
                $("#panel11").addClass("is-focused");
            });
        }
        else if(email == "")
        {
            constantes.alerta("Atención","Por favor escribe el correo electrónico del encargado o dueño del negocio.","info",function(){
                $("#panel12").addClass("is-focused");
            });
        }
        else if(clave == "")
        {
            constantes.alerta("Atención","Por favor escribe una contraseña de acceso para tu cuenta.","info",function(){
                $("#panel14").addClass("is-focused");
            });
        }
        else if(clave != "" && clave.length < 6)
        {
            constantes.alerta("Atención","La contraseña debe tener por lo menos 6 caracteres.","info",function(){
                $("#panel14").addClass("is-focused");
            });
        }
        else if(rclave == "")
        {
            constantes.alerta("Atención","Por favor repite la contraseña de acceso para tu cuenta.","info",function(){
                $("#panel15").addClass("is-focused");
            });
        }
        else if(rclave != clave)
        {
            constantes.alerta("Atención","Las contraseñas no coinciden, por favor verifica.","info",function(){
                $("#panel15").addClass("is-focused");
            });
        }
        else 
        {
            constantes.confirmacion("Atención","Estás a punto de crear un negocio con la información proporcionada, ¿Deseas continuar?","info",function()
            {

                var formData 	=   new FormData($("#dataForm")[0]);
		        var controlador = 	$scope.config.apiUrl+"Tienda/crearTienda"; 
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
								document.location = $scope.config.apiUrl+"registroExitoso/"+json.datos.idTienda
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

});