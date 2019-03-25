
<?php
	session_start();
	if(isset($_SESSION['usuario'])){
		require_once "menu.php";
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="../librerias/printThis.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
				<h1>Ventas y Reportes</h1>
			</div>
			<div class="col-sm-4">
				<br>
				<form id="frmBusqueda" class="form form-inline" role="search">
					<label for="buscador" >Buscador: </label>
					<input type="text" name="buscador" id="buscador" class="form-control" placeholder="dd/mm/aaaa" value="">
					<button type="button" name="btnBuscar" id="btnBuscar" class="btn btn-info">Buscar</button>
				</form>
			</div>
		</div>
    <div class="row">
    	<div class="col-sm-1"></div>
    	<div class="col-sm-10" id="cargaTablaReportes"></div>
  		<div class="col-sm-1"></div>
  	</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cargaTablaReportes').load('ventas/tablaReporte.php?fecha=0');
		$('#btnBuscar').click(function(){
      $('#cargaTablaReportes').load('ventas/tablaReporte.php?fecha='+$('#buscador').val());
    });
	});
</script>

<?php
	}else{
		header("location:../index.php");
	}
 ?>
