<?php
session_start();
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
      $_SESSION['idTrabajadorActual'] = $id;
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
      $disabled = "disabled";
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
    <link rel="stylesheet" type="text/css" href="css/acreditar.css">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <script src="js/jquery-1.10.1.min.js"></script>
      <script src="js/funcionesAcreditacion.js"></script>
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
                <div class="col-xs-6 col-sm-6 col-md-6"><b>PROCESO ACREDITACIÓN - <?php echo $nfantasia; ?></b></div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <a style="margin-left:1em; margin-bottom:0.5em;" class='btn btn-xs btn-warning pull-right' href='editarPersonal.php?id=<?php echo $id; ?>' role='button'>Editar</a>  
                  <a style="margin-left:1em; margin-bottom:0.5em;" class='btn btn-xs btn-default pull-right' href='documentacionPersonal.php?id=<?php echo $id; ?>' role='button'>Ver Documentación</a>
                  <!-- <a class="btn btn-xs btn-success pull-right" href='php/generarCredencial.php?id=<?php echo $id; ?>' role="button">Generar Credencial</a> -->
                </div>
              </header>
              <div class="content-inner">
                <div class="row">
                  <!-- BANDERA DE ESTADO DEL TRABAJADOR -->
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="well well-sm comments-well">                              
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
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            INFORMACIÓN PERSONAL
                          </div>                    
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Información</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Rut</td>
                                <td><?php echo $rut; ?></td>
                              </tr>
                              <tr>
                                <td>Nombre</td>
                                <td><?php echo $nombres . " " . $apellidos; ?></td>
                              </tr>
                              <tr>
                                <td>Sexo</td>
                                <td><?php echo $sexo; ?></td>
                              </tr>
                              <tr>
                                <td>Cargo</td>
                                <td><?php echo $cargo; ?></td>
                              </tr>
                              <tr>
                                <td>Fecha de Nacimiento</td>
                                <td><?php echo $f_nacimiento; ?></td>
                              </tr>
                              <tr>
                                <td>Nacionalidad</td>
                                <td><?php echo $nacionalidad; ?></td>
                              </tr>
                              <tr>
                                <td>Región</td>
                                <td><?php echo $region; ?></td>
                              </tr>
                              <tr>
                                <td>Procedencia</td>
                                <td><?php echo $procedencia; ?></td>
                              </tr>
                              <tr>
                                <td>Dirección</td>
                                <td><?php echo $direccion; ?></td>
                              </tr>
                              <tr>
                                <td>Fono</td>
                                <td><?php echo $fono_emergencia; ?></td>
                              </tr>
                              <tr>
                                <td>Tipo de Visa</td>
                                <td><?php echo $tipovisa; ?></td>
                              </tr>
                              <tr>
                                <td>Vencimiento de Visa</td>
                                <td><?php echo $fvencvisa; ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>  
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          INFORMACIÓN LABORAL
                        </div>                    
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Información</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <div class="imagen-persona">
                                <img class="imagen-articulo" src="<?php verFotoPersona($id); ?>" />
                              </div>
                            </tr>
                            <tr>
                              <td>Empresa</td>
                              <td><?php echo $nfantasia; ?></td>
                            </tr>
                            <tr>
                              <td>Tipo de Contrato</td>
                              <td><?php echo $tcontrato; ?></td>
                            </tr>
                            <tr>
                              <td>Número de Contrato</td>
                              <td><?php echo $ncontrato; ?></td>
                            </tr>
                            <tr>
                              <td>Inicio de Contrato</td>
                              <td><?php echo $fechainiciocontrato; ?></td>
                            </tr>
                            <tr>
                              <td>Término de Contrato</td>
                              <td><?php echo $fechaterminocontrato; ?></td>
                            </tr>
                            <tr>
                              <td>Tipo de Pase</td>
                              <td><?php echo $tipopase; ?></td>
                            </tr>
                            <tr>
                              <td>Sector de Trabajo</td>
                              <td><?php echo $sector; ?></td>
                            </tr>
                            <tr>
                              <td>Jornada de Trabajo</td>
                              <td><?php echo $jornada; ?></td>
                            </tr>
                            <tr>
                              <td>Inducción</td>
                              <td><?php echo $induccion; ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>                    
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        DOCUMENTACIÓN ASOCIADA
                      </div>   
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Documento</th>
                            <th>Url</th>
                            <th>Fecha de vencimiento</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if($idtipopase==1 || $idtipopase==4 || $idtipopase==6)
                            imprimirDocumentoVer("Contrato de Trabajo","URL_1","Persona",$rut,$id,"no","VAL_1");
                          if($idtipopase==1 )
                            imprimirDocumentoVer("Inducción","URL_2","Persona",$rut,$id,"si","VAL_2");
                          imprimirDocumentoVer("Fotografía Tamaño Carnet","URL_3","Persona",$rut,$id,"no","VAL_3");
                          imprimirDocumentoVer("Consentimiento test alcohol y drogas","URL_4","Persona",$rut,$id,"no","VAL_4");
                          if($idtipopase == 1 || $idtipopase == 4 || $idtipopase == 6)
                            imprimirDocumentoVer("Fotocopia Cédula","URL_5","Persona",$rut,$id,"si","VAL_5");
                          imprimirDocumentoVer("Examen Pre-Ocupacional","URL_6","Persona",$rut,$id,"si","VAL_6");
                          if($idtipopase == 1 || $idtipopase == 4)
                            imprimirDocumentoVer("ODI","URL_7","Persona",$rut,$id,"no","VAL_7");
                          if($idtipopase == 1)
                            imprimirDocumentoVer("Reglamento Interno","URL_8","Persona",$rut,$id,"no","VAL_8");
                          if($idtipopase == 1 || $idtipopase == 4 || $idtipopase == 6)
                            imprimirDocumentoVer("Entrega EPP","URL_9","Persona",$rut,$id,"no","VAL_9");
                          if($idtipopase == 1)
                            imprimirDocumentoVer("Último Finiquito","URL_10","Persona",$rut,$id,"no","VAL_10");
                          if($idtipopase == 1)
                            imprimirDocumentoVer("Certificado Antecedentes","URL_11","Persona",$rut,$id,"no","VAL_11");
                          if($idtipopase == 1)
                            imprimirDocumentoVer("Certificado de Estudios","URL_12","Persona",$rut,$id,"no","VAL_12");
                          if($idtipopase == 1)
                            imprimirDocumentoVer("Acreditación Prevencionista","URL_13","Persona",$rut,$id,"no","VAL_13");
                          if($idtipopase == 1)
                            imprimirDocumentoVer("Certificado Especial","URL_14","Persona",$rut,$id,"si","VAL_14");
                          imprimirDocumentoVer("Anexo 1","URL_15","Persona",$rut,$id,"no","VAL_15");
                          imprimirDocumentoVer("Anexo 2","URL_16","Persona",$rut,$id,"no","VAL_16");
                          imprimirDocumentoVer("Anexo 3","URL_17","Persona",$rut,$id,"no","VAL_17");
                          imprimirDocumentoVer("Otros","URL_18","Persona",$rut,$id,"no","VAL_18");
                          if($idtipopase == 3 || $idtipopase == 5)
                            imprimirDocumentoVer("Guía de despacho o factura del material","URL_19","Persona",$rut,$id,"no","VAL_19");
                          if($idtipopase == 3 || $idtipopase == 5)
                            imprimirDocumentoVer("Documentación legal del Vehículo","URL_20","Persona",$rut,$id,"si","VAL_20");
                          if($idtipopase == 3 || $idtipopase == 5)
                            imprimirDocumentoVer("Check list del vehículo","URL_21","Persona",$rut,$id,"si","VAL_21");
                          if($idtipopase == 3 || $idtipopase == 5)
                            imprimirDocumentoVer("Licencia municipal de conducir vigente","URL_22","Persona",$rut,$id,"si","VAL_22");
                          if($idtipopase == 6)
                            imprimirDocumentoVer("Visa de trabajo","URL_23","Persona",$rut,$id,"si","VAL_23");
                          ?>
                        </tbody>
                      </table>
                    </div>               
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        OBSERVACIONES
                      </div>
                      <?php 
                      getObservacionesAcreditacion($id,"Persona");  
                      ?>
                    </div>
                  </div>                  
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                    
                    <div class="col-sm-12 col-md-12">
                        <div class="row">
                          <div class="col-xs-8 col-sm-8 col-md-8">
                            <b>Observación</b><br>
                            <small></small>
                          </div>
                        </div>
                        <div class="well well-sm comments-well">
                                <textarea rows="5" class="observacion" id="observacion" name="observacion" placeholder="Ingrese una observación"></textarea>
                            </div>
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12">
                            <b>Documentos Relacionados</b><br>
                            <small></small>
                          </div>
                        </div>
                        <div class="well well-sm comments-well">
                          Seleccione los documentos relacionados a la observación...
                          <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                              <div class="checkbox">
                                <label for="1">
                                  <input id="1" type="checkbox" class="docsCheck" value="1">Contrato de trabajo</label>
                              </div>
                              <div class="checkbox">
                                <label for="2">
                                  <input id="2" type="checkbox" class="docsCheck" value="2">Inducción JoyGlobal</label>
                              </div>
                              <div class="checkbox">
                                <label for="3">
                                  <input id="3" type="checkbox" class="docsCheck" value="3">Fotografía tamaño carnet</label>
                              </div>
                              <div class="checkbox">
                                <label for="4">
                                  <input id="4" type="checkbox" class="docsCheck" value="4">Consentimiento test alcohol y drogas</label>
                              </div>
                              <div class="checkbox">
                                <label for="5">
                                  <input id="5" type="checkbox" class="docsCheck" value="5">Fotocopia Cédula</label>
                              </div>
                              <div class="checkbox">
                                <label for="6">
                                  <input id="6" type="checkbox" class="docsCheck" value="6">Examen pre-ocupacional</label>
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                              <div class="checkbox">
                                <label for="7">
                                  <input id="7" type="checkbox" class="docsCheck" value="7">ODI</label>
                              </div>
                              <div class="checkbox">
                                <label for="8">
                                  <input id="8" type="checkbox" class="docsCheck" value="8">Reglamento Interno</label>
                              </div>
                              <div class="checkbox">
                                <label for="9">
                                  <input id="9" type="checkbox" class="docsCheck" value="9">Entrega EPP</label>
                              </div>
                              <div class="checkbox">
                                <label for="10">
                                  <input id="10" type="checkbox" class="docsCheck" value="10">Último Finiquito</label>
                              </div>
                              <div class="checkbox">
                                <label for="11">
                                  <input id="11" type="checkbox" class="docsCheck" value="11">Certificado Antecedentes</label>
                              </div>
                              <div class="checkbox">
                                <label for="12">
                                  <input id="12" type="checkbox" class="docsCheck" value="12">Certificado Estudios</label>
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                              <div class="checkbox">
                                <label for="13">
                                  <input id="13" type="checkbox" class="docsCheck" value="13">Acreditación Prevencionista</label>
                              </div>
                              <div class="checkbox">
                                <label for="14">
                                  <input id="14" type="checkbox" class="docsCheck" value="14">Certificado de Aprobación</label>
                              </div>
                              <div class="checkbox">
                                <label for="15">
                                  <input id="15" type="checkbox" class="docsCheck" value="15">Anexo 1</label>
                              </div>
                              <div class="checkbox">
                                <label for="16">
                                  <input id="16" type="checkbox" class="docsCheck" value="16">Anexo 2</label>
                              </div>
                              <div class="checkbox">
                                <label for="17">
                                  <input id="17" type="checkbox" class="docsCheck" value="17">
                                  Anexo 3
                                </label>
                              </div>
                              <div class="checkbox">
                                <label for="18">
                                  <input id="18" type="checkbox" class="docsCheck" value="18">
                                  Otros
                                </label>
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                              <div class="checkbox">
                                <label for="19">
                                  <input id="19" type="checkbox" class="docsCheck" value="19">
                                  Otros
                                </label>
                              </div>  
                              <div class="checkbox">
                                <label for="20">
                                  <input id="20" type="checkbox" class="docsCheck" value="20">
                                  Guía de despacho o factura del material
                                </label>
                              </div>  
                              <div class="checkbox">
                                <label for="21">
                                  <input id="21" type="checkbox" class="docsCheck" value="21">
                                  Documentación legal del Vehículo
                                </label>
                              </div>  
                              <div class="checkbox">
                                <label for="22">
                                  <input id="22" type="checkbox" class="docsCheck" value="22">
                                  Licencia municipal de conducir vigente
                                </label>
                              </div>  
                              <div class="checkbox">
                                <label for="23">
                                  <input id="23" type="checkbox" class="docsCheck" value="23">
                                  Visa de trabajo
                                </label>
                              </div>                            
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button id="agregarObservacion" type="submit" class="btn btn-default pull-right">Añadir Observación</button>
                          </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <button id="acreditar" type="submit" class="btn btn-success pull-right <?php echo $disabled; ?>">ACREDITAR TRABAJADOR</button>
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