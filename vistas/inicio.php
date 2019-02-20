
<?php
	session_start();
	if(isset($_SESSION['usuario'])){
		require_once "menu.php";
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


</body>
</html>
<?php
	}else{
		header("location:../index.php");
	}
 ?>
