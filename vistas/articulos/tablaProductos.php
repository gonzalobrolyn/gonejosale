
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
  <div class="col-sm-3">
    <div class="thumbnail">
			<?php
			$imgVer=explode("/", $ver[4]) ;
			$imgruta=$imgVer[1]."/".$imgVer[2]."/".$imgVer[3];
			?>
			<img width="210" height="210" src="<?php echo $imgruta ?>">
      <div class="caption">
			  <p><?php echo $ver[1]; ?></p>
				<p style="text-align: center">
						<h4 style="text-align: center"><?php echo "S/ ".$ver[3].".00"; ?></h4>
				</p>
      </div>
    </div>
  </div>

<?php endwhile; ?>
