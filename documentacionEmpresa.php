<?php
session_start();
include('php/destruye_sesion.php');
if($_SESSION['nombreUsuario']){
	$nombreUsuario = $_SESSION['nombreUsuario'];
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

			$idContratista = $_SESSION['idContratista'];
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
								<div class="col-xs-8 col-sm-8 col-md-8"><b>
									<?php if($nombreUsuario=="Admin"){?>
										<a href="listarContratistas.php" title="">Empresas Contratistas </a>
									<?php } ?>
									<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> Documentación - <?php echo $_SESSION['empresaActual']; ?></b>
								</div>
							</header>

							<div class="content-inner">
								<?php 
								if($idContratista){  
									getObservaciones($id,$idContratista,"Empresa");  
								} 
								?>
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
									<?php 
									if($nombreUsuario=="Admin"){
										?>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">						
											<div class="documento col-sm-12 col-md-12">
												<div class="row">
													<div class="col-xs-8 col-sm-8 col-md-8">
														<b>Observación</b><br>
														<small></small>
													</div>
												</div>
												<div class="well well-sm comments-well">
													<textarea rows="5" class="observacion" id="observacion" name="observacion" placeholder="Ingrese una observación"></textarea>
												</div>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12">
														<b>Documentos Relacionados</b><br>
														<small></small>
													</div>
												</div>
												<div class="well well-sm comments-well">
													Seleccione los documentos relacionados a la observación...
													<div class="row">
														<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
															<div class="checkbox">
																<label for="1">
																	<input id="1" type="checkbox" class="docsCheck" value="1">
																	Ficha básica de Identificación
																</label>
															</div>
															<div class="checkbox">
																<label for="2">
																	<input id="2" type="checkbox" class="docsCheck" value="2">
																	Listado de Trabajadores
																</label>
															</div>												
															<div class="checkbox">
																<label for="3">
																	<input id="3" type="checkbox" class="docsCheck" value="3">
																	Autorización de Jornada Excepcional
																</label>
															</div>
														</div>
														<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
															<div class="checkbox">
																<label for="4">
																	<input id="4" type="checkbox" class="docsCheck" value="4">
																	Contrato Comercial
																</label>
															</div>
															<div class="checkbox">
																<label for="5">
																	<input id="5" type="checkbox" class="docsCheck" value="5">
																	Antecedentes Comerciales
																</label>
															</div>
															<div class="checkbox">
																<label for="6">
																	<input id="6" type="checkbox" class="docsCheck" value="6">
																	Certificado Afiliación Mutualidad
																</label>
															</div>
														</div>
														<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
															<div class="checkbox">
																<label for="7">
																	<input id="7" type="checkbox" class="docsCheck" value="7">
																	Antecedentes Laborales
																</label>
															</div>
															<div class="checkbox">
																<label for="8">
																	<input id="8" type="checkbox" class="docsCheck" value="8">
																	Carpeta de Arranque
																</label>
															</div>
															<div class="checkbox">
																<label for="9">
																	<input id="9" type="checkbox" class="docsCheck" value="9">
																	Carpeta Tributaria
																</label>
															</div>
														</div>
														<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
															<div class="checkbox">
																<label for="10">
																	<input id="10" type="checkbox" class="docsCheck" value="10">
																	Certificado de Confidencialidad
																</label>
															</div>													
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														<button id="agregarObservacion" type="submit" class="btn btn-default pull-right">Añadir Observación</button>
													</div>
												</div>
											</div>
										</div>
										<?php 
									}
									?>
								</div>
								<?php 
								if($nombreUsuario=="Admin"){
									?>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<button id="guardarDocs" type="submit" class="btn btn-primary pull-right">Guardar Cambios</button>
										</div>
									</div>
									<?php
								} else {
									?>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<button id="guardarDocs" type="submit" class="btn btn-primary pull-right">Guardar Cambios y enviar trabajador a revisión</button>
										</div>
									</div>
									<?php
								}
								?>
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