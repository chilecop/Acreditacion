<?php
session_start();
if($_SESSION['nombreUsuario']){
$servername = "localhost";
$username = "chilecop";
$password = "cHilecop2016";
$dbname = "chilecop_cademo";

// Crear conexión 
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$conn->set_charset("utf8");

$f_inicio = date('Y-m-d', strtotime($_POST['dateFrom']));
$f_termino = date('Y-m-d', strtotime($_POST['dateTo']));
$nombre = $_POST['nombre'];
$rut = $_POST['rut'];
$empresa = $_POST['empresa'];
$cargo = $_POST['cargo'];
  

  
  $sql="SELECT A.RUT_PERSONAL AS RUT, A.NOMBRE_PERSONAL AS NOMBRE, A.CARGO AS CARGO, A.EMPRESA AS EMPRESA, B.FECHA AS FECHA, B.OUTIN AS OUTIN, B.RUT AS RUT, C.NOMBRE_EMPRESA AS NOMBRE_EMPRESA, C.ID_EMPRESA = ID_EMPRESA
FROM personal AS A, pruebaingresos AS B, empresas AS C
WHERE A.RUT_PERSONAL = B.RUT
AND A.EMPRESA = C.ID_EMPRESA";
 
  //SEGUN PARAMETROS DE BUSQUEDA
 		 if($nombre!=""){
			  $sql = $sql ." AND A.NOMBRE_PERSONAL LIKE '%$nombre%'";
	     }	
		 if($rut!=""){
			  $sql = $sql ." AND A.RUT_PERSONAL LIKE '%$rut%'";
	     }
		 if($empresa!=""){
			  $sql = $sql ." AND C.NOMBRE_EMPRESA LIKE '%$empresa%'";
	     } 
		 if($cargo!=""){
			  $sql = $sql ." AND A.CARGO LIKE '%$cargo%'";
	     } 
		 if($f_inicio!="" && $f_termino!=""){
			  $sql = $sql ." AND DATE(B.FECHA) BETWEEN '$f_inicio' AND '$f_termino'";
		 }
	$resultado = $conn->query($sql);
	
	 
	
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <title>Control de Accesos - Chilecop</title>

		<!-- Bootstrap CSS -->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/estilosAdmin.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php include('php/consultas.php'); ?>
	</head>
	<body>
		<div class="container-fluid display-table">
	      <div class="row display-table-row">
	        <!-- Panel de Navegación Izquierdo-->
	        <?php imprimirMenu(); ?>
	        <!-- Ventana Principal-->
	        <div class="col-md-10 col-sm-11 display-table-cell valign-top">
	          <div class="row">
	            <header id="nav-header" class="clearfix">
	              <div class="col-md-5">
	                <nav class="navbar-default pull-left">
	                  <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
	                    <span class="sr-only">Toggle navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                  </button>
	                </nav>
	              </div>
	              <div class="col-md-7">
	                <ul class="pull-right">
	                  <li id="welcome" class="hidden-xs"><?php echo '<b>' . $_SESSION['nombreUsuario'] . '</b>'; ?>, bienvenido al &aacute;rea de administraci&oacute;n</li>
	                  <li class="fixed-width">
	                    <a href="#">
	                      <span class="glyphicon glyphicon-bell" aria-hidden="true"></span>
	                      <span class="label label-warning">3</span>
	                    </a>
	                  </li>

	                  <li class="fixed-width">
	                    <a href="#">
	                      <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
	                      <span class="label label-message">3</span>
	                    </a>
	                  </li>

	                  <li>
	                    <a href="php/desconectar.php" class="logout">
	                      <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
	                      log out
	                    </a>
	                  </li>
	                </ul>
	              </div>
	            </header>
	          </div>
			  <div id="content">
	            <header class="clearfix">
	              <div class="col-xs-5 col-sm-3 col-md-3"><b>Empresas</b></div>
	              <div class="col-xs-7 col-sm-9 col-md-9">
	              </div>
	            </header>
                <form method="POST" action="#" name="frm">
               <div class="content-inner">
               <h2>Ingresar Parametros de busqueda</h2>
	            	<table class="table table-hover">
	              <tr>
    			  <td>
            <tbody>
              <tr>
                <td>Rut</td>
                <td>Fecha Inicio</td>
                <td>Fecha Termino</td>
                <td>Exportar a Excel</td>
              </tr>
              <tr>
                <td><input name="rut" type="text" size="30" maxlength="20" value="<?php echo $rut; ?>"/></td>
                <td><input type="date" name="dateFrom" value="<?php echo date('Y-m-d'); ?>" /></td>
                <td> <input type="date" name="dateTo" value="<?php echo date('Y-m-d', strtotime("+1 day")); ?>" /></td>
                <td><button class="btn btn-xs btn-primary" id="exportar"  name="exportar" type="submit" value="true" >EXCEL</button></td>
              </tr>
              <tr>
                <td>Nombre</td>
                <td>Empresa</td>
                <td>Cargo</td>
                <td>Aplicar parametros de busqueda</td>
              </tr>
              <tr>
                <td><input name="nombre" type="text" size="30" maxlength="40" value="<?php echo $nombre; ?>"/></td>
                <td><input name="empresa" type="text" size="30" maxlength="40" value="<?php echo $empresa; ?>"/></td>
                <td><input name="cargo" type="text" size="30" maxlength="40" value="<?php echo $empresa; ?>"/></td>
               	<td><button class="btn btn-xs btn-primary" id="bt"  name="bt" type="submit" value="ok" >BUSCAR</button></td>
              </tr>
              </tbody>
            
</form>

         </table>	
	            
	           

	            <div class="content-inner">
	            	<table class="table table-hover">
	            		<thead>
	            			<tr>
	            				<th>Rut</th>
	            				<th>Nombre</th>
	            				<th>Fecha y hora</th>
                                <th>Empresa</th>
                                <th>Cargo</th>
                                <th>Entrada/Salida</th>
	            			</tr>
	            		</thead>
	            		<?php
             if ($resultado->num_rows > 0) {
    // output data of each row
    while($row = $resultado->fetch_assoc()) { ?>
    
                        <tbody>             
  <tr>
    <td><? echo  $row["RUT"]?></td>
    <td><? echo  $row["NOMBRE"]?></td>
    <td><? echo  $row["FECHA"]?></td>
    <td><? echo  $row["NOMBRE_EMPRESA"]?></td>
    <td><? echo  $row["CARGO"]?></td>
    <td><? echo  $row["OUTIN"]?></td>
  </tr>
	            		</tbody>
                        <?php
  				}
			  }else {
    echo "0 results";
}
  
			?>
	            	</table>
	            </div>
	          </div>

	          <div class="row">
	            <footer id="admin-footer" class="clearfix">
	              <div class="pull-left"><?php copyright(); ?></div>
              	  <div class="pull-right"><?php nombrePanel(); ?></div>
	            </footer>
	          </div>
	        </div>
	      </div>
	    </div>

		<!-- jQuery -->
		<script src="http://code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
<?php
}else{
  header("location: http://www.chilecop.cl/caccesodemo/index.html");
}
?>