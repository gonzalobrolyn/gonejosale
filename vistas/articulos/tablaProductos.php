
<?php
	require_once "../../clases/Conexion.php";

   $c= new conectar();
	$conexion=$c->conexion();
   $idCate = $_GET['categoria'];

   $sqlProdu = "SELECT art.id_producto,
                       art.nombre,
					        art.cantidad,
					        art.precioVenta,
					        img.ruta
		            from articulos as art
		      inner join imagenes as img
		              on art.id_imagen = img.id_imagen
                 where art.id_categoria = '$idCate'";
	$result = mysqli_query($conexion, $sqlProdu);

   while($ver=mysqli_fetch_row($result)):
?>
   <div class="col-sm-2">
      <div class="table-responsive">
         <table class="table table-hover">

               <tr>
                  <td>
                     <?php
                     $imgVer=explode("/", $ver[4]) ;
                     $imgruta=$imgVer[1]."/".$imgVer[2]."/".$imgVer[3];
                     ?>
                     <img class="img-responsive" src="<?php echo $imgruta ?>">
                  </td>
               </tr>
               <tr>
                  <td><?php echo $ver[1]; ?><br>
                  <?php echo "S/ ".$ver[3]; ?></td>
               </tr>

         </table>
      </div>
   </div>
<?php endwhile; ?>
