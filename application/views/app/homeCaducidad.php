<div class="container-fluid" ng-controller="home" ng-init="initHome()">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Bienvenido <small> <?php echo $_SESSION['project']['info']['nombre'] ?> <?php echo $_SESSION['project']['info']['apellido'] ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-home"></i> Home
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Tu licencia ha caducado</h2>
                        <p>Para poder seguir utlizando los beneficios de nuestra aplicación debes activar nuevamente un plan</p><br><br>

                        <div class="row text-center">
                            <div class="col col-lg-4 col-md-4">
                                <div class="card box-shadow">
                                  <div class="card-header">
                                    <h4 class="my-0 font-weight-normal">MENSUAL</h4>
                                  </div>
                                  <div class="card-body">
                                    <h1 class="card-title pricing-card-title">$29.900 <small class="text-muted">/ Mensual</small></h1>
                                    <ul class="list-unstyled mt-3 lg-4">
                                      <li>20 users included</li>
                                      <li>10 GB of storage</li>
                                      <li>Priority email support</li>
                                      <li>Help center access</li>
                                    </ul>
                                    <button type="button" class="btn btn-lg btn-block btn-primary">CONTÁCTENOS</button>
                                  </div>
                                </div>
                            </div>
                            <div class="col col-lg-4 col-md-4">
                                <div class="card box-shadow">
                                  <div class="card-header">
                                    <h4 class="my-0 font-weight-normal">ANUAL</h4>
                                  </div>
                                  <div class="card-body">
                                    <h1 class="card-title pricing-card-title">$299.900 <small class="text-muted">/ Año</small></h1>
                                    <ul class="list-unstyled mt-3 lg-4">
                                      <li>30 users included</li>
                                      <li>15 GB of storage</li>
                                      <li>Phone and email support</li>
                                      <li>Help center access</li>
                                    </ul>
                                    <button type="button" class="btn btn-lg btn-block btn-primary">CONTÁCTENOS</button>
                                  </div>
                                </div>
                            </div>
                            
                            <div class="col col-lg-2 col-md-2"></div>
                        </div>
      


                    </div>
                </div>
                <!-- /.row -->



            </div>
            <!-- /.container-fluid -->