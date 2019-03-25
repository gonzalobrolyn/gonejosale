<?php

class ventas{
	public function obtenDatosProducto($idproducto){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="SELECT art.descripcion,
						 art.cantidad,
						 img.ruta,
						 art.precioBase,
						 art.precioVenta
				  from articulos as art
		  inner join imagenes as img
					 on art.id_imagen=img.id_imagen
					and art.id_producto='$idproducto'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);
		$d=explode('/', $ver[2]);
		$img=$d[1].'/'.$d[2].'/'.$d[3];

		$data=array(
			'descripcion' => $ver[3].' '.$ver[0],
			'cantidad' => $ver[1],
			'ruta' => $img,
			'precioVenta' => $ver[4]
		);
		return $data;
	}

	public function crearVenta(){
		$c= new conectar();
		$conexion=$c->conexion();

		$fecha=date('Y-m-d');
		$idventa=self::creaFolio();
		$datos=$_SESSION['tablaComprasTemp'];
		$idusuario=$_SESSION['iduser'];
		$r=0;

		for ($i=0; $i<count($datos) ; $i++) {
			$d=explode("||", $datos[$i]);

			$sqlVentas="INSERT into ventas (
									id_venta,
									id_cliente,
									id_producto,
									cantidad,
									precio,
									id_usuario,
									fechaCompra)
						 values ('$idventa',
									'$d[6]',
									'$d[0]',
									'$d[3]',
									'$d[2]',
									'$idusuario',
									'$fecha')";
			$r=$r + $result=mysqli_query($conexion,$sqlVentas);

			$sqlAlmacen="UPDATE articulos set
									  cantidad='$d[4]'
							  where id_producto='$d[0]'";

			$r2 = mysqli_query($conexion,$sqlAlmacen);
		}
		return $r;
	}

	public function creaFolio(){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql = "SELECT id_venta
					 from ventas
				group by id_venta desc";

		$resul=mysqli_query($conexion,$sql);
		$id=mysqli_fetch_row($resul)[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}

	public function nombreCliente($idCliente){
		$c= new conectar();
		$conexion=$c->conexion();

		 $sql="SELECT nombre, apellido
			from clientes
			where id_cliente='$idCliente'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[0]." ".$ver[1];
	}

	public function obtenerTotal($idventa){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT cantidad, precio
				from ventas
				where id_venta='$idventa'";
		$result=mysqli_query($conexion,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			$total=$total + $ver[0]*$ver[1];
		}

		return $total;
	}
}

?>
