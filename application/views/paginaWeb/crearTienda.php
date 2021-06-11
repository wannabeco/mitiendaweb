<?php
$claseColor = 'info';
?>
<!DOCTYPE html>
<html lang="es" ng-app="projectRegistro">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url()?>/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/uploads/files/">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    <?php echo $titulo ?>
  </title>
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?php echo base_url()?>/assets/css/material-kit.css?v=2.0.7&<?php echo rand(0,1000)?>" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url()?>/assets/demo/demo.css?<?php echo rand(0,1000)?>" rel="stylesheet" /> 
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/css/alertify.min.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/css/toast.min.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>res/css/sweetalert.css" />
</head>

<body class="index-page sidebar-collapse" id="paginaCompleta" ng-controller="crearController" ng-init="initCrear()">


    <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
        <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="#">
              <span><strong>Pedidos Colombia</strong></span>
            </a>

            <!-- boton de login en movil-->
            <!-- <a style="margin:0 0 0 150px" class="d-sm-block d-lg-none">
                <i class="material-icons">account_circle</i>
            </a> -->

            <a data-toggle="modal" data-target="#modalCarro" class="nav-link linkCarroMovil ocultoEnPc"  style="margin:0 0 0 50px">
                <i class="material-icons">shopping_cart</i>
                <span class="badge badge-danger cantCarroM">{{cantCarrito}}</span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">

            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-lg-block d-sm-none">
                    <a href="<?php echo base_URL()?>" class="nav-link"  style="cursor:pointer">
                        <strong>
                            <i class="material-icons">home</i> Inicio
                        </strong>
                    </a>
                </li>

            </ul>
        </div>
        </div>
    </nav>
    <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('<?php echo base_url()?>/assets/img/nuevaTienda.jpg');">
        <div class="container">
        <div class="row">
            <!-- <div class="col-lg-2 text-center">
                <div class="profile-photo-small">
                    <img src="<?php echo base_url()?>assets/uploads/files/" alt="Circle Image" class="rounded-circle logo">
                </div>
            </div> -->
            <div class="col-lg-10">
                <h1 class="tituloPrincipal" class="text-left"><strong><?php echo $titulo?></strong></h1>     
            </div>
        </div>
        </div>
    </div>

    <div class="main main-raised">
        <div class="section section-basic seccion">
            <div class="container">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-xs-12 ">
                            <h2>Estás a pocos pasos de tener una página de pedidos</h2>
                        </div>

                        <div class="col-xs-12 ">

                                <div id="datos-tienda">
                                    <h2 class="tituloCatalogo">1. Datos de la tienda</h2>
                                    Completa el formulario a continuación con los datos de contacto de tu tienda. Los campos con el * son obligatorios.<br><br>
                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                
                                                <label for="exampleInputEmail1"><strong>Nombre del negocio *</strong></label>
                                                <input type="text" style="text-transform:capitalize" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ejemplo: The Cupcakes Store">
                                                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                            </div>
                                        </div>
                                        
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1"><strong>Tipo de negocio *</strong></label>
                                                <select name="" id="" class="form-control">
                                                    <option value="">Seleccione...</option>
                                                    <option value="">Restaurante</option>
                                                    <option value="">Panadería</option>
                                                    <option value="">Tienda de mascotas</option>
                                                    <option value="">Cachivaches</option>
                                                    <option value="">Carnicería</option>
                                                    <option value="">Ferretería</option>
                                                    <option value="">Mini Mercado</option>
                                                    <option value="">Súper Mercado</option>
                                                    <option value="">Fruver</option>
                                                    <option value="">Sexshop</option>
                                                    <option value="">Papelería</option>
                                                    <option value="">Productos de aseo</option>
                                                    <option value="">Productos de belleza</option>
                                                    <option value="">Pizzería</option>
                                                    <option value="">Salsamentaria</option>
                                                </select>
                                            </div>
                                        </div>   

                                          
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><strong>Departamento *</strong></label>
                                                <select name="" id="" class="form-control">
                                                    <option value="">Seleccione...</option>
                                                    <option value="">TOLIMA</option>
                                                    <option value="">BOYACÁ</option>
                                                </select>
                                                <small id="emailHelp" class="form-text text-muted">Selecciona el departamento donde se ubica tu negocio.</small>
                                            </div>
                                        </div>
                                          
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><strong>Municipio *</strong></label>
                                                <select name="" id="" class="form-control">
                                                    <option value="">Seleccione...</option>
                                                    <option value="">TOLIMA</option>
                                                    <option value="">BOYACÁ</option>
                                                </select>
                                                <small id="emailHelp" class="form-text text-muted">Selecciona el municipio donde se ubica tu negocio.</small>
                                            </div>
                                        </div>

                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><strong>Dirección física *</strong></label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ejemplo: Calle 37 # 12 - 14">
                                                <small id="emailHelp" class="form-text text-muted">Ayúda a tus clientes a ubicarte.</small>
                                            </div>
                                        </div>
                                        
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><strong>Teléfono de contacto *</strong></label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Número de teléfono  de contacto">
                                                <!-- <small id="emailHelp" class="form-text text-muted">Ayúda a tus clientes a ubicarte.</small> -->
                                            </div>
                                        </div>
                                        
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><strong>Correo electrónico del negocio *</strong></label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ejemplo: info@thecupcakesstore.com">
                                                <!-- <small id="emailHelp" class="form-text text-muted">Ayúda a tus clientes a ubicarte.</small> -->
                                            </div>
                                        </div>
                                        
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><strong>Número de Whatsapp *</strong></label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ejemplo: 311 000 0000">
                                                <small id="emailHelp" class="form-text text-muted">A este número llegarán los pedidos que tus clientes realicen.</small>
                                            </div> 
                                        </div>
                                        
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><strong>Url de tu tienda *</strong></label>
                                                <div class="row">
                                                    <div class="col col-lg-7" style="padding-top:8px">
                                                        https://www.pedidoscolombia.com/tiendas/
                                                    </div>
                                                    <div class="col col-lg-5">
                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="theCupcakesStore">
                                                    </div>
                                                </div>
                                                <small  id="emailHelp" class="form-text text-muted">Esta es la url a la que accederean tus clientes.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--fin del form de datos de la página-->

                                 <!-- pestana datos logo-->
                                 <div  id="datosLogoTab">
                                    <h2 class="tituloCatalogo">2. Logo y banner</h2>
                                    La siguiente sección es para parametrizar el logo y el banner que darán vida a tu página web.<br><br>
                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <label for="banner"><strong>Logo del negocio *</strong></label>
                                            <div class="file-field">
                                                <div class="btn btn-primary btn-sm float-left">
                                                    <span>Selecciona el archivo</span>
                                                    <input type="file" name="logo">
                                                </div>
                                            </div><br><br>
                                            <small id="emailHelp" class="form-text text-muted">El logo debe ser en formato cuadrado máximo de 800px X 800px.</small> 
                                        </div>
                                        <div class="col col-lg-6">
                                            <label for="banner"><strong>Banner superior *</strong></label>
                                            <div class="file-field">
                                                <div class="btn btn-primary btn-sm float-left">
                                                    <span>Selecciona el archivo</span>
                                                    <input type="file" name="logo">
                                                </div>
                                            </div><br><br>
                                            <small id="emailHelp" class="form-text text-muted">Este banner se mostrará en la parte inicial de la página. Tamaño 1024 X 768px.</small> 
                                        </div>
                                    </div>
                                </div>
                                <!-- Fin pestaña logo y bannr-->

                                 <!-- pestana datos contacto-->
                                 <div  id="datosContactoTab">
                                    <h2 class="tituloCatalogo">3. Información del dueño o encargado del negocio</h2>
                                    Esta información no será compartida con ningún cliente, solo se usa para temas de registro y creación de la tienda.<br><br>
                                    <div class="row">

                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label for="file"><strong>Nombres*</strong></label>
                                                <input type="text" class="form-control" id="file" name="logo" placeholder="Ejemplo: Jhon">
                                                <!-- <small id="emailHelp" class="form-text text-muted">El logo debe ser en formato cuadrado máximo de 800px X 800px.</small>  -->
                                            </div>
                                        </div>

                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label for="file"><strong>Apellidos*</strong></label>
                                                <input type="text" class="form-control" id="file" name="logo" placeholder="Ejemplo: Puerto">
                                                <!-- <small id="emailHelp" class="form-text text-muted">El logo debe ser en formato cuadrado máximo de 800px X 800px.</small>  -->
                                            </div>
                                        </div>

                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label for="file"><strong>Correo electrónico*</strong></label>
                                                <input type="text" class="form-control" id="file" name="logo" placeholder="Ejemplo: micorreopersonal@gmail.com">
                                                <small id="emailHelp" class="form-text text-muted">Por medio de este email te contactaremos y con el podrás ingresar a la zona administrativa.</small> 
                                            </div>
                                        </div>

                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label for="file"><strong>Número de celular*</strong></label>
                                                <input type="text" class="form-control" id="file" name="logo" placeholder="Ejemplo: micorreopersonal@gmail.com">
                                                <small id="emailHelp" class="form-text text-muted">Por si necesitamos contactarte.</small> 
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- Fin pestaña contacto-->

                        </div>
                        <div class="col col-lg-12 text-right">
                            <button class="btn btn-primary">CREAR TIENDA</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
 
  <!--  End Modal -->
  <footer class="footer" data-background-color="black">
    <div class="container">
      <nav class="float-left">
        <ul>
            <li>
                <a href="#" target="_blank" data-original-title="" rel="nofollow">
                    <i class="fa fa-facebook"></i> Link
                </a>
            </li> 
        </ul>
      </nav>
      <div class="copyright float-right">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>, hecha con el <i class="material-icons">favorite</i> por
        <a href="https://www.wannabe.com.co/" title="Wannabe Digital, Diseño y desarrollo de páginas web y tiendas virtuales." class="text-<?php echo $claseColor?>" target="_blank">Wannabe </a>
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="<?php echo base_url()?>/assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="<?php echo base_url()?>/assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="<?php echo base_url()?>/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->

  <script type="text/javascript" src="<?php echo base_url()?>res/js/sweetalert.min.js"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  
 <script type="text/javascript" src="<?php echo base_url()?>/assets/js/alertify.min.js"></script>
 
 <script type="text/javascript" src="<?php echo base_url()?>/assets/js/toast.min.js"></script>
  <script src="<?php echo base_url()?>/assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
  <script src="https://apis.google.com/js/platform.js" async defer></script>

  <script type="text/javascript" src="<?php echo base_url()?>res/js/angular.min.js"></script>
  <script data-require="angular-ui-bootstrap@0.3.0" data-semver="0.3.0" src="<?php echo base_url()?>/assets/js/ui-bootstrap-tpls-0.3.0.min.js"></script>
  <script src="<?php echo base_url()?>/res/js/app.js?<?php echo rand(0,1000)?>" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url()?>res/js/factory.js?<?php echo rand(0,10000)?>"></script>
  <script type="text/javascript" src="<?php echo base_url()?>res/js/home/paginaController.js?<?php echo rand(0,10000)?>"></script>
  

  <script src="<?php echo base_url()?>/assets/js/tienda.js?<?php echo rand(0,1000)?>" type="text/javascript"></script>

  
  <script type="text/javascript" src="https://www.wannabe.com.co/js/kon.min.js"></script>
  <script>

    var configLogin =  {
            apiUrl: '<?php echo base_url()?>',
            urlAPi: '<?php echo base_url()?>Api/'
        }

    $(document).ready(function() {

        
      //init DateTimePickers
      materialKit.initFormExtendedDatetimepickers();

      // Sliders Init
      //materialKit.initSliders();
    });


   
  </script>


</html>