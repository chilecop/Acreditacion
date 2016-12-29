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
    if(isset($_GET['id'])){
      $id = $_GET['id'];
    }
    $contenido = getVerMandante($id);
    list($rut,$n_fantasia,$n_contacto,$obs,$fono,$f_registro,$representante,$mail) = explode("%$", $contenido);
    ?>

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
      $(function(){
        $("input[name='file']").on("change", function(){
          var formData = new FormData($("#formulario")[0]);
          var ruta = "imagen-ajax.php";
          $.ajax({
            url: ruta,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos)
            {
              $("#respuesta").html(datos);
            }
          });
        });
      });
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
              <h2 class="page_title">Editar Empresa Mandante</h2>
            </header>
            <div class="content-inner">
              <div class="form-wrapper">
              <p>Ingrese cada uno de los datos para agregar a la empresa mandante. Todos los datos son requeridos.</p>
                <form action="php/editMandante.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $id;?>">
                  <div class="row">
                    <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                        <label class="sr-only">Rut</label>
                        <input type="text" class="form-control" id="title" placeholder="Rut" name="rut" value="<?php echo $rut; ?>" required disabled>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Nombre de Fantasía</label>
                        <input type="text" class="form-control" id="title" placeholder="Nombre de fantasía" name="nombre" value="<?php echo $n_fantasia; ?>" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Nombre contacto</label>
                        <input type="text" class="form-control" id="title" placeholder="Nombre de Contacto" name="n_contacto" value="<?php echo $n_contacto; ?>" required>
                      </div>    
                      <div class="form-group">
                          <label class="sr-only">Fono</label>
                          <input type="text" class="form-control" id="title" placeholder="Fono" name="fono" value="<?php echo $fono; ?>" required>
                      </div>  
                    </div>
                    <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                        <label class="sr-only">Representante</label>
                        <input type="text" class="form-control" id="title" placeholder="Representante" name="representante" value="<?php echo $representante; ?>" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">E-mail</label>
                        <input type="email" class="form-control" id="title" placeholder="E-mail" name="email" value="<?php echo $mail; ?>" required>
                      </div>
                      <div class="form-group">
                        <label class="">Observación</label>
                        <textarea rows="4" cols="50" placeholder="Observación" name="observacion" class="form-control" required><?php echo $obs; ?></textarea>                        
                      </div>     
                      <div class="clearfix">
                        <button type="submit" class="btn btn-warning pull-right"> Editar Mandante</button>
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
    <script src="js/default.js"></script>
  </body>
</html>
<?php
}else{
  header("location: http://www.chilecop.cl/caccesodemo/index.html");
}
?>