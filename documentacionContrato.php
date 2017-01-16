<?php
session_start();
include('php/destruye_sesion.php');
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
		$_SESSION['numeroContrato'] = getNumeroContrato($id);
		$_SESSION['contratoActual'] = $id;
		$contenido = getVerDocContrato($id);
		list($url1,$val1,$obs1,$mod1,
			$url2,$val2,$obs2,$mod2,
			$url3,$val3,$obs3,$mod3,
			$url4,$val4,$obs4,$mod4) = explode("%$", $contenido);
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
		$empresaId = getEmpresaContrato($id);
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
			<script src="js/subirDocumentosContrato.js"></script>
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
								<div class="col-xs-8 col-sm-8 col-md-8"><b>
								<?php if($nombreUsuario!="Contratista"){?>
								<a href="listarContratistas.php" title="">Empresas Contratistas</a> 
								<?php } ?>
								<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> 
								<a href="listarContratos.php?id=<?php echo $empresaId; ?>" title="">Contratos Vigentes</a>
								<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> 
								Documentación - <?php echo $_SESSION['numeroContrato']; ?></b>
								</div>
							</header>

							<div class="content-inner">
								<div class="row comments-row">
								<?php 									
									imprimirDocumento("CONTRATO COMERCIAL",$date1,$mod1,$obs1,$_SESSION['numeroContrato'],$url1,$val1,"1","Contrato");
									
									imprimirDocumento("JORNADA EXCEPCIONAL",$date2,$mod2,$obs2,$_SESSION['numeroContrato'],$url2,$val2,"2","Contrato");

									imprimirDocumento("CARPETA DE ARRANQUE",$date3,$mod3,$obs3,$_SESSION['numeroContrato'],$url3,$val3,"3","Contrato");

									imprimirDocumento("ADICIONAL",$date4,$mod4,$obs4,$_SESSION['numeroContrato'],$url4,$val4,"4","Contrato");
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
																<input id="1" type="checkbox" class="docsCheck" value="1">Contrato Comercial
															</label>
														</div>
													</div>
													<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
														<div class="checkbox">
															<label for="2">
																<input id="2" type="checkbox" class="docsCheck" value="2">Jornada Excepcional
															</label>
														</div>
													</div>
													<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
														<div class="checkbox">
															<label for="3">
																<input id="3" type="checkbox" class="docsCheck" value="3">Carpeta de Arranque
															</label>
														</div>
													</div>
													<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
														<div class="checkbox">
															<label for="4">
																<input id="4" type="checkbox" class="docsCheck" value="4">Adicional
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
			</div>
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