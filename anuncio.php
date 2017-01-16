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
    <link rel="stylesheet" type="text/css" href="css/estilosAdmin.css">
    <link rel="stylesheet" type="text/css" href="css/new-article.css">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
      function enviar(){
          var obs = document.getElementById("observacion").value;
          var asunto = document.getElementById("asunto").value;
          $.ajax({
              type: 'POST',
              url: "php/mensajeMasivo.php",
              data: {'observacion':obs,'asunto':asunto},
              // Mostramos un mensaje con la respuesta de PHP
              success: function(data) {
              alert(data);
              document.getElementById("observacion").value = "";
              document.getElementById("asunto").value = "";
            }
          });
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
            <header>
              <h2 class="page_title">Anuncio</h2>
            </header>
            <div class="content-inner">
              <div class="form-wrapper">
              <p>Llene el siguiente formulario para enviar un mensaje a todos los usuarios del sistema.</p>
                  <div class="row">
                    <div class="col-md-8 col-lg-8">
                      <div class="form-group">
                        <label class="sr-only">Asunto</label>
                        <input id="asunto" type="text" class="form-control" id="title" placeholder="Asunto" name="asunto" >
                      </div>
                      <div class="form-group">
                        <label class="">Mensaje</label>
                        <textarea id="observacion" rows="4" cols="50" placeholder="Observación" name="observacion" class="form-control" ></textarea>
                      </div>     
                      <div class="clearfix">
                        <button onClick="enviar()" class="btn btn-primary pull-right"> Enviar Aviso</button>
                      </div>
                    </div>
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
</html>
<?php
}else{
  header("location: http://www.chilecop.cl/caccesodemo/index.html");
}
?>