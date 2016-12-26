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
      $contenido = getVerPersona($id);
      list($estado,
        $rut,
        $nombres,
        $apellidos,
        $cargo,
        $f_nacimiento,
        $procedencia,
        $alergias,
        $fono_emergencia,
        $direccion) = explode("%$", $contenido);

      switch ($estado) {
        case '1':
          $estadoClass = "ok";
          $estadoTxt = "Aprobado";
          break;
        case '2':
          $estadoClass = "rechazado";
          $estadoTxt = "Rechazado";
          break;
        case '3':
          $estadoClass = "pendiente";
          $estadoTxt = "Pendiente";
          break;      
        default:
          $estadoClass = "pendiente";
          $estadoTxt = "Pendiente";
          break;
      }
      $time = strtotime($f_nacimiento);
  		if($time === false || $time === -62169968592){ 
  		  $f_nacimiento = '00-00-0000'; 
      } 
  		else {
        $f_nacimiento = date('d-m-Y', $time);
  		}
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
    <script src="js/jquery-1.10.1.min.js"></script>
    <script>
      $(function(){
        document.getElementById("estado").addEventListener("click", function(){
          var tipodeusuario = document.getElementById("tipousuario").value;
          var id = document.getElementById("id").value;
          var estadoActual = document.getElementById("estadoId").innerHTML;
          if(tipodeusuario=="Admin"){
            $.ajax({
              data: {'id': id,'estadoActual': estadoActual},
              type: "POST",
              url: "php/cambiarEstado.php",
              success: function(data)
              {
                switch (data) {
                  case '1':
                    $("#estadoId").html(data);
                    $("#estado").html("Aprobado");
                    $("#estado").removeClass("pendiente");
                    $("#estado").addClass("estado ok");
                    break;
                  case '2':
                    $("#estadoId").html(data);
                    $("#estado").html("Rechazado");
                    $("#estado").removeClass("ok");
                    $("#estado").addClass("estado rechazado");
                    break;
                  case '3':
                    $("#estadoId").html(data);
                    $("#estado").html("En revisión");
                    $("#estado").removeClass("rechazado");
                    $("#estado").addClass("estado pendiente");
                    break;                
                  default:
                    $("#estadoId").html('3');
                    $("#estado").html("En revisión");
                    $("#estado").addClass("estado pendiente");
                    break;
                }
              }
            });
          }

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
            <header class="clearfix">
              <div class="col-xs-5 col-sm-3 col-md-3"><b>Ver Personal</b></div>
              <div class="col-xs-7 col-sm-9 col-md-9">
                <a style="margin-left:1em; margin-bottom:0.5em;" class='btn btn-xs btn-warning pull-right' href='editarPersonal.php?id=<?php echo $id; ?>' role='button'>Editar</a>  
                <a style="margin-left:1em; margin-bottom:0.5em;" class='btn btn-xs btn-default pull-right' href='documentacionPersonal.php?id=<?php echo $id; ?>' role='button'>Ver Documentación</a>
                <!-- <a class="btn btn-xs btn-success pull-right" href='php/generarCredencial.php?id=<?php echo $id; ?>' role="button">Generar Credencial</a> -->
              </div>
            </header>
            <div class="content-inner">
              <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <img class="imagen-articulo" src="<?php verFotoPersona($id); ?>"/>
                  <!-- En el siguiente div mantengo el estado actual -->
                  <input id="id" type="hidden" value="<?php echo $id; ?>">
                  <input id="tipousuario" type="hidden" value="<?php echo $_SESSION['nombreUsuario']; ?>">
                  <div id="estadoId" style="display:none;"><?php echo $estado; ?></div>
                  <div id="estado" class="estado <?php echo $estadoClass; ?>"><?php echo $estadoTxt; ?></div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <p><b>Rut</b></p>
                  <p><?php echo $rut; ?></p>
                  <p><b>Nombre</b></p>
                  <p><?php echo $nombres . " " .$apellidos; ?></p>
                  <p><b>Cargo</b></p>
                  <p><?php echo $cargo; ?></p>
                  <p><b>Fecha Nacimiento</b></p>
                  <p><?php echo $f_nacimiento; ?></p>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <p><b>Procedencia</b></p>
                    <p><?php echo $procedencia; ?></p>
                    <p><b>Alergias</b></p>
                    <p><?php echo $alergias; ?></p>
                    <p><b>Fono Emergencia</b></p>
                    <p><?php echo $fono_emergencia; ?></p>
                    <p><b>Dirección</b></p>
                    <p><?php echo $direccion; ?></p>
                    
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
  header("location: http://www.chilecop.cl/accesoAcreditacion.html");
}
?>