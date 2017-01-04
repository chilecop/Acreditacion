<?php
session_start();
if($_SESSION['nombreUsuario']){
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php 
    include('php/consultasAcreditacion.php');
    tituloPanel();
    if(isset($_SESSION["idContratista"])){
      $id = $_SESSION["idContratista"];
    }else{
      $id = $_GET['id'];
    }
    $contenido = getVerEmpresaContratista($id);
    list($n_fantasia,$n_contacto,$rut,$mail_contacto,$fono,$rep,$observacion,$f_registro,$d_casa_matriz,$d_sucursal,$mutualidad,$responsable,$emailresponsable) = explode("%$", $contenido);
	$time = strtotime($f_registro);
		if($time === false or $time === -62169968592){ 
		$f_registro = '00-00-0000'; } 
		else {$f_registro = date('d-m-Y', $time);
		}
    ?>

    <!-- Bootstrap -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendor/chosen/chosen.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/font-awesome-4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/summernote/summernote.css">
    <link rel="stylesheet" type="text/css" href="css/estilosAdmin.css">
    <link rel="stylesheet" type="text/css" href="css/new-article.css">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
            <header>
              <h2 class="page_title">Ver Empresa Contratista</h2>
            </header>
            <div class="content-inner">
              <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                  <p><b>Nombre de Fantasía</b></p>
                  <p><?php echo $n_fantasia; ?></p>
                  <p><b>Rut</b></p>
                  <p><?php echo $rut; ?></p>
                  <p><b>Nombre de Contacto</b></p>
                  <p><?php echo $n_contacto; ?></p>
                  <p><b>E-mail</b></p>
                  <p><?php echo $mail_contacto; ?></p>
                  <p><b>Fono</b></p>
                  <p><?php echo $fono; ?></p>
                  <p><b>Representante</b></p>
                  <p><?php echo $rep; ?></p>
                  <p><b>Responsable</b></p>
                  <p><?php echo $responsable; ?></p>
                  <p><b>E-mail Representante</b></p>
                  <p><?php echo $emailresponsable; ?></p>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                    <p><b>Observación</b></p>
                    <p><?php echo $observacion; ?></p>
                    <p><b>Fecha de Registro</b></p>
                    <p><?php echo $f_registro; ?></p>
                    <p><b>Dirección Casa Matríz</b></p>
                    <p><?php echo $d_casa_matriz; ?></p>
                    <p><b>Dirección Sucursal</b></p>
                    <p><?php echo $d_sucursal; ?></p>
                    <p><b>Mutualidad</b></p>
                    <p><?php echo $mutualidad; ?></p>
                    <div class="ver_buttons">
                      <a class='btn btn-xs btn-default' href='listarContratos.php?id=<?php echo $id; ?>' role='button'>Ver Contratos</a>
                      <a class='btn btn-xs btn-default' href='documentacionEmpresa.php' role='button'>Ver Documentos</a>
                      <a class='btn btn-xs btn-warning' href='editarContratista.php' role='button'>Editar</a>
                  </div>     
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
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
  header("location: http://www.chilecop.cl/caccesodemo/index.html");
}
?>