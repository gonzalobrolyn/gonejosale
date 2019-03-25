
<?php
  session_start();
  require_once "../../clases/Conexion.php";

  $c = new conectar();
  $conexion = $c->conexion();

  $producto = $_GET['idProducto'];

  $sqlProdu = "SELECT art.id_producto,
                      art.nombre,
                      art.descripcion,
                      art.cantidad,
                      art.precioBase,
                      art.precioVenta,
                      art.fechaCaptura,
                      img.ruta
                 from articulos as art
           inner join imagenes as img
                   on art.id_imagen = img.id_imagen
                where art.id_producto = '$producto'";
   $consulta = mysqli_query($conexion, $sqlProdu);
   $ver = mysqli_fetch_row($consulta);
?>

<div class="row">
  <div class="col-sm-2"></div>
   <div class="col-sm-4" style="text-align: center">

      <p><?php echo 'T'.$ver[6].'R'.ceil($ver[4]); ?></p>
      <h4><?php echo $ver[1]; ?></h4>
      <h4><?php echo $ver[2]; ?></h4>
      <p><?php echo "Cantidad: ".$ver[3]; ?></p>
      <p><?php echo "Precio: S/ ".ceil($ver[5]).".00"; ?></p>
      <form id="frmAgreALista" style="text-align: center" class="form-inline">
         <input type="text" hidden name="clienteVenta" id="clienteVenta" value="1">
         <input type="text" hidden name="productoVenta" id="productoVenta" value="<?php echo $ver[0]?>">
         <input type="text" hidden name="descripcionV" id="descripcionV" value="<?php echo $ver[2]?>">
         <input type="text" hidden name="cantidadV" id="cantidadV" value="<?php echo $ver[3]?>">
         <input type="number" name="cantVenta" id="cantVenta" placeholder="Cantidad" title="Cantidad" class="form-control input-sm">
         <input type="number" name="precioV" id="precioV" placeholder="Precio S/ ....00" title="Precio" class="form-control input-sm"><p></p>
         <span class="btn btn-primary btn-sm" id="btnAgreALista">Agregar a lista</span><p></p>
      </form>
   </div>
   <div class="col-sm-4">
      <?php
      $img = explode("/",$ver[7]);
      $ruta = $img[1]."/".$img[2]."/".$img[3];
      ?>
      <img width="360" height="360" src="<?php echo $ruta; ?>" class="img-responsive">
   </div>
   <div class="col-sm-2"></div>
</div>

<script type="text/javascript">
   $(document).ready(function(){
      $('#btnAgreALista').click(function(){
        vacios = validarFormVacio('frmAgreALista');
        if (vacios > 0) {
          alertify.alert("Debes llenar todos los datos.");
          return false;
        }
        datos = $('#frmAgreALista').serialize();
        $.ajax({
          type: "POST",
          data: datos,
          url:"../procesos/ventas/agregaProductoTemp.php",
          success: function(r){
           $('#frmAgreALista')[0].reset();
          }
        });
      });
   });
</script>
