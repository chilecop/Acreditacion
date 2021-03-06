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
    if(isset($_GET['id'])){
      $id = $_GET['id'];
    }
    tituloPanel();
	  $contenido = getEditPersona($id);
    list(
      $sexo,
      $tipopase,
      $contrato,
      $tipoJornada,
      $sangre,
      $rut,
      $nombres,
      $apellidos,
      $cargo,
      $f_nacimiento,
      $nacionalidad,
      $visa,
      $facreditacion,
      $procedencia,
      $alergias,
      $comuna,
      $fono_emergencia,
      $direccion,
      $fregistro,
      $sector,
      $fechainicio,
      $fechatermino,
      $iniciopase,
      $terminopase,
      $fvencvisa,
      $regionid,
      $idtipocontrato) = explode("%$", $contenido);
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
      $(document).ready(function(){
        $("select[name=id_tipo_contrato]").change(function(){
          if($('select[name=id_tipo_contrato]').val()==1){
            document.getElementById("terminoContrato").style.display='none';
            document.getElementById("terminoPase").style.display='none';

          } else {
            document.getElementById("terminoContrato").style.display='block';
            document.getElementById("terminoPase").style.display='block';
          }
        });
      });

      $(document).ready(function(){
        if($("#id_tipo_contrato option:selected").val()!=1){
          document.getElementById("terminoContrato").style.display='block';
          document.getElementById("terminoPase").style.display='block';
        }
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
                        <label class="sr-only">Rut</label>
                        <?php echo inputrut("rut",$rut);?>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Nombre</label>
                        <input type="text" class="form-control" id="title" placeholder="Nombre" name="nombre" value="<?php echo $nombres; ?>"required>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Apellidos</label>
                        <input type="text" class="form-control" id="title" placeholder="Apellidos" name="apellidos" value="<?php echo $apellidos; ?>" required>
                      </div>
                      <div class="form-group">
                        <label class="">Fecha Nacimiento</label>
                        <input type="date" class="form-control" id="title" name="fnac" value="<?php echo $f_nacimiento; ?>" required>
                      </div>
                      <div class="form-group">
                          <label class="">Sexo</label><br>
                          <input <?php if($sexo==1) echo "checked"; ?> type="radio" name="sexo" value="1" required> Masculino<br>
                          <input <?php if($sexo==2) echo "checked"; ?> type="radio" name="sexo" value="2" required> Femenino<br>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Nacionalidad</label>
                        <input type="text" class="form-control" id="title" placeholder="Nacionalidad" name="nacionalidad" value="<?php echo $nacionalidad; ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Tipo de Visa</label>
                        <?php getSelect('visa','id_visa','descripcion',$visa); ?>
                      </div>  
                      <div class="form-group">
                        <label class="">Fecha Vencimiento de Visa (si aplica)</label>
                        <input type="date" class="form-control" id="title" name="fvencvisa" value="<?php echo $fvencvisa; ?>">
                      </div>                                           
                    </div>
                    <div class="col-md-4 col-lg-4">   
                      <div class="form-group">
                        <label class="sr-only">Cargo</label>
                        <input type="text" class="form-control" id="title" placeholder="Cargo" name="cargo" value="<?php echo $cargo; ?>" required>
                      </div>                   
                      <div class="form-group">
                        <label class="sr-only">Dirección</label>
                        <input type="text" class="form-control" id="title" placeholder="Dirección" name="direccion" value="<?php echo $direccion; ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Region</label>
                        <?php getSelect('regiones','region_id','region_nombre',$regionid); ?>
                      </div>
                      <div class="form-group">
                        <label class="sr-only">Ciudad</label>
                        <input type="text" class="form-control" id="title" placeholder="Ciudad" name="procedencia" value="<?php echo $procedencia; ?>">
                      </div> 
                      <div class="form-group">
                        <label class="sr-only">Fono</label>
                        <input type="text" class="form-control" id="title" placeholder="Fono" name="fono" value="<?php echo $fono_emergencia; ?>" required>
                      </div> 
                      <div class="form-group">
                        <label>Tipo de Contrato</label>
                        <?php getSelect('tipo_contrato','id_tipo_contrato','descripcion',$idtipocontrato); ?>
                      </div>    
                      <div class="form-group">
                        <label class="">Inicio Contrato</label>
                        <input class="pull-right" type="date" name="fechainicio" value="<?php echo $fechainicio ?>" placeholder="Fecha Inicio Contrato" required/>
                      </div>
                      <div id="terminoContrato" class="form-group" style="display:none;">
                        <label class="">Término Contrato</label>
                        <input class="pull-right" type="date" name="fechatermino" value="<?php echo $fechatermino; ?>"/>
                      </div>
                      <!--
                      <div class="form-group">
                        <label class="">Inicio de Pase</label>
                        <input class="pull-right" type="date" name="iniciopase" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Inicio Pase" required/>
                      </div>
                      <div id="terminoPase" style="display:none;" class="form-group">
                        <label class="">Término de Pase</label>
                        <input class="pull-right" type="date" name="terminopase"/>
                      </div> 
                      -->
                    </div>
                    <div class="col-md-4 col-lg-4">                         
                      <div class="form-group">
                        <label>Tipo de Pase</label>
                        <?php getSelect('tipo_pase','id_tipo_pase','descripcion',$tipopase); ?>
                      </div>  
                      <div class="form-group">
                        <label>Sector Asignado</label>
                        <?php getSelect('sectores','id_sector','descripcion',$sector); ?>
                      </div>  

                      <?php 
                      if($_SESSION['nombreUsuario']=="Admin"){
                      ?>
                        <div class="form-group">
                          <label>Jornada de Trabajo</label>
                          <?php getSelect('jornada','ID_REGISTRO','TIPO_JORNADA',$tipoJornada); ?>
                        </div>      
                      <?php
                        }
                      ?>
                                 
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
    <script> 
      function limpiarut_(objeto){
       objeto.value=objeto.value.replace("-.","K");
       objeto.value=objeto.value.replace("k","K");
       vDigitosAceptados = '0123456789K*';
       if (objeto.value.substr(0,1) == "0")
        { objeto.value = objeto.value.substr(1,objeto.value.length);
        }
        var texto = objeto.value;
        var salida='';
        for (var x=0; x < texto.length; x++){
         pos = vDigitosAceptados.indexOf(texto.substr(x,1));
         if (pos != -1) salida += texto.substr(x,1);
       }
       if (objeto.value != salida) objeto.value = salida;

       if (objeto.value.slice(0, 1) == "9" || objeto.value.slice(0, 1) == "8" || objeto.value.slice(0, 1) == "7" || objeto.value.slice(0, 1) == "6" || objeto.value.slice(0, 1) == "5" || objeto.value.slice(0, 1) == "4" || objeto.value.slice(0, 1) == "3")
       {
         objeto.value = objeto.value.substr(0, 8);
       }

     }
   </script>
  </body>
</html>
<?php
}else{
  header("location: http://www.chilecop.cl/caccesodemo/index.html");
}
  function inputrut($name,$value='',$size=20,$leng=9,$otro=""){
    global $con;            
    $input="<input name='".$name."' id='".$name."'  type=\"text\" placeholder=\"Rut\" value='".$value."' size=".$size." class=\"form-control\"  maxlength=".$leng." onkeydown=\"javascript:limpiarut_(this)\" onkeyup=\"javascript:limpiarut_(this)\" ".$otro." required disabled>";          
    return $input;  
  }
?>