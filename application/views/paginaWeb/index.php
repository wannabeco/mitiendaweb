<?php
$claseColor = 'info';
?>
<!DOCTYPE html>
<html lang="es" ng-app="projectRegistro">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url()?>/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/uploads/files/<?php echo $infoTienda['logoTienda'] ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    <?php echo $infoTienda['nombreTienda'] ?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <meta name="google-signin-client_id" content="33041979845-cglrtjrh3vrk111kllpg3glqek9s43mg.apps.googleusercontent.com">
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

<body class="index-page sidebar-collapse" id="paginaCompleta" ng-controller="paginaController" ng-init="initPagina()">


<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>INICIA SESIÓN</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Hola, para poder realizar pedidos o dar "Me gusta" a los productos debes identificarte primero. <br><br>Selecciona una cuenta de tu preferencia.</p><br>
        <div class="row">
          <div class="col col-lg-4 col-md-4 col-sm-4 col-xs-4">
              <div class="g-signin2" data-width="100%" data-onsuccess="onSignIn"></div> &nbsp;
          </div>
          <div class="col col-lg-8 col-md-8 col-sm-8 col-xs-8">
              <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></div>
          </div>
        </div>
        
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>


<div class="modal fade" id="modalCarro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>CARRITO DE COMPRA</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Productos listos para solicitar a la tienda</p><br>
        
        <div class="alert alert-info" ng-if="productosCarrito.length == 0">
          <div class="container">
            <div class="alert-icon">
              <i class="material-icons">info_outline</i>
            </div>
            No hay productos agregados al carrito
          </div>
        </div>
        <!-- Tabla de productos del carrito-->
        <table class="table" ng-if="productosCarrito.length != 0">
          <tr ng-repeat="carrito in productosCarrito">
            <td>
              <img src="<?php echo base_url()?>assets/uploads/files/{{carrito.idTienda}}/{{carrito.fotoProducto}}" height="80px" alt="" ng-if="carrito.fotoProducto != ''">
              <img src="<?php echo base_url()?>assets/img/sinImagen.png" height="200px" width="100%" alt="" ng-if="carrito.fotoProducto == ''">
            </td>
            <td>
                <button type="button" class="close" ng-click="quitarDelCarrito(carrito.idPedidoTemp)">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 style="padding:0;margin:0;line-height: 20px">{{carrito.nombrePresentacion}}</h5>
                <h6 style="padding:0;margin:0;line-height: 20px">{{carrito.nombreVariacion}}</h6>
                <h6 style="padding:0;margin:0;line-height: 20px">Valor unitario: {{carrito.valorPresentacion | currency:'$':0}}</h6>
                <h6 style="padding:0;margin:0;line-height: 20px">Valor total: {{carrito.valorPresentacion * carrito.cantidad | currency:'$':0}}</h6>
                <p>Cantidad: {{carrito.cantidad}}</p>
                <div class="row noPadding">
                  <div class="col col-lg-2 col-md-2 col-sm-2 col-xs-2 noPadding" style="float:left">
                    <button ng-click="restaCantidad($index,carrito.idPedidoTemp)" class="btn elCaja btn-sm  btn-<?php echo $claseColor?>"><strong>-</strong></button>
                  </div>
                  <div class="col col-lg-2 col-md-2 col-sm-2 col-xs-2 noPadding" style="float:left">
                    <input type="text" class=" elCaja form-control text-center" id="cajaCant{{$index}}" name="" value="{{carrito.cantidad}}">
                  </div>
                  <div class="col col-lg-2 col-md-2 col-sm-2 col-xs-2 noPadding" style="float:left">
                    <button ng-click="sumaCantidad($index,carrito.idPedidoTemp)" class="btn elCaja btn-sm btn-<?php echo $claseColor?>"><strong>+</strong></button>
                  </div>
                </div>
            </td> 
          </tr>
        </table>

        <h3 ng-if="productosCarrito.length != 0" class="text-center">TOTAL PEDIDO: {{totalPedido | currency:"$":0}}</h3>
        
        <div class="row"  ng-if="productosCarrito.length != 0">
          <div class="col-lg-12  col-md-12 col-xs-12 col-md-12">
            <div class="form-group">
                <h5 class="modal-title" id="selEnvio"><strong>FORMA DE ENVÍO</strong></h5>
                <select name="selEnvio" id="selEnvio" class="form-control" onchange="cambiaEnvio(this)">
                    <option value="1">RECOGER EN TIENDA</option>
                    <option value="2">ENVIARLO A MI DIRECCIÓN</option>
                </select>
            </div>
          </div>
          <div class="col-lg-12  col-md-12 col-xs-12 col-md-12" id="cajaDir" style="display:none">
            <div class="form-group">
                <h5 class="modal-title" id="direccion"><strong>DIRECCIÓN</strong></h5>
                <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Escribe la dirección donde quieres que te entreguen el pedido" />
            </div>
          </div>
          <div class="col-lg-12  col-md-12 col-xs-12 col-md-12">
            <div class="form-group">
                <h5 class="modal-title" id="formaPago"><strong>FORMA DE PAGO</strong></h5>
                <select name="formaPago" id="formaPago" class="form-control" >
                    <option value="1">TARJETA DE CRÉDITO</option>
                    <option value="2">TARJETA DÉBITO</option>
                    <option value="3">NEQUI</option>
                    <option value="4">DAVIPLATA</option>
                    <option value="5">EFECTIVO</option>
                </select>
            </div>
          </div>
        </div>


        <button class="btn btn-<?php echo $claseColor?> btn-block" ng-click="hacerPedido()" ng-if="productosCarrito.length != 0">
          <strong>HACER PEDIDO</strong>
        </button>

      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>






<div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v10.0&appId=451969922682583&autoLogAppEvents=1" nonce="Kh313daN"></script>

 <!-- pie movil con la infro del carrito-->
  <nav class="navbar navbar-expand-lg bg-dark d-sm-block d-lg-none" style="position: fixed;bottom:0;z-index: 200;width: 100%;margin:0;border-radius: 0">
    <a data-toggle="modal" data-target="#modalCarro" class="nav-link linkCarroMovil">
        <i class="material-icons">shopping_cart</i>
        <span class="badge badge-danger cantCarroM">{{cantCarrito}}</span>
    </a>
  </nav>


    <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
        <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="https://demos.creative-tim.com/material-kit/index.html">
              <span class="d-sm-block d-lg-none"><strong><?php echo $infoTienda['nombreTienda'] ?></strong></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">

           <!--  <form class="form-inline ">
              <div class="form-group has-white">
                <input type="text" class="form-control" placeholder="Buscar productos en <?php echo $infoTienda['nombreTienda'] ?>">
              </div>
              <button type="submit" class="btn btn-white btn-raised btn-fab btn-round">
                <i class="material-icons">search</i>
              </button>
            </form> -->

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a data-toggle="modal" data-target="#modalCarro" class="nav-link">
                        <i class="material-icons">shopping_cart</i>
                        <span class="badge badge-danger cantCarro">{{cantCarrito}}</span>
                    </a>
                </li>
                <li class="nav-item" ng-if="logueado == 0">
                    <a data-toggle="modal" data-target="#modalLogin" class="nav-link"  style="cursor:pointer"><strong><i class="material-icons">account_circle</i> INGRESAR</strong></a>
                </li>

                <li class="dropdown nav-item" ng-if="logueado == 1">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="material-icons">account_circle</i>
                        <!-- <img src="{{infoUsuario.foto}}" style="width: 20px;border-radius: 50%;margin:0 5px 0 0 "> -->
                        {{infoUsuario.nombre}} 
                    </a>
                    <div class="dropdown-menu dropdown-with-icons">
                        <a  style="cursor: pointer" ng-click="cerrarSession()" class="dropdown-item">
                            <i class="fa fa-sign-out"></i> Cerrar sesión
                        </a>
                    </div>
                </li>
            </ul>
        </div>
        </div>
    </nav>
    <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('<?php echo base_url()?>/assets/uploads/files/<?php echo $infoTienda['bannerTienda'] ?>');">
        <div class="container">
        <div class="row">
            <div class="col-lg-2 text-center">
                <div class="profile-photo-small">
                    <img src="<?php echo base_url()?>assets/uploads/files/<?php echo $infoTienda['logoTienda'] ?>" alt="Circle Image" class="rounded-circle logo">
                </div>
            </div>
            <div class="col-lg-10">
                <h1 class="tituloPrincipal" class="text-left"><strong><?php echo $infoTienda['nombreTienda'] ?></strong></h1>
                <h3 class="infoTienda" class="text-left"><i class="fa fa-whatsapp"></i> <?php echo $infoTienda['celularTienda'] ?></h3>
                <h3 class="infoTienda" class="text-left"><i class="fa fa-map-marker"></i> <?php echo $infoTienda['direccionTienda'] ?></h3>
                <h3 class="infoTienda" class="text-left"><i class="fa fa-envelope"></i> <?php echo $infoTienda['correoTienda'] ?></h3>
                <h3 class="infoTienda" class="text-left">
                  Síguenos en: 
                  <?php if($infoTienda['urlTwitter']){?>
                      <a href="<?php echo $infoTienda['urlTwitter']?>" class="redesCabeza" target="_blank" data-original-title="Síguenos en Twitter" rel="nofollow">
                        <i class="fa fa-twitter"></i>
                      </a> 
                  <?php }?>
                  <?php if($infoTienda['urlFacebook']){?>
                      <a href="<?php echo $infoTienda['urlFacebook']?>" class="redesCabeza" target="_blank" data-original-title="Síguenos en Facebook" rel="nofollow">
                          <i class="fa fa-facebook-square"></i>
                      </a>
                  <?php }?>
                  <?php if($infoTienda['urlInstagram']){?>
                      <a href="<?php echo $infoTienda['urlInstagram']?>" class="redesCabeza" target="_blank" data-original-title="Síguenos en Instagram" rel="nofollow">
                          <i class="fa fa-instagram"></i>
                      </a>
                  <?php }?>
                  <?php if($infoTienda['urlLinkedin']){?>
                      <a href="<?php echo $infoTienda['urlLinkedin']?>" class="redesCabeza" target="_blank" data-original-title="Síguenos en Linkedin" rel="nofollow">
                          <i class="fa fa-linkedin"></i>
                      </a>
                  <?php }?>
                </h3>
                
            </div>
        </div>
        </div>
    </div>

    <div class="main main-raised">
      <div class="section section-basic seccion">
        <div class="container">
          <div class="title">
            <h2 class="tituloCatalogo">Catálogo de productos</h2>
          </div>
        
          <div class="row">
              <div class="col-lg-4 col-md-4">
                <div class="form-group">
                    <label for="categoria">Categorías</label>
                    <select name="categoria" id="categoria" ng-model="categoria" class="form-control" ng-change="buscarSubCategorias()">
                        <!-- <option value="">TODAS</option> -->
                        <option ng-repeat="cat in categorias" value="{{cat.idProducto}}" >{{cat.nombreProducto}}</option>
                    </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group">
                    <label for="subcategoria">Sub Categorías</label>
                    <select name="subcategoria" id="subcategoria" ng-model="subcategoria" class="form-control" ng-change="getProductos()" ng-disabled="disableSubca">
                        <!-- <option value="">TODAS</option> -->
                        <option ng-repeat="subcat in subcategorias" value="{{subcat.idSubcategoria}}" >{{subcat.nombreSubcategoria}}</option>
                    </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group">
                    <label for="categorias">Filtrar por nombre</label>
                    <input type="text" class="form-control" placeholder="ESCRIBE UNA PALABRA" ng-model="q">
                </div>
              </div>

          </div>


          
          

          <div class="row">
            <div class="col-lg-12" ng-if="productos.length == 0">
                <div class="alert alert-info">
                  <div class="container">
                    <div class="alert-icon">
                      <i class="material-icons">info_outline</i>
                    </div>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button> -->
                    <b>Atención:</b> No hay productos en las categorias seleccionadas
                  </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 " ng-repeat="prod in productos | filter:q as results">
                <div class="card text-center tarjetaProd" ng-init="cargaDataVariacion(prod.primerVariacion,prod.idPresentacion,$index)" id="contProd{{prod.idPresentacion}}">
                    <div class="card-body">
                        
                        <span class="badge badge-danger nuevoProd"  ng-if="prod.nuevo == 'Si' " >Nuevo</span>

                        <span class="badge badge-warning descProd" ng-if="dataVar[$index].descuento > 0 ">{{dataVar[$index].descuento }}% de descuento</span>


                        <img src="<?php echo base_url()?>assets/uploads/files/{{prod.idTienda}}/{{prod.fotoPresentacion}}" height="200px" alt="" ng-if="prod.fotoPresentacion != ''">
                        <img src="<?php echo base_url()?>assets/img/sinImagen.png" height="200px" width="100%" alt="" ng-if="prod.fotoPresentacion == ''"><br><br>
                        <h6 class="card-title tituloProducto">{{prod.nombrePresentacion}}</h6>
                        <h4 class="card-title precioProducto" id="precios{{prod.idPresentacion}}">
                            <span ng-if="dataVar[$index].valorAnterior > 0">Ahora: {{dataVar[$index].valorPresentacion | currency:"$":0}} </span>
                            <span ng-if="dataVar[$index].valorAnterior == 0">Precio: {{dataVar[$index].valorPresentacion | currency:"$":0}} </span>
                            <span class="valorAntes" ng-if="dataVar[$index].valorAnterior > 0"> Antes: {{dataVar[$index].valorAnterior | currency:"$":0}}</span>
                        </h4>
                        <p class="card-text parrafoTextoProducto">{{prod.descripcionCorta | limitTo : 110}}<span ng-if="prod.descripcionCorta.length > 110">...</span></p>
                        <select class="form-control text-center" id="selVar{{prod.idPresentacion}}" data-index="{{$index}}" rel="{{prod.idPresentacion}}" onchange="cambiaVariacion(this)">
                            <option ng-repeat="vari in prod.variaciones" value="{{vari.idVariacion}}">{{vari.nombreVariacion}}</option>
                        </select><br>
                        <a class="text-white btn btn-<?php echo $claseColor?>" ng-if="prod.agotado == 'No' " ng-click="agregarCarrito(prod.idPresentacion)"><i class="material-icons">shopping_cart</i> Añadir al carrito</a>
                        <button class="text-white btn btn-default" ng-if="prod.agotado == 'Si' " disabled>PRODUCTO AGOTADO</button>
                        <a class="text-white btn btn-<?php echo $claseColor?>" style="padding-left:15px !important;padding-right:15px !important;" ng-click="likes(prod.idPresentacion)"><i class="material-icons">favorite</i> {{procesaLikes(prod.likes)}}</a>
                    </div>
                </div>
            </div>  
          </div>
          
          <!-- Paginador -->
          <div class="row">
            <div class="col-lg-12 text-right">

              <div ng-if="productos.length != 0" data-pagination="" data-num-pages="numPages()" 
      data-current-page="currentPage" data-max-size="maxSize"  
      data-boundary-links="true"></div>

                <!-- <ul class="pagination pagination-<?php echo $claseColor?>" style="margin:auto">
                  <li class="page-item"><a href="javascript:void(0);" class="page-link"> prev</a></li>
                  <li class="page-item"><a href="javascript:void(0);" class="page-link">1</a></li>
                  <li class="page-item"><a href="javascript:void(0);" class="page-link">2</a></li>
                  <li class="active page-item"><a href="javascript:void(0);" class="page-link">3</a></li>
                  <li class="page-item"><a href="javascript:void(0);" class="page-link">4</a></li>
                  <li class="page-item"><a href="javascript:void(0);" class="page-link">5</a></li>
                  <li class="page-item"><a href="javascript:void(0);" class="page-link">next </a></li>
                </ul> -->
            </div>
          </div>

        </div>
      </div>
    </div>
 
  <!--  End Modal -->
  <footer class="footer" data-background-color="black">
    <div class="container">
      <nav class="float-left">
        <ul>
          <!-- <li>
              <a href="https://twitter.com/CreativeTim" target="_blank" data-original-title="Síguenos en Twitter" rel="nofollow">
                <i class="fa fa-twitter"></i> Twitter
              </a>
          </li>
 -->
    
          <?php if($infoTienda['urlFacebook']){?>
              <li>
                  <a href="<?php echo $infoTienda['urlFacebook']?>" target="_blank" data-original-title="Síguenos en Facebook" rel="nofollow">
                    <i class="fa fa-facebook"></i> Facebook
                  </a>
              </li> 
          <?php }?>

          <?php if($infoTienda['urlTwitter']){?>
              <li>
                  <a href="<?php echo $infoTienda['urlTwitter']?>" target="_blank" data-original-title="Síguenos en Twitter" rel="nofollow">
                    <i class="fa fa-twitter"></i> Twitter
                  </a>
              </li> 
          <?php }?>

          <?php if($infoTienda['urlInstagram']){?>
              <li>
                  <a href="<?php echo $infoTienda['urlInstagram']?>" target="_blank" data-original-title="Síguenos en Instagram" rel="nofollow">
                    <i class="fa fa-instagram"></i> Instagram
                  </a>
              </li> 
          <?php }?>

          <?php if($infoTienda['urlLinkedin']){?>
              <li>
                  <a href="<?php echo $infoTienda['urlLinkedin']?>" target="_blank" data-original-title="Síguenos en Linkedin" rel="nofollow">
                    <i class="fa fa-linkedin"></i> Linkedin
                  </a>
              </li> 
          <?php }?>

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
            urlAPi: '<?php echo base_url()?>Api/',
            infoTienda: <?php echo json_encode($infoTienda)?>
        }

    $(document).ready(function() {

        
      //init DateTimePickers
      materialKit.initFormExtendedDatetimepickers();

      // Sliders Init
      //materialKit.initSliders();
    });


    function scrollToDownload() {
      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-download').offset().top
        }, 1000);
      }
    }


    function cambiaVariacion(el)
    {
      var id               = $(el).attr("id");
      var idPresentacion   = $(el).attr("rel");
      var prod             = $(el).data("index");
      var variacionSel     = $("#"+id).val();

      angular.element(document.getElementById('paginaCompleta')).scope().cargaDataVariacionUnitaria(variacionSel,idPresentacion,prod);

    }

    function cambiaEnvio(el)
    {
      var envioForma = $(el).val();
      if(envioForma == 2)
      {
          $("#cajaDir").show();
      }
      else
      {
          $("#cajaDir").hide();
      }
    }
  </script>


</html>