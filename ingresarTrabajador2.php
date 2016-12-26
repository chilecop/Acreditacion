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
    <script src="//code.jquery.com/jquery-latest.js"></script>
    <script>
      function llenarContratos()
      {
        var empresaSelect = document.getElementById("empresa");
        var contratos = document.getElementById("contratos");
        var seleccionada = empresaSelect.options[empresaSelect.selectedIndex].value
        if(seleccionada!=0){
          $.ajax({
            data: {'empresa':seleccionada},
            type: "POST",
            datatype: "json",
            url: "php/getContratos.php",
            success: function(response)
            {
              var contratosRecibidos = JSON.parse(response);
              for (var i = 0; i < contratosRecibidos.length; i++)
              {
                contratos.options[i] = new Option(contratosRecibidos[i].numero,contratosRecibidos[i].id);
              }
            }
          });
        }else{
          contratos.options[0] = new Option("Seleccionar Empresa...",0);
        }
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
              <h2 class="page_title">Ingresar Trabajador</h2>
            </header>
            <div class="content-inner">
              <div class="form-wrapper">
              <p>Ingrese cada uno de los datos para agregar al trabajador al sistema. Todos los datos son requeridos.</p>
                <form action="php/addTrabajador.php" method="post">
                  <div class="row">
                    <div class="col-md-4 col-lg-4">
                      <div class="form-group">
                        <label class="">Empresa</label>
                        <?php getSelectEmpresas(); ?>
                      </div>
                      <div class="form-group">
                        <label class="">Contrato</label>
                        <select name="idcontrato" id="contratos" required>
                          <option value="">Seleccionar Empresa...</option>
                        </select>
                      </div>
                       <div class="form-group">
                        <label class="sr-only">Rut</label>
                        <input type="text" class="form-control" id="title" placeholder="Rut" name="rut" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Nombre</label>
                        <input type="text" class="form-control" id="title" placeholder="Nombre" name="nombre" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Apellidos</label>
                        <input type="text" class="form-control" id="title" placeholder="Apellidos" name="apellidos" required>
                      </div>
                      <div class="form-group">
                        <label class="">Fecha Nacimiento</label>
                        <input type="date" class="form-control" id="title" name="fnac" required>
                      </div>
                      <div class="form-group">
                          <label class="">Sexo</label><br>
                          <input type="radio" name="sexo" value="1"> Masculino<br>
                          <input type="radio" name="sexo" value="2"> Femenino<br>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Nacionalidad</label>
                        <input type="text" class="form-control" id="title" placeholder="Nacionalidad" name="nacionalidad" required>
                      </div>
                      <div class="form-group">
                        <label>Tipo de Visa</label>
                        <?php getSelect(visa,id_visa,descripcion); ?>
                      </div>  
                      <div class="form-group">
                        <label class="">Fecha Vencimiento de Visa (si aplica)</label>
                        <input type="date" class="form-control" id="title" name="fVencVisa">
                      </div>                                           
                    </div>
                    <div class="col-md-4 col-lg-4">   
                      <div class="form-group">
                        <label class="sr-only">Cargo</label>
                        <input type="text" class="form-control" id="title" placeholder="Cargo" name="cargo" required>
                      </div>                   
                      <div class="form-group">
                        <label class="sr-only">Dirección</label>
                        <input type="text" class="form-control" id="title" placeholder="Dirección" name="direccion" required>
                      </div>
                      <div class="form-group">
                        <label>Region</label>
                        <?php getSelect(regiones,region_id,region_nombre); ?>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Ciudad</label>
                        <input type="text" class="form-control" id="title" placeholder="Ciudad" name="procedencia">
                      </div> 
                      <div class="form-group">
                        <label class="sr-only">Fono</label>
                        <input type="text" class="form-control" id="title" placeholder="Fono" name="fono" required>
                      </div> 
                      <div class="form-group">
                        <label class="">Inicio Contrato</label>
                        <input class="pull-right" type="date" name="fechainicio" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Inicio Contrato" required/>
                      </div>
                      <div class="form-group">
                        <label class="">Término Contrato</label>
                        <input class="pull-right" type="date" name="fechatermino" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Termino Contrato" required/>
                      </div>
                      <div class="form-group">
                        <label class="">Inicio de Pase</label>
                        <input class="pull-right" type="date" name="iniciopase" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Inicio Pase" required/>
                      </div>
                      <div class="form-group">
                        <label class="">Término de Pase</label>
                        <input class="pull-right" type="date" name="terminopase" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Termino Pase" required/>
                      </div> 
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <div class="form-group">
                        <label>Tipo de Contrato</label>
                        <?php getSelect(tipo_contrato,id_tipo_contrato,descripcion); ?>
                      </div>       
                      <div class="form-group">
                        <label>Tipo de Pase</label>
                        <?php getSelect(tipo_pase,id_tipo_pase,descripcion); ?>
                      </div>  
                      <div class="form-group">
                        <label>Sector Asignado</label>
                        <?php getSelect(sectores,id_sector,descripcion); ?>
                      </div>  
                      <?php 
                      if($_SESSION['nombreUsuario']=="Admin"){
                      ?>
                        <div class="form-group">
                          <label>Tipo de Turno</label>
                          <?php getSelect(tipo_turno,id_tipo_turno,descripcion); ?>
                        </div>      
                      <?php
                        }
                      ?>
                      <div class="clearfix">
                        <button type="submit" class="btn btn-primary pull-right"> Ingresar Trabajador</button>
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