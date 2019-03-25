
<?php
  require_once "../../clases/Conexion.php";
  require_once "../../clases/Ventas.php";

  $obj= new ventas();

  $c= new conectar();
  $conexion=$c->conexion();
  $fecha = $_GET['fecha'];
  $total = 0;

  if ($fecha == 0) {
    $fecha = date('Y-m-d');
  } else {
    $date = explode("/",$fecha);
    $fecha = $date[2].'-'.$date[1].'-'.$date[0];
  }

  $sql="SELECT id_venta,
               fechaCompra,
               id_cliente
          from ventas
         where fechaCompra = '$fecha'
      group by id_venta desc";
  $result=mysqli_query($conexion,$sql);
?>

<div class="table-responsive">
  <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
    <tr>
      <td><b>Folio</b></td>
      <td><b>Fecha</b></td>
      <td><b>Cliente</b></td>
      <td><b>Total de compra</b></td>
    <td><b>Imprimir</b></td>

    </tr>
<?php
  while($ver=mysqli_fetch_row($result)):
?>
    <tr>
      <td><?php echo $ver[0] ?></td>
      <td><?php echo $ver[1] ?></td>
      <td>
        <?php
          echo $obj->nombreCliente($ver[2]);
        ?>
      </td>
      <td>
        <?php
          $importe = $obj->obtenerTotal($ver[0]);
          echo "S/ ".$importe;
         ?>
      </td>
      <td>
        <span class="btn btn-success" id="btnImprimir<?php echo $ver[0]; ?>">
          <span class="glyphicon glyphicon-print"></span>
        </span>
      </td>
    </tr>

    <div hidden>
      <div id="cargaImpVenta<?php echo $ver[0]; ?>" class="formatoVenta<?php echo $ver[0]; ?>"></div>
    </div>

 <script type="text/javascript">
   $(document).ready(function(){
     $('#cargaImpVenta<?php echo $ver[0]; ?>').load('ventas/impVenta.php?movimi=<?php echo $ver[0]; ?>');

     $('#btnImprimir<?php echo $ver[0]; ?>').click(function(){
      $(".formatoVenta<?php echo $ver[0]; ?>").printThis();
      });
   });
 </script>

<?php
  $total = $total + $importe;
  endwhile;
?>
  <tr>
    <td colspan="3" style="text-align: right"> <b>Cuenta Total:</b> </td>
    <td> <b><?php echo "S/ ".$total.".00"; ?></b> </td>
  </tr>
</table>
</div>
