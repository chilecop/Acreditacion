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
    include('php/consultas.php');
    tituloPanel();
    if(isset($_GET['id'])){
      $id = $_GET['id'];
      $datos = getDatosEmpresa($id);
      list($nombreEmpresa,$rut,$giro,$direccion,$ciudad,$representante,$email,$tipojornada,$otrajornada,$iniciocontrato,$terminocontrato,$contacto,$telefono) = explode("%$",$datos);
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
    <script src="js/jquery-1.10.1.min.js"></script>
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
              <h2 class="page_title">Editar Empresa</h2>
            </header>
            <div class="content-inner">
              <div class="form-wrapper">
                <form action="php/editarEmpresa.php" method="post">
                  <div class="row">
                    <div class="col-md-6 col-lg-6">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <div class="form-group">
                        <label class="sr-only">Nombre Empresa</label>
                        <input type="text" class="form-control" id="title" placeholder="Nombre" name="nombre" value="<?php echo $nombreEmpresa; ?>" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Rut</label>
                        <input type="text" class="form-control" id="title" placeholder="Rut" name="rut" value="<?php echo $rut; ?>" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Giro</label>
                        <input type="text" class="form-control" id="title" placeholder="Giro" name="giro" value="<?php echo $giro; ?>" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Dirección</label>
                        <input type="text" class="form-control" id="title" placeholder="Dirección" name="direccion" value="<?php echo $direccion; ?>" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Ciudad</label>
                        <input type="text" class="form-control" id="title" placeholder="Ciudad" name="ciudad" value="<?php echo $ciudad; ?>" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Representante Legal</label>
                        <input type="text" class="form-control" id="title" placeholder="Representante Legal" name="representante" value="<?php echo $representante; ?>"  required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Email</label>
                        <input type="email" class="form-control" id="title" placeholder="Email" name="email" value="<?php echo $email; ?>"  required>
                      </div>
                    </div>
                    <div class="col-md-5 col-lg-5">
                      <div class="form-group">
                        <label class="sr-only">Tipo de Jornada</label>
                        <?php getJornada(1,$tipojornada);?>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Jornada Adicional</label>
                        <?php getJornada(2,$otrajornada);?>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Inicio de Contrato</label>
                        <input type="date" class="form-control" id="title" name="icontrato" value="<?php echo $iniciocontrato; ?>"  required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Término de Contrato</label>
                        <input type="date" class="form-control" id="title" name="tcontrato" value="<?php echo $terminocontrato; ?>"  required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Contacto Emergencia</label>
                        <input type="text" class="form-control" id="title" placeholder="Contacto Emergencia" name="contacto" value="<?php echo $contacto; ?>"  required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Teléfono Emergencia</label>
                        <input type="text" class="form-control" id="title" placeholder="Teléfono Emergencia" name="telefono" value="<?php echo $telefono; ?>"  required>
                      </div>
                      <div class="clearfix">
                        <button type="submit" class="btn btn-warning pull-right">Editar Empresa</button>
                      </div>
                    </div>
                  </div>
                </form>
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
    <script type="text/javascript" src="vendor/chosen/chosen.jquery.min.js"></script>
    <script type="text/javascript" src="vendor/summernote/summernote.min.js"></script>
    <script src="js/default.js"></script>
    <script type="text/javascript">
      var config = {
        '.chosen-select' : {},
        'chosen-select-deselect' : {allow_single_deselect: true},
        'chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-result': {no_result_text: 'Oops, nothing found'},
        '.chosen-select-width' : {width: "95%"}
      }
      for(var selector in config) {
        $(selector).chosen(config[selector]);
      }
    </script>

    <script type="text/javascript">
      $('.summernote').summernote({
        height: 200
      })
    </script>
  </body>
</html>
<?php
}else{
  header("location: http://www.chilecop.cl/caccesodemo/index.html");
}
?>