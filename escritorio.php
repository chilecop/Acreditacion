<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
unset($_SESSION['primerInicio']);
include('php/destruye_sesion.php');
if($_SESSION['nombreUsuario']){
  $usuario = $_SESSION['nombreUsuario'];
?>
<!DOCTYPE html>
<html lang="">
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php 
    include('php/consultasAcreditacion.php');
    tituloPanel();
    $hoy = date('j-m-Y');
    $fecha = date('Y-m-j');
    $sietedias = strtotime ( '-6 day' , strtotime ( $hoy ) );
    $sietedias = date ( 'j-m-Y' , $sietedias );
    $idContratista = $_SESSION['idContratista'];
    setlocale(LC_ALL,"es_CL");
    if($_SESSION['nombreUsuario']=="Mandante"){
      $contenido = getVerMandante('2');
      list($rut,$n_fantasia,$n_contacto,$observacion,$fono,$f_registro,$representatne,$emailresponsable) = explode("%$", $contenido);
    }else{
      $contenido = getVerEmpresaContratista($idContratista);
      list($n_fantasia,$n_contacto,$rut,$mail_contacto,$fono,$rep,$observacion,$f_registro,$d_casa_matriz,$d_sucursal,$mutualidad,$responsable,$emailresponsable) = explode("%$", $contenido);
    }
    
    ?>
    <!-- Bootstrap -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilosAdmin.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/notificaciones.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery-1.10.1.min.js"></script>
    <script src="js/notificaciones.js"></script>
    <script type="text/javascript" src="vendor/chart/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="js/graficos.js"></script>
    <!--<script type="text/javascript" src="vendor/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <link rel="stylesheet" href="vendor/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="vendor/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    <link rel="stylesheet" href="vendor/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <script type="text/javascript" src="vendor/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="vendor/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    <link rel="stylesheet" href="vendor/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <script type="text/javascript" src="vendor/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <script type="text/javascript" src="vendor/chart/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="js/graficos.js"></script> 


    <script type="text/javascript">
            $(document).ready(function(){
              if (screen.width >= 1200) {
              $(".fancy").fancybox({
                   'width' : '60%',
                   'height' : '100%',
                   'autoScale' : false,
                   'transitionIn' : 'none',
                   'transitionOut' : 'none',
                   'type' : 'iframe'
               });
          }else{
            
          }
         });
    </script>
    <script src="vendor/chart.js/src/chart.js"></script>
    -->
  </head>
  <body>
    <div class="container-fluid display-table">
      <div class="row display-table-row">
        <?php 
        imprimirMenu();
        ?>
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
                  <?php if(isset($_SESSION['idContratista'])){?>
                  <li id="notification_li" class="fixed-width">
                    <a href="#" id="notificationLink">
                      <span class="glyphicon glyphicon-bell" aria-hidden="true"></span>
                      <span class="label label-warning" id="notification_count"><?php notificacionesCount($_SESSION['idContratista']); ?></span>
                    </a>
                    <div id="notificationContainer">
                      <div id="notificationTitle">Notificaciones</div>
                      <div id="notificationsBody" class="notifications">
                        <?php 
                        if(isset($_SESSION['idContratista'])){
                          notificaciones($_SESSION['idContratista']);
                        }
                        ?>
                      </div>
                    </div>
                  </li>
                  <?php } ?>
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

          <div id="dashboard-con">
            <!--
            <div class="row">
              <div class="col-md-6 dashboard-right-cell">
                <div class="admin-content-con">
                  <header>
                    <h5>Mensajes de Sistema</h5>
                  </header>

                  <div style="color:#1ab394;" class="comment-head-dash clearfix">
                    <div class="commenter-name-dash pull-left">Actualización</div>
                  </div>
                  <p style="color:#1ab394;" class="comment-dash">Actualización del sistema en sector B</p>
                  <small style="color:#1ab394;" class="comment-date-dash"><?php echo Date("d/m/Y"); ?></small>
                  <hr>
                  <div style="color:#1ab394;" class="comment-head-dash clearfix">
                    <div class="commenter-name-dash pull-left">Cambio tipo de turno</div>
                  </div>
                  <p style="color:#1ab394;" class="comment-dash">Cambio tipo de turno</p>
                  <small style="color:#1ab394;" class="comment-date-dash"><?php echo Date("d/m/Y"); ?></small>
                  <hr>
                </div>
              </div>
              <div class="col-md-6 dashboard-left-cell">
                <div class="admin-content-con">
                  <header class="clearfix">
                    <h5 class="pull-left">N° de registros en garitas</h5>
                  </header>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Garita</th>
                        <th>Entradas</th>
                        <th>Salidas</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Garita 1</td>
                        <td>18</td>
                        <td>14</td>
                      </tr>
                      <tr>
                        <td>Garita 2</td>
                        <td>32</td>
                        <td>15</td>
                      </tr>
                      <tr>
                        <td>Garita 3</td>
                        <td>43</td>
                        <td>16</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>             
            </div>
            -->
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <div class="admin-content-con clearfix">
                    <header class="clearfix">
                      <?php if($usuario=="Contratista"){ ?>
                      <h5 class="pull-left text-uppercase"><b>PROGRESO GENERAL DE LA EMPRESA</b></h5>
                      <?php }else { ?>
                      <h5 class="pull-left text-uppercase"><b>PROGRESO GENERAL DEL SISTEMA</b></h5>
                      <?php } ?>
                    </header>
                    <div class="progress">
                      <?php $porcentajeAvance = getPorcentajeAvance($_SESSION['idContratista']); ?>
                      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<? echo $porcentajeAvance; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <? echo $porcentajeAvance; ?>%;">
                        <? echo $porcentajeAvance; ?>%
                      </div>
                    </div>
                    <div class="panel panel-default">                 
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Información</th>
                            <th>Puntual</th>
                            <th>Porcentaje</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php 
                              $personalTotal = getContarPersonal($idContratista);
                              $personalPendiente = getContarPersonal($idContratista,'3');
                              $personalAcreditado = getContarPersonal($idContratista,'1');
                              $personalRechazado = getContarPersonal($idContratista,'2');

                            ?>
                            <td>Total de Personal</td>
                            <td><?php echo $personalTotal; ?></td>
                            <td>100%</td>
                          </tr>
                          <tr>
                            <td>Personal Acreditado</td>
                            <td><?php echo $personalAcreditado; ?></td>
                            <td><?php echo round(($personalAcreditado*100)/$personalTotal). "%"; ?></td>
                          </tr>
                          <tr>
                            <td>Personal Pendiente</td>
                            <td><?php echo $personalPendiente; ?></td>
                            <td><?php echo round(($personalPendiente*100)/$personalTotal). "%"; ?></td>
                          </tr>
                          <tr>
                            <td>Personal Rechazado</td>
                            <td><?php echo $personalRechazado; ?></td>
                            <td><?php echo round(($personalRechazado*100)/$personalTotal). "%"; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <div class="admin-content-con clearfix">
                    <header class="clearfix">
                      <h5 class="pull-left text-uppercase"><b>RESUMEN DE LA EMPRESA</b></h5>
                    </header>
                    <div class="panel panel-default">                 
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Información</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Nombre</td>
                            <td><?php echo $n_fantasia; ?></td>
                          </tr>
                          <tr>
                            <td>Rut</td>
                            <td><?php echo $rut; ?></td>
                          </tr>
                          <tr>
                            <td>Contacto</td>
                            <td><?php echo $n_contacto; ?></td>
                          </tr>
                          <tr>
                            <td>Fono</td>
                            <td><?php echo $fono; ?></td>
                          </tr>
                          <tr>
                            <td>E-mail</td>
                            <td><?php echo $mail_contacto; ?></td>
                          </tr>
                          <tr>
                            <td>Responsable</td>
                            <td><?php echo $responsable; ?></td>
                          </tr>
                          <tr>
                            <td>E-mail Responsable</td>
                            <td><?php echo $emailresponsable; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>             
              </div>
            </div>
            <div class="row">
              <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">        
                <div class="admin-content-con clearfix">
                  <header class="clearfix">
                  <h5 class="pull-left text-uppercase"><b>ACREDITACIONES MENSUALES <?php echo date("Y"); ?></b></h5>
                  </header>
                  <div id="canvas-container">
                    <canvas id="chart" width="500" height="350"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">        
                <div class="admin-content-con clearfix">
                  <header class="clearfix">
                  <h5 class="pull-left text-uppercase"><b>PORCENTAJE AVANCE al <?php echo date("d"). " de " . strftime("%B") . " del " . date("Y"); ?></b></h5>
                  </header>
                  <div id="canvas-container">
                    <canvas id="chartTorta" width="500" height="350"></canvas>
                  </div>
                </div>
              </div>
            </div>            
            <div class="row">
              <div class="col-md-12">
                <div class="admin-content-con clearfix">
                    <header>
                      <h5>Instructivo Inicial Plataforma Acreditación</h5>
                    </header>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre Documento</th>
                          <th>Fecha Modificación</th>
                          <th>Botón Descarga</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Pasos ingreso personal</td>
                          <td>05-01-2017</td>
                          <td><a class="btn btn-warning" target="_blank" href="http://www.chilecop.cl/acreditacion/documentos/instructivoInterfaz.pdf" role="button">Ver</a></td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="admin-content-con clearfix">
                    <header>
                      <h5>Documentación Relevante</h5>
                    </header>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre Documento</th>
                          <th>Fecha Modificación</th>
                          <th>Botón Descarga</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Instructivo Acreditación</td>
                          <td>05-12-2016</td>
                          <td><a class="btn btn-primary" href="http://www.chilecop.cl/acreditacion/documentos/instructivoAcreditacion.pdf" download="instructivoAcreditacion.pdf" role="button">Descargar</a></td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Información Auditoría de Remuneraciones</td>
                          <td>05-12-2016</td>
                          <td><a class="btn btn-primary" href="http://www.chilecop.cl/acreditacion/documentos/informacionAuditoria.pdf" download="informacionAuditoria.pdf" role="button">Descargar</a></td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Nómina Auditoría de Remuneraciones</td>
                          <td>05-12-2016</td>
                          <td><a class="btn btn-primary" href="http://www.chilecop.cl/acreditacion/documentos/nominaAuditoriaRemuneraciones.xls" download="nominaAuditoriaRemuneraciones.xls" role="button">Descargar</a></td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Nómina Acreditación</td>
                          <td>05-12-2016</td>
                          <td><a class="btn btn-primary" href="http://www.chilecop.cl/acreditacion/documentos/nominaAcreditacion.xls" download="nominaAcreditacion.xls" role="button">Descargar</a></td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Ficha inscripción Empresas Contratistas</td>
                          <td>30-12-2016</td>
                          <td><a class="btn btn-primary" href="http://www.chilecop.cl/acreditacion/documentos/fichaInscripcionEmpresasContratistas.xls" download="fichaInscripcionEmpresasContratistas.xls" role="button">Descargar</a></td>
                        </tr>
                      </tbody>
                    </table>
                    <!-- 
                    DEBERIAN SER ASI:
                    <a class="label label-success fancy" href="contacto.php?id=3">Enviar E-mail</a> -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="admin-content-con clearfix">
                    <header>
                      <h5>Administración Chilecop</h5>
                    </header>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Fono</th>
                          <th>Cargo</th>
                          <th>Accion</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Stefany Kunz</td>
                          <td>s.kunz@chilecop.cl</td>
                          <td>+56 9 44337239</td>
                          <td>Administrador Acreditación</td>
                          <td><a class="btn btn-default" href="mailto:s.kunz@chilecop.cl" role="button">Enviar E-mail</a></td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Dpto. Acreditación</td>
                          <td>acreditacion@chilecop.cl</td>
                          <td></td>
                          <td>Subgerencia de Desarrollo</td>
                          <td><a class="btn btn-default" href="mailto:acreditacion@chilecop.cl" role="button">Enviar E-mail</a></td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Dpto. Informática</td>
                          <td>informatica@chilecop.cl</td>
                          <td>+56 9 73885258</td>
                          <td>Subgerencia de Desarrollo</td>
                          <td><a class="btn btn-default" href="mailto:informatica@chilecop.cl" role="button">Enviar E-mail</a></td>
                        </tr>
                      </tbody>
                    </table>
                    <!-- 
                    DEBERIAN SER ASI:
                    <a class="label label-success fancy" href="contacto.php?id=3">Enviar E-mail</a> -->
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
    <script src="js/default.js"></script>
  </body>
</html>
<?php
}else{
  header("location: http://www.chilecop.cl/accesoAcreditacion.html");
}
?>