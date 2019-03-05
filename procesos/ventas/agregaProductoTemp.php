<?php
	session_start();
	require_once "../../clases/Conexion.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$idcliente=$_POST['clienteVenta'];
	$idproducto=$_POST['productoVenta'];
	$descripcion=$_POST['descripcionV'];
	$cantidad=$_POST['cantidadV'];
	$cantVenta=$_POST['cantVenta'];
	$precio=$_POST['precioV'];

	$sql="SELECT nombre,apellido
			from clientes
			where id_cliente='$idcliente'";
	$result=mysqli_query($conexion,$sql);

	$c=mysqli_fetch_row($result);

	$ncliente=$c[1]." ".$c[0];

	$sql="SELECT nombre
			from articulos
			where id_producto='$idproducto'";
	$result=mysqli_query($conexion,$sql);

	$nombreproducto=mysqli_fetch_row($result)[0];

	$nuevaCant = $cantidad - $cantVenta;

	$articulo=$idproducto."||".
				$nombreproducto."||".
				$precio."||".
				$cantVenta."||".
				$nuevaCant."||".
				$ncliente."||".
				$idcliente;

	$_SESSION['tablaComprasTemp'][]=$articulo;

 ?>
