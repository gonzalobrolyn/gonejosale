
<?php require_once "dependencias.php"; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Padi</title>
</head>
<body>

   <nav id="barra-nav" class="navbar navbar-fixed-top navbar-inverse" data-spy="affix" role="navigation" >
      <div class="container">
         <div class="nav navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
               <span class="sr-only">MENU</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="inicio.php"><img class="img-responsive logo img-thumbnail" src="../img/ventas.jpg" alt="" width="150px" height="150px"></a>
         </div>
         <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
               <li>
                  <a href="inicio.php"><span class="glyphicon glyphicon-home"></span> Inicio</a>
               </li>
               <li>
                  <a href="ventas.php"><span class="glyphicon glyphicon-usd"></span> Ventas</a>
               </li>

               <?php if($_SESSION['usuario']=="admin"): ?>
                  <li>
                     <a href="usuarios.php"><span class="glyphicon glyphicon-user"></span> Personal</a>
                  </li>
                  <li>
                     <a href="almacen.php"><span class="glyphicon glyphicon-th-list"></span> Almacen</a>
                  </li>
                  <li>
                     <a href="reportes.php"><span class="glyphicon glyphicon-stats"></span> Reporte</a>
                  </li>
               <?php endif; ?>

               <li class="dropdown" >
                  <a href="#" style="color: red"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                     <span class="glyphicon glyphicon-user"></span>
                     User: <?php echo $_SESSION['usuario']; ?>
                     <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                       <a style="color: red" href="../procesos/salir.php"><span class="glyphicon glyphicon-off"></span> Salir</a>
                    </li>
                  </ul>
               </li>
            </ul>
         </div>
         <!--/.nav-collapse -->
      </div>
      <!--/.contatiner -->
   </nav>

</body>
</html>
