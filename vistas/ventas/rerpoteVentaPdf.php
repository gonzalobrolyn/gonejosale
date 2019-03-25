<?php
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$objv= new ventas();

	$c=new conectar();
	$conexion= $c->conexion();
	$idventa=$_GET['idventa'];

 	$sql="SELECT id_venta,
					 fechaCompra,
					 id_cliente
			  from ventas
			 where id_venta='$idventa'";

	$result=mysqli_query($conexion,$sql);

	$ver=mysqli_fetch_row($result);

	$folio=$ver[0];
	$fecha=$ver[1];
	$idcliente=$ver[2];

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Reporte de Venta</title>
 	<link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.css">
 </head>
 <body>
 		<img src="../../img/ventas.jpg" width="200" height="120">
 		<br>
 		<table class="table">
 			<tr>
 				<td>Fecha: <?php echo $fecha; ?></td>
 			</tr>
 			<tr>
 				<td>Folio: <?php echo $folio ?></td>
 			</tr>
 			<tr>
 				<td>Cliente: <?php echo $objv->nombreCliente($idcliente); ?></td>
 			</tr>
 		</table>


 		<table class="table">
 			<tr>
				<td>Cantidad</td>
 				<td>Producto</td>
 				<td>P. Unit.</td>
				<td>Importe</td>
 			</tr>

 			<?php
 			$sql="SELECT ve.cantidad,
							 ve.precio,
							 art.nombre
					  from ventas  as ve
			  inner join articulos as art
						 on ve.id_producto=art.id_producto
					 where ve.id_venta='$idventa'";

			$result=mysqli_query($conexion,$sql);
			$total=0;
			while($mostrar=mysqli_fetch_row($result)):
 			?>

 			<tr>
 				<td><?php echo $mostrar[0]; ?></td>
 				<td><?php echo $mostrar[2]; ?></td>
 				<td><?php echo $mostrar[1]; ?></td>
				<td><?php echo $mostrar[0]*$mostrar[1]; ?></td>
 			</tr>
 			<?php
 				$total=$total + $mostrar[0]*$mostrar[1];
 			endwhile;
 			?>
 			<tr>
				<td colspan="3" style="text-align: right">TOTAL </td>
 			 	<td><?php echo "S/ ".$total; ?></td>
 			</tr>
 		</table>
 </body>
 </html>
