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
                <form method="post" enctype="multipart/form-data" ng-submit="crearTienda()" id="dataForm">
                    <div class="row">
                        <div class="col-xs-12 ">
                            <h2>¡Gracias por unirte a la familia de Pedidos Colombia <strong><?php echo $infoTienda['nombreTienda'] ?></strong>!</h2><br><br>
                        </div>

                        <div class="col-lg-6 ">
                            <img src="<?php echo base_url()?>res/img/gracias-por-tu-registro.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-6 ">
                                <!-- pestana datos logo-->
                            <div  id="datosLogoTab">
                                <!-- <h2 class="tituloCatalogo">Gracias por unirte a la familia de Pedidos Colombia</h2> -->
                                Desde este momento podrás iniciar a crear los productos de tu negocio. Recuerda para para acceder a tu cuenta deberas hacer click en el botón que verás a continuación, tus datos de acceso con el correo electrónico del propietario y la contraseña que registraste<br><br>
                                <a href="<?php echo base_url()?>App" target="blank" title="Ir al panel administrativo" class="btn btn-primary">IR AL PANEL ADMINISTRATIVO</a><br><br>
                                También podrás visitar la página web que creamos para tu negocio, solo debes hacer click en el siguiente botón<br><br>
                                <a href="<?php echo base_url()?>tiendas/<?php echo $infoTienda['urlAmigable'] ?>" target="blank" title="Visitar mi tienda" class="btn btn-primary">VISITAR MI PÁGINA</a><br><br>
                                Recuerda que la URL que podrás compartir a tus clientes es la siguiente: <br><br>
                                <h3><?php echo base_url()?>tiendas/<?php echo $infoTienda['urlAmigable'] ?></h3>
                                <br><br>
                            </div>
                            <!-- Fin pestaña logo y banner-->
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
  <script type="text/javascript" src="<?php echo base_url()?>res/js/home/crearController.js?<?php echo rand(0,10000)?>"></script>
  

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