<?php
session_start();
include('php/destruye_sesion.php');
if($_SESSION['nombreUsuario']){
  $usuario = $_SESSION['nombreUsuario'];
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
      $direccion,
      $nacionalidad,
      $fechainiciocontrato,
      $fechaterminocontrato,
      $iniciopase,
      $terminopase,
      $fvencvisa,
      $sexo,
      $tipopase,
      $ncontrato,
      $gsanguineo,
      $tcontrato,
      $region,
      $sector,
      $tipovisa,
      $jornada,
      $idtipopase,
      $induccion,
      $nfantasia) = explode("%$", $contenido);

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

        $(document).ready(function() {
          $('input[type=radio][name=induccion]').change(function() {
              var id = document.getElementById("id").value;
              var valor = this.value;
              $.ajax({
                data: {'id': id,'valor': valor},
                type: "POST",
                url: "php/cambiarInduccion.php",
                success: function(data)
                {
                  alert("Modificación de inducción correcta, ahora es " + valor);
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
              <header class="clearfix">
                <div class="col-xs-5 col-sm-3 col-md-3"><b>Ver Personal - <?php echo $nfantasia; ?></b></div>
                <div class="col-xs-7 col-sm-9 col-md-9">
                  <a style="margin-left:1em; margin-bottom:0.5em;" class='btn btn-xs btn-warning pull-right' href='editarPersonal.php?id=<?php echo $id; ?>' role='button'>Editar</a>  
                  <a style="margin-left:1em; margin-bottom:0.5em;" class='btn btn-xs btn-default pull-right' href='documentacionPersonal.php?id=<?php echo $id; ?>' role='button'>Ver Documentación</a>
                  <!-- <a class="btn btn-xs btn-success pull-right" href='php/generarCredencial.php?id=<?php echo $id; ?>' role="button">Generar Credencial</a> -->
                </div>
              </header>
              <div class="content-inner">
                <div class="row">
                  <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <div class="well well-sm comments-well">
                        <img class="imagen-articulo" src="<?php verFotoPersona($id); ?>"/>
                        <div class="pie-imagen-articulo">
                          <p><?php echo $nombres . " " .$apellidos; ?></p>
                          <p><?php echo $rut; ?></p>
                        </div>                    
                        <!-- En el siguiente div mantengo el estado actual -->
                        <input id="id" type="hidden" value="<?php echo $id; ?>">
                        <input id="tipousuario" type="hidden" value="<?php echo $_SESSION['nombreUsuario']; ?>">
                        <div id="estadoId" style="display:none;"><?php echo $estado; ?></div>
                        <div id="estado" class="estado <?php echo $estadoClass; ?>"><?php echo $estadoTxt; ?></div>
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <p><b>INFORMACIÓN PERSONAL</b></p>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <p><b>Sexo</b></p>
                        <p><?php echo $sexo; ?></p>
                        <p><b>Cargo</b></p>
                        <p><?php echo $cargo; ?></p>
                        <p><b>Fecha Nacimiento</b></p>
                        <p><?php echo $f_nacimiento; ?></p>
                        <p><b>Alergias</b></p>
                        <p><?php echo $alergias; ?></p>
                        <p><b>Grupo Sanguíneo</b></p>
                        <p><?php echo $gsanguineo; ?></p>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <p><b>Nacionalidad</b></p>
                        <p><?php echo $nacionalidad; ?></p>
                        <p><b>Región</b></p>
                        <p><?php echo $region; ?></p>
                        <p><b>Procedencia</b></p>
                        <p><?php echo $procedencia; ?></p>
                        <p><b>Dirección</b></p>
                        <p><?php echo $direccion; ?></p>
                        <p><b>Fono</b></p>
                        <p><?php echo $fono_emergencia; ?></p>                      
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <p><b>INFORMACIÓN LABORAL</b></p>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <p><b>Inicio Contrato</b></p>
                        <p><?php echo $fechainiciocontrato; ?></p>
                        <p><b>Término Contrato</b></p>
                        <p><?php echo $fechaterminocontrato; ?></p>
                        <p><b>Acreditado el</b></p>
                        <p><?php echo $iniciopase; ?></p>
                        <p><b>Término de Pase</b></p>
                        <p><?php echo $terminopase; ?></p>
                        <p><b>Tipo de Visa</b></p>
                        <p><?php echo $tipovisa; ?></p>
                        <p><b>Vencimiento Visa</b></p>
                        <p><?php echo $fvencvisa; ?></p>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <p><b>Tipo de Pase</b></p>
                        <p><?php echo $tipopase; ?></p>
                        <p><b>Tipo Contrato</b></p>
                        <p><?php echo $tcontrato; ?></p>
                        <p><b>Número de Contrato</b></p>
                        <p><?php echo $ncontrato; ?></p>
                        <p><b>Sector de Trabajo</b></p>
                        <p><?php echo $sector; ?></p>
                        <p><b>Jornada de Trabajo</b></p>
                        <p><?php echo $jornada; ?></p>
                        <?php if($usuario == "Admin"){?>
                        <p><b>Inducción</b></p>
                        <input type="radio" name="induccion" value="Si" <?php if($induccion=="Si") echo "checked"; ?>> Si<br>
                        <input type="radio" name="induccion" value="No" <?php if($induccion=="No") echo "checked"; ?>> No<br>
                        <?php } ?>
                      </div>              
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="well well-sm comments-well">
                      <p><b>DOCUMENTOS ASOCIADOS</b></p>
                      <?php
                      if($idtipopase==1 || $idtipopase==4 || $idtipopase==6)
                        imprimirDocumentoVer("Contrato de Trabajo","URL_1","Persona",$rut,$id);
                      if($idtipopase==1 )
                        imprimirDocumentoVer("Inducción","URL_2","Persona",$rut,$id);
                      imprimirDocumentoVer("Fotografía Tamaño Carnet","URL_3","Persona",$rut,$id);
                      imprimirDocumentoVer("Consentimiento test alcohol y drogas","URL_4","Persona",$rut,$id);
                      if($idtipopase == 1 || $idtipopase == 4 || $idtipopase == 6)
                        imprimirDocumentoVer("Fotocopia Cédula","URL_5","Persona",$rut,$id);
                      imprimirDocumentoVer("Examen Pre-Ocupacional","URL_6","Persona",$rut,$id);
                      if($idtipopase == 1 || $idtipopase == 4)
                        imprimirDocumentoVer("ODI","URL_7","Persona",$rut,$id);
                      if($idtipopase == 1)
                        imprimirDocumentoVer("Reglamento Interno","URL_8","Persona",$rut,$id);
                      if($idtipopase == 1 || $idtipopase == 4 || $idtipopase == 6)
                        imprimirDocumentoVer("Entrega EPP","URL_9","Persona",$rut,$id);
                      if($idtipopase == 1)
                        imprimirDocumentoVer("Último Finiquito","URL_10","Persona",$rut,$id);
                      if($idtipopase == 1)
                        imprimirDocumentoVer("Certificado Antecedentes","URL_11","Persona",$rut,$id);
                      if($idtipopase == 1)
                        imprimirDocumentoVer("Certificado de Estudios","URL_12","Persona",$rut,$id);
                      if($idtipopase == 1)
                        imprimirDocumentoVer("Acreditación Prevencionista","URL_13","Persona",$rut,$id);
                      if($idtipopase == 1)
                        imprimirDocumentoVer("Certificado de Aprobación","URL_14","Persona",$rut,$id);
                      imprimirDocumentoVer("Anexo 1","URL_15","Persona",$rut,$id);
                      imprimirDocumentoVer("Anexo 2","URL_16","Persona",$rut,$id);
                      imprimirDocumentoVer("Anexo 3","URL_17","Persona",$rut,$id);
                      imprimirDocumentoVer("Otros","URL_18","Persona",$rut,$id);
                      if($idtipopase == 3 || $idtipopase == 5)
                        imprimirDocumentoVer("Guía de despacho o factura del material","URL_19","Persona",$rut,$id);
                      if($idtipopase == 3 || $idtipopase == 5)
                        imprimirDocumentoVer("Documentación legal del Vehículo","URL_20","Persona",$rut,$id);
                      if($idtipopase == 3 || $idtipopase == 5)
                        imprimirDocumentoVer("Check list del vehículo","URL_21","Persona",$rut,$id);
                      if($idtipopase == 3 || $idtipopase == 5)
                        imprimirDocumentoVer("Licencia municipal de conducir vigente","URL_22","Persona",$rut,$id);
                      if($idtipopase == 6)
                        imprimirDocumentoVer("Visa de trabajo","URL_23","Persona",$rut,$id);
                      ?>
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
      header("location: http://www.chilecop.cl/accesoAcreditacion.html");
    }
    ?>