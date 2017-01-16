<?php
session_start();
include('php/destruye_sesion.php');
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
    tituloPanel();?>

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
    <script>
      $(document).ready(function() {
        $('#formulario').submit(function() {
          $.ajax({
            type: 'POST',
            url: "php/ingresarVehiculo.php",
            data: $(this).serialize(),
            success: function(data) {
              if(data=='ok'){
                $('#respuesta').html("Vehiculo ingresado correctamente.");
              }else{
                $('#respuesta').html("");
                alert(data);
              }
            }
          })
          return false;
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
            <header>
              <h2 class="page_title">Ingresar Vehiculo</h2>
            </header>
            <div class="content-inner">
              <div class="form-wrapper">
              <div id="respuesta"></div>
                <form id="formulario" action="php/ingresarVehiculo.php" method="post">
                  <div class="row">
                    <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                        <label class="sr-only">Patente</label>
                        <input type="text" class="form-control" id="title" placeholder="Patente" name="patente" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Rut Conductor</label>
                        <input type="text" class="form-control" id="title" placeholder="Rut Conductor" name="rut" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Marca</label>
                        <input type="text" class="form-control" id="title" placeholder="Marca" name="marca" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Modelo</label>
                        <input type="text" class="form-control" id="title" placeholder="Modelo" name="modelo" required>
                      </div>
                    </div>
                    <div class="col-md-5 col-lg-5">
                      <div class="form-group">
                        <label class="sr-only">Tipo</label>
                        <?php getTipoVehiculoSelect();?>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Color</label>
                        <input type="text" class="form-control" id="title" placeholder="Color" name="color">
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Año</label>
                        <input type="text" class="form-control" id="title" placeholder="Año" name="anio">
                      </div>
                      
                      <div class="clearfix">
                        <button type="submit" class="btn btn-primary pull-right"> Ingresar Vehiculo</button>
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