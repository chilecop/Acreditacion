<?php
session_start();
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
	    list($url1,$val1,$mod1,$url2,$val2,$mod2,$url3,$val3,$mod3,$url4,$val4,$mod4,$url5,$val5,$mod5,$url6,$val6,$mod6,$url7,$val7,$mod7,$url8,$val8,$mod8,$url9,$val9,$mod9,$url10,$val10,$mod10) = explode("%$", $contenido);
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
	            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		            		<div class="documento col-sm-12 col-md-12">
		            			<div class="row">
		            				<div class="col-xs-8 col-sm-8 col-md-8">
		            					<b>Ficha Basica de Identificacion</b><br>
		            					<small>Caduca el <?php echo $date1; ?></small>
		            				</div>
		            				<div class="col-xs-4 col-sm-4 col-md-4">
		            					<div class="clearfix">
		            						<div class="pull-right comments-age"><small>Ultima Modificación: <br> <?php echo $mod1; ?></small></div>
		            					</div>
		            				</div>
		            			</div>
                                <div class="well well-sm comments-well">
		            				<textarea id="obs1" style="width:100%;"><?php echo $obs1; ?></textarea>
				            	</div>
		            			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					            	<form method="post" id="formulario" enctype="multipart/form-data">
				                        <div class="form-group">
				                          <label class="">
				                          	<div id="respuesta">            	
				                          		<?php 
				                          			echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoseecc/". $_SESSION['empresaActual'] . "/". $url1 ."'>" . $url1 . "</a>";
				                          		?>
				                          	</div>
				                          </label>
				                          <span class="btn btn-default btn-file">                            
				                            Subir Archivo <input type="file" name="file">
				                          </span>
				                        </div>
				                    </form>
			                    </div>
			                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			                    		<label class="">Caduca:</label>
			                    		<input id="val1" type="date" value="<?php echo $val1; ?>">
			                    	</div>	                    	
			                    </div>
		            		</div>
	            		</div>

	            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		            		<div class="documento col-sm-12 col-md-12">
		            			<div class="row">
		            				<div class="col-xs-8 col-sm-8 col-md-8">
		            					<b>Listado de trabajadores</b><br>
		            					<small>Caduca el <?php echo $date2; ?></small>
		            				</div>
		            				<div class="col-xs-4 col-sm-4 col-md-4">
		            					<div class="clearfix">
		            						<div class="pull-right comments-age"><small>Ultima Modificación: <br> <?php echo $mod2; ?></small></div>
		            					</div>
		            				</div>
		            			</div>
                                 <div class="well well-sm comments-well">
		            				<textarea id="obs2" style="width:100%;"><?php echo $obs2; ?></textarea>
				            	</div>
		            			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					            	<form method="post" id="formulario2" enctype="multipart/form-data">
				                        <div class="form-group">
				                          <label class="">
				                          	<div id="respuesta2">            	
				                          		<?php 
				                          			echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoseecc/". $_SESSION['empresaActual'] . "/". $url2 ."'>" . $url2 . "</a>";
				                          		?>
				                          	</div>
				                          </label>
				                          <span class="btn btn-default btn-file">                            
				                            Subir Archivo <input type="file" name="file2">
				                          </span>
				                        </div>
				                    </form>
			                    </div>
			                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			                    		<label class="">Caduca:</label>
			                    		<input id="val2" type="date" name="fecha_doc1" value="<?php echo $val2; ?>">	
			                    	</div>		                    	
			                    </div>
		            		</div>
	            		</div>
	            	</div>
	            	<div class="row comments-row">
	            	
	            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		            		<div class="documento col-sm-12 col-md-12">
		            			<div class="row">
		            				<div class="col-xs-8 col-sm-8 col-md-8">
		            					<b>Autorizacion de jornada excepcional</b><br>
		            					<small>Caduca el <?php echo $date3; ?></small>
		            				</div>
		            				<div class="col-xs-4 col-sm-4 col-md-4">
		            					<div class="clearfix">
		            						<div class="pull-right comments-age"><small>Ultima Modificación: <br> <?php echo $mod3; ?></small></div>
		            					</div>
		            				</div>
		            			</div>
                                 <div class="well well-sm comments-well">
		            				<textarea id="obs3" style="width:100%;"><?php echo $obs3; ?></textarea>
				            	</div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					            	<form method="post" id="formulario3" enctype="multipart/form-data">
				                        <div class="form-group">
				                          <label class="">
				                          	<div id="respuesta3">            	
				                          		<?php 
				                          			echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoseecc/". $_SESSION['empresaActual'] . "/". $url3 ."'>" . $url3 . "</a>";
				                          		?>
				                          	</div>
				                          </label>
				                          <span class="btn btn-default btn-file">                            
				                            Subir Archivo <input type="file" name="file3">
				                          </span>
				                        </div>
				                    </form>
			                    </div>
			                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			                    		<label class="">Caduca:</label>
			                    		<input id="val3" type="date" name="fecha_doc1" value="<?php echo $val3; ?>">	
			                    	</div>		                    	
			                    </div>
		            		</div>
	            		</div>

	            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		            		<div class="documento col-sm-12 col-md-12">
		            			<div class="row">
		            				<div class="col-xs-8 col-sm-8 col-md-8">
		            					<b>Contrato Comercial, OST o carta de adjudicacion</b><br>
		            					<small>Caduca el <?php echo $date4; ?></small>
		            				</div>
		            				<div class="col-xs-4 col-sm-4 col-md-4">
		            					<div class="clearfix">
		            						<div class="pull-right comments-age"><small>Ultima Modificación: <br> <?php echo $mod4; ?></small></div>
		            					</div>
		            				</div>
		            			</div>
                                 <div class="well well-sm comments-well">
		            				<textarea id="obs4" style="width:100%;"><?php echo $obs4; ?></textarea>
				            	</div>
		            			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					            	<form method="post" id="formulario4" enctype="multipart/form-data">
				                        <div class="form-group">
				                          <label class="">
				                          	<div id="respuesta4">            	
				                          		<?php 
				                          			echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoseecc/". $_SESSION['empresaActual'] . "/". $url4 ."'>" . $url4 . "</a>";
				                          		?>
				                          	</div>
				                          </label>
				                          <span class="btn btn-default btn-file">                            
				                            Subir Archivo <input type="file" name="file4">
				                          </span>
				                        </div>
				                    </form>
			                    </div>
			                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			                    		<label class="">Caduca:</label>
			                    		<input id="val4" type="date" name="fecha_doc1" value="<?php echo $val4; ?>">	
			                    	</div>		                    	
			                    </div>
		            		</div>
	            		</div>
	            	</div>
	            	<div class="row comments-row">
	            	
	            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		            		<div class="documento col-sm-12 col-md-12">
		            			<div class="row">
		            				<div class="col-xs-8 col-sm-8 col-md-8">
		            					<b>Certificado de Antecedentes Comerciales</b><br>
		            					<small>Caduca el <?php echo $date5; ?></small>
		            				</div>
		            				<div class="col-xs-4 col-sm-4 col-md-4">
		            					<div class="clearfix">
		            						<div class="pull-right comments-age"><small>Ultima Modificación: <br> <?php echo $mod5; ?></small></div>
		            					</div>
		            				</div>
		            			</div>
                                 <div class="well well-sm comments-well">
		            				<textarea id="obs5" style="width:100%;"><?php echo $obs5; ?></textarea>
				            	</div>
		            			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					            	<form method="post" id="formulario5" enctype="multipart/form-data">
				                        <div class="form-group">
				                          <label class="">
				                          	<div id="respuesta5">            	
				                          		<?php 
				                          			echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoseecc/". $_SESSION['empresaActual'] . "/". $url5 ."'>" . $url5 . "</a>";
				                          		?>
				                          	</div>
				                          </label>
				                          <span class="btn btn-default btn-file">                            
				                            Subir Archivo <input type="file" name="file5">
				                          </span>
				                        </div>
				                    </form>
			                    </div>
			                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			                    		<label class="">Caduca:</label>
			                    		<input id="val5" type="date" name="fecha_doc1" value="<?php echo $val5; ?>">	
			                    	</div>	                    	
			                    </div>
		            		</div>
	            		</div>

	            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		            		<div class="documento col-sm-12 col-md-12">
		            			<div class="row">
		            				<div class="col-xs-8 col-sm-8 col-md-8">
		            					<b>Certificado Afiliacion Mutualidad</b><br>
		            					<small>Caduca el <?php echo $date6; ?></small>
		            				</div>
		            				<div class="col-xs-4 col-sm-4 col-md-4">
		            					<div class="clearfix">
		            						<div class="pull-right comments-age"><small>Ultima Modificación: <br> <?php echo $mod6; ?></small></div>
		            					</div>
		            				</div>
		            			</div>
                                 <div class="well well-sm comments-well">
		            				<textarea id="obs6" style="width:100%;"><?php echo $obs6; ?></textarea>
				            	</div>
		            			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					            	<form method="post" id="formulario6" enctype="multipart/form-data">
				                        <div class="form-group">
				                          <label class="">
				                          	<div id="respuesta6">            	
				                          		<?php 
				                          			echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoseecc/". $_SESSION['empresaActual'] . "/". $url6 ."'>" . $url6 . "</a>";
				                          		?>
				                          	</div>
				                          </label>
				                          <span class="btn btn-default btn-file">                            
				                            Subir Archivo <input type="file" name="file6">
				                          </span>
				                        </div>
				                    </form>
			                    </div>
			                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			                    		<label class="">Caduca:</label>
			                    		<input id="val6" type="date" name="fecha_doc1" value="<?php echo $val6; ?>">	
			                    	</div>	                    	
			                    </div>
		            		</div>
	            		</div>
	            	</div>
                    <div class="row comments-row">
	            	
	            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		            		<div class="documento col-sm-12 col-md-12">
		            			<div class="row">
		            				<div class="col-xs-8 col-sm-8 col-md-8">
		            					<b>Certificado de Antecedentes Laborales y Previsionales (F30)</b><br>
		            					<small>Caduca el <?php echo $date7; ?></small>
		            				</div>
		            				<div class="col-xs-4 col-sm-4 col-md-4">
		            					<div class="clearfix">
		            						<div class="pull-right comments-age"><small>Ultima Modificación: <br> <?php echo $mod7; ?></small></div>
		            					</div>
		            				</div>
		            			</div>
                                 <div class="well well-sm comments-well">
		            				<textarea id="obs7" style="width:100%;"><?php echo $obs7; ?></textarea>
				            	</div>
		            			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					            	<form method="post" id="formulario7" enctype="multipart/form-data">
				                        <div class="form-group">
				                          <label class="">
				                          	<div id="respuesta7">            	
				                          		<?php 
				                          			echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoseecc/". $_SESSION['empresaActual'] . "/". $url7 ."'>" . $url7 . "</a>";
				                          		?>
				                          	</div>
				                          </label>
				                          <span class="btn btn-default btn-file">                            
				                            Subir Archivo <input type="file" name="file7">
				                          </span>
				                        </div>
				                    </form>
			                    </div>
			                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			                    		<label class="">Caduca:</label>
			                    		<input id="val7" type="date" name="fecha_doc1" value="<?php echo $val7; ?>">	
			                    	</div>	                    	
			                    </div>
		            		</div>
	            		</div>

	            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		            		<div class="documento col-sm-12 col-md-12">
		            			<div class="row">
		            				<div class="col-xs-8 col-sm-8 col-md-8">
		            					<b>Recepcion Carpeta de Arranca (Emitido por Joyglobal)</b><br>
		            					<small>Caduca el <?php echo $date8; ?></small>
		            				</div>
		            				<div class="col-xs-4 col-sm-4 col-md-4">
		            					<div class="clearfix">
		            						<div class="pull-right comments-age"><small>Ultima Modificación: <br> <?php echo $mod8; ?></small></div>
		            					</div>
		            				</div>
		            			</div>
                                 <div class="well well-sm comments-well">
		            				<textarea id="obs8" style="width:100%;"><?php echo $obs8; ?></textarea>
				            	</div>
		            			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					            	<form method="post" id="formulario8" enctype="multipart/form-data">
				                        <div class="form-group">
				                          <label class="">
				                          	<div id="respuesta8">            	
				                          		<?php 
				                          			echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoseecc/". $_SESSION['empresaActual'] . "/". $url8 ."'>" . $url8 . "</a>";
				                          		?>
				                          	</div>
				                          </label>
				                          <span class="btn btn-default btn-file">                            
				                            Subir Archivo <input type="file" name="file8">
				                          </span>
				                        </div>
				                    </form>
			                    </div>
			                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			                    		<label class="">Caduca:</label>
			                    		<input id="val8" type="date" name="fecha_doc1" value="<?php echo $val8; ?>">	
			                    	</div>	                    	
			                    </div>
		            		</div>
	            		</div>
	            	</div>
                    <div class="row comments-row">
	            	
	            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		            		<div class="documento col-sm-12 col-md-12">
		            			<div class="row">
		            				<div class="col-xs-8 col-sm-8 col-md-8">
		            					<b>Carpeta Tributaria</b><br>
		            					<small>Caduca el <?php echo $date9; ?></small>
		            				</div>
		            				<div class="col-xs-4 col-sm-4 col-md-4">
		            					<div class="clearfix">
		            						<div class="pull-right comments-age"><small>Ultima Modificación: <br> <?php echo $mod9; ?></small></div>
		            					</div>
		            				</div>
		            			</div>
                                 <div class="well well-sm comments-well">
		            				<textarea id="obs9" style="width:100%;"><?php echo $obs9; ?></textarea>
				            	</div>
		            			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					            	<form method="post" id="formulario9" enctype="multipart/form-data">
				                        <div class="form-group">
				                          <label class="">
				                          	<div id="respuesta9">            	
				                          		<?php 
				                          			echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoseecc/". $_SESSION['empresaActual'] . "/". $url9 ."'>" . $url9 . "</a>";
				                          		?>
				                          	</div>
				                          </label>
				                          <span class="btn btn-default btn-file">                            
				                            Subir Archivo <input type="file" name="file9">
				                          </span>
				                        </div>
				                    </form>
			                    </div>
			                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			                    		<label class="">Caduca:</label>
			                    		<input id="val9" type="date" name="fecha_doc1" value="<?php echo $val9; ?>">	
			                    	</div>	                    	
			                    </div>
		            		</div>
	            		</div>

	            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		            		<div class="documento col-sm-12 col-md-12">
		            			<div class="row">
		            				<div class="col-xs-8 col-sm-8 col-md-8">
		            					<b>Certificado de Confidencialidad</b><br>
		            					<small>Caduca el <?php echo $date10; ?></small>
		            				</div>
		            				<div class="col-xs-4 col-sm-4 col-md-4">
		            					<div class="clearfix">
		            						<div class="pull-right comments-age"><small>Ultima Modificación: <br> <?php echo $mod10; ?></small></div>
		            					</div>
		            				</div>
		            			</div>
                                 <div class="well well-sm comments-well">
		            				<textarea id="obs10" style="width:100%;"><?php echo $obs10; ?></textarea>
				            	</div>
		            			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					            	<form method="post" id="formulario10" enctype="multipart/form-data">
				                        <div class="form-group">
				                          <label class="">
				                          	<div id="respuesta10">            	
				                          		<?php 
				                          			echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoseecc/". $_SESSION['empresaActual'] . "/". $url10 ."'>" . $url10 . "</a>";
				                          		?>
				                          	</div>
				                          </label>
				                          <span class="btn btn-default btn-file">                            
				                            Subir Archivo <input type="file" name="file10">
				                          </span>
				                        </div>
				                    </form>
			                    </div>
			                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			                    		<label class="">Caduca:</label>
			                    		<input id="val10" type="date" name="fecha_doc1" value="<?php echo $val10; ?>">	
			                    	</div>	                    	
			                    </div>
		            		</div>
	            		</div>
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
</html>
<?php
}else{
  header("location: http://www.chilecop.cl/accesoAcreditacion.html");
}
?>