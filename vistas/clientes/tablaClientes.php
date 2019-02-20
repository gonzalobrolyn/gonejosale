
<?php
	require_once "../../clases/Conexion.php";

	$obj= new conectar();
	$conexion= $obj->conexion();

	$sql="SELECT id_cliente,
				nombre,
				apellido,
				direccion,
				email,
				telefono,
				rfc
		from clientes";
	$result=mysqli_query($conexion,$sql);
 ?>

<div class="table-responsive">
	 <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	 	<caption><label>Clientes :)</label></caption>
	 	<tr>
	 		<td><b>Nombre</b></td>
	 		<td><b>Apellido</b></td>
	 		<td><b>Direccion</b></td>
	 		<td><b>Email</b></td>
	 		<td><b>Telefono</b></td>
	 		<td><b>RUC</b></td>
	 		<td><b>Editar</b></td>
	 		<td><b>Eliminar</b></td>
	 	</tr>

	 	<?php while($ver=mysqli_fetch_row($result)): ?>

	 	<tr>
	 		<td><?php echo $ver[1]; ?></td>
	 		<td><?php echo $ver[2]; ?></td>
	 		<td><?php echo $ver[3]; ?></td>
	 		<td><?php echo $ver[4]; ?></td>
	 		<td><?php echo $ver[5]; ?></td>
	 		<td><?php echo $ver[6]; ?></td>
	 		<td>
				<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalClientesUpdate" onclick="agregaDatosCliente('<?php echo $ver[0]; ?>')">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</td>
			<td>
				<span class="btn btn-danger btn-xs" onclick="eliminarCliente('<?php echo $ver[0]; ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>
	 	</tr>
	 <?php endwhile; ?>
	 </table>
</div>
