<?php
session_start();
if($_SESSION['nombreUsuario']){
	$trabajando = 0;
	$tecnico = isset($_GET['ing']);
	if($trabajando==1 && $tecnico!=1){
		echo "<script>alert('Para mejorar nuestro servicio, nos encontramos trabajando en esta sección. Disculpe las molestias.')</script>";
		header("Location: escritorio.php");
	}else{
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <?php 
	    include('php/consultasAcreditacion.php');
		include('php/fechas.php');
	    tituloPanel();
	    if(isset($_SESSION["idContratista"])){
	      $id = $_SESSION["idContratista"];
	    }else{
	      $id = $_GET['id'];
	    }
	    $_SESSION['empresaActual'] = getRutEmpresa($id);
	    $_SESSION['idEmpresaActual'] = $id;
	    $contenido = getVerDocEECC($id);
	    list(
	    	$url1,$val1,$mod1,
	    	$url2,$val2,$mod2,
	    	$url3,$val3,$mod3,
	    	$url4,$val4,$mod4,
	    	$url5,$val5,$mod5,
	    	$url6,$val6,$mod6,
	    	$url7,$val7,$mod7,
	    	$url8,$val8,$mod8,
	    	$url9,$val9,$mod9,
	    	$url10,$val10,$mod10) = explode("%$", $contenido);

		$time = strtotime($val1);
		if($time === false or $time === -62169968592){ 
		$date1 = '00-00-0000'; } 
		else {$date1 = date('d-m-Y', $time);
		}
		$time2 = strtotime($val2);
		if($time2 === false or $time2 === -62169968592){ 
		$date2 = '00-00-0000'; } 
		else {$date2 = date('d-m-Y', $time2);
		}
		$time3 = strtotime($val3);
		if($time3 === false or $time3 === -62169968592){ 
		$date3 = '00-00-0000'; } 
		else {$date3 = date('d-m-Y', $time3);
		}
		$time4 = strtotime($val4);
		if($time4 === false or $time4 === -62169968592){ 
		$date4 = '00-00-0000'; } 
		else {$date4 = date('d-m-Y', $time4);
		}
		$time5 = strtotime($val5);
		if($time5 === false or $time5 === -62169968592){ 
		$date5 = '00-00-0000'; } 
		else {$date5 = date('d-m-Y', $time5);
		}
		$time6 = strtotime($val6);
		if($time6 === false or $time6 === -62169968592){ 
		$date6 = '00-00-0000'; } 
		else {$date6 = date('d-m-Y', $time6);
		}
		$time7 = strtotime($val7);
		if($time7 === false or $time7 === -62169968592){ 
		$date7 = '00-00-0000'; } 
		else {$date7 = date('d-m-Y', $time7);
		}
		$time8 = strtotime($val8);
		if($time8 === false or $time8 === -62169968592){ 
		$date8 = '00-00-0000'; } 
		else {$date8 = date('d-m-Y', $time8);
		}
		$time9 = strtotime($val9);
		if($time9 === false or $time9 === -62169968592){ 
		$date9 = '00-00-0000'; } 
		else {$date9 = date('d-m-Y', $time9);
		}
		$time10 = strtotime($val10);
		if($time10 === false or $time10 === -62169968592){ 
		$date10 = '00-00-0000'; } 
		else {$date10 = date('d-m-Y', $time10);
		}
		
		?>

		<!-- Bootstrap CSS -->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/estilosAdmin.css">
		<link rel="stylesheet" type="text/css" href="css/new-article.css">
		<link rel="stylesheet" type="text/css" href="css/documentacionPersonal.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- jQuery -->
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="js/subirDocumentosEmpresa.js"></script>
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
	              <div class="col-xs-8 col-sm-8 col-md-8"><b>Contratos Vigentes <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> Listar Personal <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> Documentación - <?php echo $_SESSION['empresaActual']; ?></b></div>
	            </header>

	            <div class="content-inner">

	            	<div class="row comments-row">
	            		<?php
	            			imprimirDocumento("FICHA BÁSICA DE IDENTIFICACIÓN",$date1,$mod1,$obs1,$_SESSION['empresaActual'],$url1,$val1,"1","Empresa");

	            			imprimirDocumento("LISTADO DE TRABAJADORES",$date2,$mod2,$obs2,$_SESSION['empresaActual'],$url2,$val2,"2","Empresa");

	            			imprimirDocumento("AUTORIZACIÓN DE JORNADA EXCEPCIONAL",$date3,$mod3,$obs3,$_SESSION['empresaActual'],$url3,$val3,"3","Empresa");

	            			imprimirDocumento("CONTRATO COMERCIAL",$date4,$mod4,"Contrato Comercial, OST o carta de adjudicacion",$_SESSION['empresaActual'],$url4,$val4,"4","Empresa");

	            			imprimirDocumento("ANTECEDENTES COMERCIALES",$date5,$mod5,"CERTIFICADO DE ANTECEDENTES COMERCIALES",$_SESSION['empresaActual'],$url5,$val5,"5","Empresa");

	            			imprimirDocumento("CERTIFICADO AFILIACIÓN MUTUALIDAD",$date6,$mod6,$obs6,$_SESSION['empresaActual'],$url6,$val6,"6","Empresa");

	            			imprimirDocumento("ANTECEDENTES LABORALES",$date7,$mod7,"CERTIFICADO DE ANTECEDENTES LABORALES Y PREVISIONALES (F30)",$_SESSION['empresaActual'],$url7,$val7,"7","Empresa");

	            			imprimirDocumento("CARPETA DE ARRANQUE",$date8,$mod8,"RECEPCIÓN CARPETA DE ARRANQUE (Emitido por Joyglobal)",$_SESSION['empresaActual'],$url8,$val8,"8","Empresa");

	            			imprimirDocumento("CARPETA TRIBUTARIA",$date9,$mod9,$obs9,$_SESSION['empresaActual'],$url9,$val9,"9","Empresa");

	            			imprimirDocumento("CERTIFICADO DE CONFIDENCIALIDAD",$date10,$mod10,$obs10,$_SESSION['empresaActual'],$url10,$val10,"10","Empresa");

	            		?>
	            	</div>

	            	<div class="row comments-row">
	            		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	            			<button id="guardarDocs" type="submit" class="btn btn-primary pull-right">Guardar Documentación</button>
	            		</div>
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
	}
}else{
  header("location: http://www.chilecop.cl/accesoAcreditacion.html");
}
?>