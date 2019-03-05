
<?php
	session_start();
	if(isset($_SESSION['usuario'])){
		require_once "menu.php";
      require_once "../clases/Conexion.php";
   	require_once "../clases/Ventas.php";

      $c= new conectar();
   	$conexion=$c->conexion();

   	$obj= new ventas();

   	$sql="SELECT id_venta,
   					 fechaCompra,
   					 id_cliente
   			  from ventas
			 group by id_venta desc";
   	$result=mysqli_query($conexion,$sql);

 ?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container-fluid">
      <div class="row">
      	<div class="col-sm-1"></div>
      	<div class="col-sm-10">
            <h1>Ventas y Reportes</h1>
      		<div class="table-responsive">
      			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
      				<tr>
      					<td><b>Folio</b></td>
      					<td><b>Fecha</b></td>
      					<td><b>Cliente</b></td>
      					<td><b>Total de compra</b></td>
							<td><b>Boleta</b></td>

      				</tr>
      		<?php while($ver=mysqli_fetch_row($result)): ?>
      				<tr>
      					<td><?php echo $ver[0] ?></td>
      					<td><?php echo $ver[1] ?></td>
      					<td>
      						<?php
      							if($obj->nombreCliente($ver[2])==" "){
      								echo "S/C";
      							}else{
      								echo $obj->nombreCliente($ver[2]);
      							}
      						 ?>
      					</td>
      					<td>
      						<?php
      							echo "S/ ".$obj->obtenerTotal($ver[0]);
      						 ?>
      					</td>
							<td>
								<a href="../procesos/ventas/crearReportePdf.php?idventa=<?php echo $ver[0]; ?>" class="btn btn-danger btn-sm">
									<span class="glyphicon glyphicon-file"></span>
								</a>
							</td>

      				</tr>
      		<?php endwhile; ?>
      			</table>
      		</div>
      	</div>
      	<div class="col-sm-1"></div>
      </div>
	</div>
</body>
</html>

<?php
	}else{
		header("location:../index.php");
	}
 ?>
