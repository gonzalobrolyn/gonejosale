
<?php
	session_start();
	if(isset($_SESSION['usuario'])){
		require_once "menu.php";
		require_once "../clases/Conexion.php";

		$c= new conectar();
		$conexion=$c->conexion();

		$sqlBuscar = "SELECT id_producto,
												 nombre
					 					from articulos";
		$queryBuscar = mysqli_query($conexion, $sqlBuscar);

	   $sqlCate = "SELECT id_categoria,
	                      nombreCategoria
	                 from categorias";
	   $queryCate = mysqli_query($conexion, $sqlCate);
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4" style="text-align: center"> <h2>PRODUCTOS</h2> </div>
		<div class="col-sm-4" style="text-align: center"> <br>
			<form id="frmBusqueda" class="form form-inline" role="search">
				<label for="producto" >Buscador: </label>
				<select class="form-control" id="producto" name="producto">
					<?php while ($producto = mysqli_fetch_row($queryBuscar)): ?>
						<option value="<?php echo $producto[0] ?>">
							<?php echo $producto[1] ?>
						</option>
					<?php endwhile; ?>
				</select>
			</form>
		</div>
	</div>
	<div class="row">
		<div id="cargaBusqueda"></div>
	</div>
	<?php while ($cate = mysqli_fetch_row($queryCate)): ?>
		<div class="col-sm-12">
			<h3><?php echo $cate[1]; ?></h3>
			<p>
				<div id="cargaTablaProductos<?php echo $cate[0]; ?>"></div>
			</p><br>
		</div>

		<script type="text/javascript">
			$(document).ready(function(){
				$('#cargaTablaProductos<?php echo $cate[0]; ?>').load("articulos/tablaProductos.php?categoria=<?php echo $cate[0]; ?>");
			});
		</script>
	<?php endwhile; ?>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
	  $('#producto').select2();
  });
</script>

<script type="text/javascript">
   $(document).ready(function(){
      $('#producto').change(function(){
         $('#cargaBusqueda').load("articulos/buscaProducto.php?idProducto=" + $('#producto').val());
      });
   });
</script>

<?php
	}else{
		header("location:../index.php");
	}
?>
