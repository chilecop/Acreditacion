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
		<script type="text/javascript">
			function llenarContratos()
	      	{
		        var empresaSelect = document.getElementById("empresa");
		        var contratos = document.getElementById("contratos");
		        var seleccionada = empresaSelect.options[empresaSelect.selectedIndex].value
		        if(seleccionada!=0){
		          $.ajax({
		            data: {'empresa':seleccionada},
		            type: "POST",
		            datatype: "json",
		            url: "php/getContratosReporte.php",
		            success: function(response)
		            {
		              contratos.options.length = 0;
		              if(response!=0){
		                var contratosRecibidos = JSON.parse(response); 
		                if(contratosRecibidos.length<1){    
		                  contratos.options[0] = new Option("Seleccionar Empresa...",0);
		                }else{
		                  for (var i = 0; i < contratosRecibidos.length; i++)
		                  {                
		                    contratos.options[i] = new Option(contratosRecibidos[i].numero,contratosRecibidos[i].id);
		                  }
		                }
		              }else{
		                contratos.options[0] = new Option("No existen contratos definidos",0);
		              }            
		            }
		          });
		        }else{
		          contratos.options.length = 0;
		          contratos.options[0] = new Option("Seleccionar Empresa...",0);
		        }
	      	}
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
	              <div class="col-xs-5 col-sm-3 col-md-3"><b>Reporte Personal Acreditado</b></div>
	            </header>
	            <div class="content-inner">
	            	<p>Ingrese las especificaciones del reporte que desee generar.</p>
	            	<form action="php/generarReportePersonal.php" method="post" accept-charset="utf-8">	            	
		            	<table class="table table-hover">
		            		<tr>
		            			<td>Estado del Personal</td>
		            			<td>
		            				<select class="form-control" name="estado">
		            					<option value="0">Todo el personal</option>
		            					<option value="1">Acreditado</option>
 		            					<option value="2">Rechazado</option>
		            					<option value="3">Pendiente</option>
		            				</select>
		            			</td>
		            		</tr>
		            		<tr>
		            			<td>Tipo de Pase</td>
		            			<td>
		            				<select class="form-control" name="tipoPase">
		            					<option value="0">Todos los tipos</option>
		            					<option value="1">Permanente</option>
		            					<option value="3">Proveedores</option>
		            					<option value="4">Visita Técnica</option>
		            					<option value="5">Transportista</option>
		            					<option value="6">Vendors</option>
		            				</select>
		            			</td>
		            		</tr>
		            		<tr>
		            			<td>Tipo de Reporte</td>
		            			<td>
		            				<select class="form-control" name="tipo">
		            					<option value="0">Información detallada del Personal</option>
		            					<option value="1">Detalle de documentación</option>
		            				</select>
		            			</td>
		            		</tr>
		            		<tr>
		            			<td>Empresa</td>
		            			<td>
		            				<?php getSelectEmpresasNoRequired(); ?>
		            			</td>
		            		</tr>
		            		<tr>
		            			<td>Contrato</td>
		            			<td>
		            				<select name="idcontrato" id="contratos" class="form-control">
			                          <option value="0">Seleccionar Empresa...</option>
			                        </select>
		            			</td>
		            		</tr>
		            		<tr>
		            			<td>
		            			</td>
		            			<td>
		            				<button class="btn btn-primary pull-right" type="submit">Generar Reporte</button>
		            			</td>
		            		</tr>	            		
		            	</table>
	            	</form>
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