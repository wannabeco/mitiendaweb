<?php 
        $referencia = $infoPedido['codigoPedido'];
    ?>
<div class="container"><br>
<center><img src="<?php echo base_url()?>res/img/logo.png" width="50%"></center><br>
<h3 class="text-center"><strong>Resumen del pedido</strong></h3><br>
<table class="table table-striped">
    <thead>
        <tr>
            <th style="background:#000;color:#fff">PRODUCTO</th>
            <th style="background:#000;color:#fff" class="text-center">CANT</th>
            <th style="background:#000;color:#fff" class="text-right">VALOR</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($productosPedido as $prodPed){?>
            <tr>
                <td><?php echo $prodPed['nombrePresentacion']?></td>
                <td class="text-center"><?php echo $prodPed['cantidad']?></td>
                <td class="text-right"><?php echo _SIMBOLO_MONEDA.number_format($prodPed['valorPresentacion'],0,',','.')?></td>
            </tr>
        <?php }?>
    </tbody>
    <tfoot>
        <tr>
            <th>TOTAL A PAGAR</th>
            <th colspan='2' class="text-right">
                <?php echo _SIMBOLO_MONEDA.number_format($infoPedido['valor'],0,',','.')?>
            </th>
        </tr>
    </tfoot>
</table>
<div class="alert alert-primary text-center" role="alert">
No cierre esta ventana hasta terminar la transacci&oacute;n, de lo contrario el pedido quedar&aacute; incompleto
</div>
</div>
<?php if($proveedor == 'payu'){
    //“ApiKey~merchantId~referenceCode~amount~currency”.
    $llave = md5(_PAYU_API_KEY."~"._PAYU_ID_MERCADO."~".$referencia."~".$infoPedido['valor']."~COP");
?>
    
    <div class="container">
        <?php //var_dump($infoPedido);?>
            <center>
            <form method="post" id="theForm" action="https://gateway.payulatam.com/ppp-web-gateway/">
                <input name="merchantId" id="merchantId"    type="hidden"  value="<?php echo _PAYU_ID_MERCADO?>">
                <input name="accountId"     type="hidden"  value="<?php echo _PAYU_ID_CUENTA?>" >
                <input name="description"   type="hidden"  value="<?php echo _NOMBRE_TRANSACCION?>"  >
                <input name="apKey" id="apKey"   type="hidden"  value="<?php echo _PAYU_API_KEY?>"  >
                <input name="referenceCode" id="referenceCode" type="hidden"  value="<?php echo $referencia?>" >
                <input name="amount"        type="hidden"  value="<?php echo $infoPedido['valor']?>"   >
                <input name="tax"           type="hidden"  value="0"  >
                <input name="taxReturnBase" type="hidden"  value="0" >
                <input name="currency" id="currency"    type="hidden"  value="COP">
                <input name="signature"  id="signature"   type="hidden"  value="<?php echo $llave?>">
                <input name="test"          type="hidden"  value="<?php echo _PAYU_TEST ?>" >
                <input name="buyerEmail"    type="hidden"  value="<?php echo $infoPedido['email']?>" >
                <input name="responseUrl"    type="hidden"  value="<?php echo base_url()._PAYU_LINK_RESP?>" >
                <input name="confirmationUrl"    type="hidden"  value="<?php echo base_url()._PAYU_LINK_CONFIRM?>" > 
                <button type="submit" class="btn btn-primary" style="background:#000;color:#fff">PAGAR AHORA</button>               
            </form><br><br>
        <img src="<?php echo base_url()?>/res/img/payuPagos.jpg" width="100%" alt="">
        <!-- <a onclick="this.close()" class="btn btn-primary">CERRAR VENTANA</a> -->
        </center>
    </div>
<?php }else if($proveedor == 'wompi'){?>
    <div class="container">
        <center>
            <form action="https://checkout.wompi.co/p/" method="GET">
                <!-- OBLIGATORIOS -->
                <input type="hidden" name="public-key" value="<?php echo _WOMPI_PUBLIC_KEY?>" />
                <input type="hidden" name="currency" value="COP" />
                <input type="hidden" name="amount-in-cents" value="<?php echo number_format($infoPedido['valor'],0,'','')?>00" />
                <input type="hidden" name="reference" value="<?php echo $referencia?>" />
                <!-- OPCIONALES -->
                <input type="hidden" name="redirect-url" value="<?php echo base_url()._WOMPI_LINK_CONFIRM?>" />
                <button type="submit" class="btn btn-primary" style="background:#000;color:#fff">PAGAR AHORA</button>
        </form><br><br>
        <img src="<?php echo base_url()?>/res/img/pagos-seguros-por-wompi.png" width="80%" alt="">
        <!-- <a onclick="this.close()" class="btn btn-primary">CERRAR VENTANA</a> -->
        </center>
    </div>
<?php }?>