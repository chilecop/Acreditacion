<?php
session_start();
if($_SESSION['nombreUsuario']){
$nombreUsuario = $_SESSION['nombreUsuario'];
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
		$_SESSION['idDocumentoActual'] = $id;
		$contenido = getVerDocumentacionContrato($id);
		list($url1,$val1,$obs1,$mod1,
			$url2,$val2,$obs2,$mod2,
			$url3,$val3,$obs3,$mod3,
			$url4,$val4,$obs4,$mod4,
			$url5,$val5,$obs5,$mod5,
			$url6,$val6,$obs6,$mod6,
			$url7,$val7,$obs7,$mod7,
			$url8,$val8,$obs8,$mod8,
			$url9,$val9,$obs9,$mod9,
			$url10,$val10,$obs10,$mod10,
			$url11,$val11,$obs11,$mod11,
			$url12,$val12,$obs12,$mod12,
			$url13,$val13,$obs13,$mod13,
			$url14,$val14,$obs14,$mod14,
			$url15,$val15,$obs15,$mod15,
			$url16,$val16,$obs16,$mod16,
			$url17,$val17,$obs17,$mod17,
			$url18,$val18,$obs18,$mod18,
			$url19,$val19,$obs19,$mod19,
			$url20,$val20,$obs20,$mod20,
			$url21,$val21,$obs21,$mod21,
			$url22,$val22,$obs22,$mod22,
			$url23,$val23,$obs23,$mod23) = explode("%$", $contenido);
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
		$time11 = strtotime($val11);
		if($time11 === false or $time11 === -62169968592){ 
			$date11 = '00-00-0000'; } 
			else {$date11 = date('d-m-Y', $time11);
		}
		$time12 = strtotime($val12);
		if($time12 === false or $time12 === -62169968592){ 
			$date12 = '00-00-0000'; } 
			else {$date12 = date('d-m-Y', $time12);
		}
		$time13 = strtotime($val13);
		if($time13 === false or $time13 === -62169968592){ 
			$date13 = '00-00-0000'; } 
			else {$date13 = date('d-m-Y', $time13);
		}
		$time14 = strtotime($val14);
		if($time14 === false or $time14 === -62169968592){ 
			$date14 = '00-00-0000'; } 
			else {$date14 = date('d-m-Y', $time14);
		}

		$tipoPase = getTipoPase($id);
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
			<script src="js/subirDocumentos.js"></script>
		</head>
		<body unload="javascript:verificarCarga()">
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
								<div class="col-xs-8 col-sm-8 col-md-8"><b>Contratos Vigentes <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> Listar Personal <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> Documentación - <?php echo $_SESSION['trabajadorActual']; ?></b></div>
							</header>

							<div class="content-inner">
								<div class="row comments-row">
								<?php 
									if($tipoPase == 1 || $tipoPase == 4 || $tipoPase == 6)
										imprimirDocumento("Contrato de Trabajo",$date1,$mod1,$obs1,$_SESSION['trabajadorActual'],$url1,$val1,"1"); 

									if($tipoPase == 1)
										imprimirDocumento("Inducción JoyGlobal",$date2,$mod2,$obs2,$_SESSION['trabajadorActual'],$url2,$val2,"2"); 

									imprimirDocumento("Fotografía tamaño carnet",$date3,$mod3,$obs3,$_SESSION['trabajadorActual'],$url3,$val3,"3");

									imprimirDocumento("Consentimieno test alcohol y drogas",$date4,$mod4,$obs4,$_SESSION['trabajadorActual'],$url4,$val4,"4");

									if($tipoPase == 1 || $tipoPase == 4 || $tipoPase == 6)
										imprimirDocumento("Fotocopia Cédula",$date5,$mod5,$obs5,$_SESSION['trabajadorActual'],$url5,$val5,"5");

									
									imprimirDocumento("Examen Pre-Ocupacional",$date6,$mod6,$obs6,$_SESSION['trabajadorActual'],$url6,$val6,"6");

									if($tipoPase == 1 || $tipoPase == 4)
										imprimirDocumento("ODI",$date7,$mod7,$obs7,$_SESSION['trabajadorActual'],$url7,$val7,"7");

									if($tipoPase == 1)
									imprimirDocumento("Reglamento Interno",$date8,$mod8,$obs8,$_SESSION['trabajadorActual'],$url8,$val8,"8");

									if($tipoPase == 1 || $tipoPase == 4 || $tipoPase == 6)
									imprimirDocumento("Entrega EPP",$date9,$mod9,$obs9,$_SESSION['trabajadorActual'],$url9,$val9,"9");
									if($tipoPase == 1)
									imprimirDocumento("Último Finiquito",$date10,$mod10,$obs10,$_SESSION['trabajadorActual'],$url10,$val10,"10");
									if($tipoPase == 1)
									imprimirDocumento("Certificado Antecedentes",$date11,$mod11,$obs11,$_SESSION['trabajadorActual'],$url11,$val11,"11");
									if($tipoPase == 1)
									imprimirDocumento("Certificado de Estudios",$date12,$mod12,$obs12,$_SESSION['trabajadorActual'],$url12,$val12,"12");
									if($tipoPase == 1)
									imprimirDocumento("Acreditación Prevencionista",$date13,$mod13,$obs13,$_SESSION['trabajadorActual'],$url13,$val13,"13");
									if($tipoPase == 1)
									imprimirDocumento("Certificado de Aprobación",$date14,$mod14,$obs14,$_SESSION['trabajadorActual'],$url14,$val14,"14");



									imprimirDocumento("Anexo 1",$date15,$mod15,$obs15,$_SESSION['trabajadorActual'],$url15,$val15,"15");
									imprimirDocumento("Anexo 2",$date16,$mod16,$obs16,$_SESSION['trabajadorActual'],$url16,$val16,"16");
									imprimirDocumento("Anexo 3",$date17,$mod17,$obs17,$_SESSION['trabajadorActual'],$url17,$val17,"17");
									imprimirDocumento("Otros",$date18,$mod18,$obs18,$_SESSION['trabajadorActual'],$url18,$val18,"18");

									if($tipoPase == 3 || $tipoPase == 5)
									imprimirDocumento("Guía de despacho o factura del material",$date19,$mod19,$obs19,$_SESSION['trabajadorActual'],$url19,$val19,"19");
									if($tipoPase == 3 || $tipoPase == 5)
									imprimirDocumento("Documentación legal del Vehículo",$date20,$mod20,$obs20,$_SESSION['trabajadorActual'],$url20,$val20,"20");
									if($tipoPase == 3 || $tipoPase == 5)
									imprimirDocumento("Check list del vehículo",$date21,$mod21,$obs21,$_SESSION['trabajadorActual'],$url21,$val21,"21");
									if($tipoPase == 3 || $tipoPase == 5)
									imprimirDocumento("Licencia municipal de conducir vigente",$date22,$mod22,$obs22,$_SESSION['trabajadorActual'],$url22,$val22,"22");

									if($tipoPase == 6)
									imprimirDocumento("Visa de trabajo",$date23,$mod23,$obs23,$_SESSION['trabajadorActual'],$url23,$val23,"23");
								?>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<button id="guardarDocs" type="submit" class="btn btn-primary pull-right">Guardar Cambios y enviar trabajador a revision</button>
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
			</div>
		</body>
		</html>
<?php
}else{
  header("location: http://www.chilecop.cl/accesoAcreditacion.html");
}
?>