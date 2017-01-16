<?php
session_start();
include('php/destruye_sesion.php');
$usuario = $_SESSION['nombreUsuario'];
if($_SESSION['nombreUsuario']){
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <?php 
	    include('php/consultasAcreditacion.php');
	    tituloPanel();
	    if(isset($_GET['id'])){
	    	$id = $_GET['id'];
	    }
	    $empresaId = getEmpresaContrato($id);
	    ?>
		<!-- Bootstrap CSS -->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/estilosAdmin.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->		
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
	              <div class="col-xs-8 col-sm-8 col-md-8"><b>
	              <?php if($nombreUsuario!="Contratista"){?>
					<a href="listarContratistas.php" title="">Empresas Contratistas</a> 
				  <?php } ?>
				  <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> 
	              <a href="listarContratos.php?id=<?php echo $empresaId; ?>">Contratos Vigentes</a>
	              <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> 
	              Personal Acreditado
	              </b></div>
	              <?php if($usuario!="Mandante"){ ?>
	              <div class="col-xs-4 col-sm-4 col-md-4">
	              	<a class="btn btn-xs btn-success pull-right" href="ingresarTrabajador.php?id=<?php echo $id; ?>" role="button">Ingresar Personal</a>	
	              </div>
	              <?php } ?>
	            </header>

	            <div class="content-inner">
	            	<table class="table table-hover">
	            		<thead>
	            			<tr>
	            				<th>#</th>
	            				<th>Estado</th>
	            				<th>Rut</th>
	            				<th>Nombre</th>
	            				<th>Cargo</th>
	            				<th>Fono</th>
	            				<th>Nacionalidad</th>
	            			</tr>
	            		</thead>
	            		<tbody>
	            			<?php listarPersonal($id); ?>
	            		</tbody>
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
	<?php 
		if(isset($_SESSION['mensajeAlerta'])){
			echo "<script>alert('". $_SESSION['mensajeAlerta'] ."')</script>";
			unset($_SESSION['mensajeAlerta']);
		}
	?>
</html>
<?php
}else{
  header("location: http://www.chilecop.cl/accesoAcreditacion.html");
}
?>