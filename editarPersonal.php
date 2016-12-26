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
    if(isset($_GET['id'])){
      $id = $_GET['id'];
    }
    tituloPanel();
	  $contenido = getEditPersona($id);
    list($sexo,$tipopase,$contrato,$turno,$sangre,$rut,$nombres,$apellidos,$cargo,$f_nacimiento,$nacionalidad,$visa,$facreditacion,$procedencia,$alergias,$comuna,$fono_emergencia,$direccion,$fregistro) = explode("%$", $contenido);
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
              <h2 class="page_title">Editar Trabajador</h2>
            </header>
            <div class="content-inner">
              <div class="form-wrapper">
              <p>Modifique los datos necesarios para actualizar al trabajador en el sistema. Todos los datos son requeridos.</p>
                <form action="php/editarTrabajador.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <div class="row">
                    <div class="col-md-4 col-lg-4">
                      <div class="form-group">
                        <label class="">Rut</label>
                        <input type="text" class="form-control" id="title" placeholder="Rut" name="rut" value="<?php echo $rut; ?>" required>
                      </div>
                      <div class="form-group">
                        <label class="">Nombre</label>
                        <input type="text" class="form-control" id="title" placeholder="Nombre" name="nombre" value="<?php echo $nombres; ?>" required>
                      </div>
                      <div class="form-group">
                        <label class="">Apellidos</label>
                        <input type="text" class="form-control" id="title" placeholder="Apellidos" name="apellidos" value="<?php echo $apellidos; ?>" required>
                      </div>
                      <div class="form-group">
                        <label class="">Fecha Nacimiento</label>
                        <input type="date" class="form-control" id="title" name="fnac" value="<?php echo $f_nacimiento; ?>" required>
                      </div>
                      <div class="form-group">
                          <label class="">Sexo</label><br>
                          <input type="radio" name="sexo" value="1" <?php if($sexo==1)echo 'checked' ?>> Masculino<br>
                          <input type="radio" name="sexo" value="2" <?php if($sexo==2)echo 'checked' ?>> Femenino<br>
                      </div>
                      <div class="form-group">
                        <label class="">Nacionalidad</label>
                        <input type="text" class="form-control" id="title" placeholder="Nacionalidad" name="nacionalidad" required value="<?php echo $nacionalidad; ?>">
                      </div>                           
                    </div>
                    <div class="col-md-4 col-lg-4">   
                      <div class="form-group">
                        <label class="">Cargo</label>
                        <input type="text" class="form-control" id="title" placeholder="Cargo" name="cargo" value="<?php echo $cargo; ?>" required>
                      </div>                   
                      <div class="form-group">
                        <label class="">Dirección</label>
                        <input type="text" class="form-control" id="title" placeholder="Dirección" name="direccion" value="<?php echo $direccion; ?>" required>
                      </div>
                      <div class="form-group">
                        <label class="">Fono</label>
                        <input type="text" class="form-control" id="title" placeholder="Fono" name="fono" value="<?php echo $fono_emergencia; ?>" required>
                      </div>   
                      <div class="form-group">
                        <label class="">Visa</label>
                        <input type="text" class="form-control" id="title" placeholder="Visa" name="visa" value="<?php echo $visa; ?>">
                      </div>  
                      <div class="form-group">
                        <label class="">Procedencia</label>
                        <input type="text" class="form-control" id="title" placeholder="Procedencia" name="procedencia" value="<?php echo $procedencia; ?>">
                      </div>  
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <div class="form-group">
                        <label class="">Alergias</label>
                        <textarea rows="4" cols="50" placeholder="Alergias" name="alergias" class="form-control"><?php echo $alergias; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Grupo Sanguíneo</label>
                        <?php getSelect(grupo_sanguineo,id_grupo_sanguineo,descripcion,$sangre); ?>
                      </div>       
                      <div class="form-group">
                        <label>Tipo de Pase</label>
                        <?php getSelect(tipo_pase,id_tipo_pase,descripcion,$tipopase); ?>
                      </div>    
                      <div class="form-group">
                        <label>Tipo de Turno</label>
                        <?php getSelect(tipo_turno,id_tipo_turno,descripcion,$turno); ?>
                      </div>      
                                 
                      <div class="clearfix">
                        <button type="submit" class="btn btn-warning pull-right"> Editar Trabajador</button>
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
  </body>
</html>
<?php
}else{
  header("location: http://www.chilecop.cl/caccesodemo/index.html");
}
?>