<?php
session_start();
include('php/destruye_sesion.php');
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
	    tituloPanel();?>

		<!-- Bootstrap CSS -->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/estilosAdmin.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="http://code.jquery.com/jquery.js"></script>
		<script>
			$(document).ready(function() {
			   // Interceptamos el evento submit
			    $("input[name='search']").on("keyup", function() {
			  // Enviamos el formulario usando AJAX
			  		$('#respuestaBusquedaPersonal').show();
			  		$('#cabecera').show();
			  		$('#respuestaBusquedaPersonal').html('<div><img style="max-width:20px;" src="images/loading.gif"/> <b>Cargando</b></div>');
			  		var value=$.trim($("input[name='search']").val());
			  		if(value.length>0){
				        $.ajax({
				            type: 'POST',
				            url: "php/buscador.php",
				            data: $(this).serialize(),
				            // Mostramos un mensaje con la respuesta de PHP
				            success: function(data) {
				                $('#respuestaBusquedaPersonal').html(data);
				            }
				        })        
				        return false;
			    	}else{
			    		$.ajax({
				            type: 'POST',
				            url: "php/buscador.php",
				            data: $(this).serialize(),
				            // Mostramos un mensaje con la respuesta de PHP
				            success: function(data) {
				            	$('#respuestaBusquedaPersonal').hide();
				            	$('#cabecera').hide();
				            }
				        })        
				        return false;
			    	}
			    }); 
			})
	    </script>
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
	              <div class="col-xs-5 col-sm-3 col-md-3"><b>Buscador Personal</b></div>
	            </header>

	            <div class="content-inner">
	            	<p>Ingrese rut o nombre para buscar al personal requerido.</p>
	            	<input name="search" placeholder="Buscar personal..." class="form-control">
	            	<table class="table table-hover">
	            		<thead id="cabecera">
	            			<tr>
	            				<th>#</th>
	            				<th>Rut</th>
	            				<th>Nombre</th>	            				
	            			</tr>
	            		</thead>
	            		<tbody id="respuestaBusquedaPersonal">
	            			<div id="cargando"></div>
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
		
		<!-- Bootstrap JavaScript -->
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
<?php
}else{
  header("location: http://www.chilecop.cl/accesoAcreditacion.html");
}
?>