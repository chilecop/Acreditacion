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
    <script type="text/javascript">
      $(document).ready(function() {
          $("#emandante_btn").click(function(event) {
            $("#select_empresa2").toggle(false);
            $("#select_empresa").toggle('slow');
            $('html, body').animate({
              scrollTop: $(document).height()
              },1500);
            return false;
          });

          $("#econtratista_btn").click(function(event) {
            $("#select_empresa").toggle(false);
            $("#select_empresa2").toggle('slow');
            $('html, body').animate({
              scrollTop: $(document).height()
              },1500);
            return false;
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
              <h2 class="page_title">Ingresar Orden de Contrato</h2>
            </header>
            <div class="content-inner">
              <div class="form-wrapper">              
                <form action="php/ingresarMandante.php" method="post">
                  <div class="content-inner cuadroN2">
                    <div class="row">
                      <p>Seleccione el tipo de empresa para la cual entrega servicios.</p>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <button id="emandante_btn" type="submit" class="btn btn-default">Empresa Mandante</button>
                        <button id="econtratista_btn" type="submit" class="btn btn-default">Otra empresa contratista</button>
                        <div id="select_empresa" class="form-group">
                          <?php getSelect(mandante,ID_MANDANTE,N_FANTASIA);?>
                        </div>
                        <div id="select_empresa2" class="form-group">
                          <?php getSelect(empresa_contratista,ID_CONTRATISTA,N_FANTASIA);?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <p>Ingrese cada uno de los datos para agregar la orden de contrato. Todos los datos son requeridos.</p><br>
                  <div class="row">
                    <div class="col-md-4 col-lg-4">                      
                      <div class="form-group">
                        <label class="">Inicio Contrato</label>
                        <input class="pull-right" type="date" name="fechainicio" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Inicio" required/>
                      </div>
                      <div class="form-group">
                        <label class="">Término Contrato</label>
                        <input class="pull-right" type="date" name="fechatermino" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Termino" required/>
                      </div>
                      <div class="form-group">
                        <label class="">Inicio Jornada</label>
                        <input class="pull-right" type="date" name="iniciojornada" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Inicio" required/>
                      </div>
                      <div class="form-group">
                        <label class="">Término Jornada</label>
                        <input class="pull-right" type="date" name="terminojornada" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Termino" required/>
                      </div>
                      <form method="post" id="formulario" enctype="multipart/form-data">
                        <div class="form-group">
                          <label class="">Archivo Jornada</label>
                          <span class="btn btn-default btn-file pull-right">
                            Subir Archivo <input type="file" name="file">
                          </span>
                          <div id="respuesta">respuesta</div>
                        </div>
                      </form>
                      <div class="form-group">
                        <label class="">Emisión Sernageomín</label>
                        <input class="pull-right" type="date" name="sernageomin" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Sernageomín" required/>
                      </div>
                      <form method="post" id="formulario" enctype="multipart/form-data">
                        <div class="form-group">
                          <label class="">Archivo Sernageomín</label>
                          <span class="btn btn-default btn-file pull-right">                            
                            Subir Archivo <input type="file" name="file">
                          </span>
                          <div id="respuesta"></div>
                        </div>
                      </form>
                      <div class="form-group">
                        <label class="">Afiliación Mutual</label>
                        <input class="pull-right" type="date" name="fechamutual" value="<?php echo date('Y-m-d'); ?>" placeholder="Afiliación Mutual" required/>
                      </div> 
                      <form method="post" id="formulario" enctype="multipart/form-data">
                        <div class="form-group">
                          <label class="">Archivo Mutual</label>
                          <span class="btn btn-default btn-file pull-right">
                            Subir Archivo <input type="file" name="file">
                          </span>
                          <div id="respuesta"></div>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <div class="form-group">
                        <label class="sr-only">N° Contrato</label>
                        <input type="text" class="form-control" id="title" placeholder="Número de Contrato" name="ncontrato" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Descripción Contrato</label>
                        <input type="text" class="form-control" id="title" placeholder="Descripción" name="nombre" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Administrador Contacto</label>
                        <input type="text" class="form-control" id="title" placeholder="Administrador de Contacto" name="n_contacto" required>
                      </div>    
                      <div class="form-group">
                          <label class="sr-only">Fono</label>
                          <input type="text" class="form-control" id="title" placeholder="Fono" name="fono" required>
                      </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <div class="form-group">
                        <label class="sr-only">E-mail</label>
                        <input type="email" class="form-control" id="title" placeholder="E-mail" name="email" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Jornada Excepcional</label>
                        <input type="text" class="form-control" id="title" placeholder="Jornada Excepcional" name="jexcepcional" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Tipo Jornada</label>
                        <input type="text" class="form-control" id="title" placeholder="Tipo Jornada" name="tjornada" required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">N° Resolución</label>
                        <input type="text" class="form-control" id="title" placeholder="Número Resolución" name="nresolucion" required>
                      </div>
                      <div class="clearfix">
                        <button type="submit" class="btn btn-primary pull-right"> Ingresar Orden de Contrato</button>
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