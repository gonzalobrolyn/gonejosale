
<?php
	session_start();
	if(isset($_SESSION['usuario'])){
		require_once "menu.php";
		require_once "../clases/Conexion.php";

		$c= new conectar();
		$conexion=$c->conexion();

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
<div class="container">
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
<?php
	}else{
		header("location:../index.php");
	}
 ?>
