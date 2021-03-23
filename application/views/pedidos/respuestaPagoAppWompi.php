<div class="container-fluid" ng-controller="pedidos" ng-init="nuevoPedidoInit()" id="contenedorUsuarios">

<div id="modalUsuarios" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="modalCrea">
            <!--Form de creación -->
        </div>
    </div>
</div>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <br>
            <center><img src="<?php echo base_url()?>res/img/logo.png" width="50%"></center><br>
            <h4 class="text-center">
                <strong>Resumen de la transacción</strong>
            </h4>
        </div>
    </div> 
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
                <?php
                        ?>
                            <table class="table">
                            <tr>
                            <td>Estado de la transaccion</td>
                            <td><span class="label <?php echo $claseLabel ?>"><?php echo $estadoTx; ?></span></td>
                            </tr>
                            <tr>
                            <tr>
                            <td>ID de la transaccion</td>
                            <td><?php echo $transactionId; ?></td>
                            </tr>
                            <tr>
                            <td>Código del pedido</td>
                            <td><?php echo $referenceCode; ?></td> 
                            </tr>
                            <tr>
                            <td>Método de pago</td>
                            <td><?php echo $lapPaymentMethod; ?></td> 
                            </tr>
                           
                            <td>Valor total</td>
                            <td>$<?php echo number_format($valor); ?></td>
                            </tr>
                            </table>
                        
                            <div class="alert alert-primary text-center">
                <strong>AHORA PUEDES CERRAR ESTA VENTANA</strong>
</div>

        </div>
    </div>
    <!-- /.row -->
 </div>
<!-- /.container-fluid -->