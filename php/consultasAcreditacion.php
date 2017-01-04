<?php
  //error_reporting(E_ALL);
  //ini_set('display_errors', '1');

  include('conexion.php');
  include("Zebra_Pagination.php");
	function imprimirMenu(){
    //ACÁ DESPUÉS HAY QUE DISCRIMINAR POR EL TIPO DE USUARIO
    $usuario = $_SESSION['nombreUsuario'];
    if($usuario=="Admin"){
      echo '
      <div class="col-md-2 col-sm-1 hidden-xs display-table-cell valign-top" id="side-menu">
          <h1 class="hidden-xs hidden-sm logo"><img src="images/logo.png"></h1>
          <ul>
            <li class="link">
              <a href="escritorio.php">
                  <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Escritorio</span>
              </a>
            </li>
            <li class="link">
              <a href="listarMandantes.php">
                  <span class="glyphicon glyphicon-queen" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Mandantes</span>
              </a>
            </li>
            <li class="link">
              <a href="listarContratistas.php">
                  <span class="glyphicon glyphicon-pawn" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Contratistas</span>
              </a>
            </li>
            <li class="link">
              <a href="vehiculos.php">
                  <span class="glyphicon glyphicon-road" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Acceso Vehicular</span>
              </a>
            </li>

            <li class="link">
              <a href="#personal" data-toggle="collapse" aria-controls="collapse-post">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Personal Acreditado</span>
              </a>
              <ul class="collapse collapseable" id="personal">
                <li><a href="buscador.php">Buscador</a></li>
                <li><a href="ingresarTrabajador2.php">Ingresar Trabajador</a></li>
                <li><a href="reportePersonal.php">Reporte Personal</a></li>
              </ul>
            </li>
			
			      <li class="link">
              <a href="pasesDiarios.php">
                <span class="glyphicon glyphicon glyphicon-tags" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Pases Diarios</span>
              </a>
            </li>

            <li class="link">
              <a href="#">
                  <span class="glyphicon glyphicon-object-align-bottom" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Reportes</span>
              </a>
            </li>
            <li class="link">
              <a href="anuncio.php">
                  <span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Anuncios</span>
              </a>
            </li>
            <h1 class="hidden-xs hidden-sm logo"><img src="images/joyglobal.png"></h1>
          </ul>
      </div>';
    }

    if($usuario=="Contratista"){
      echo '
        <div class="col-md-2 col-sm-1 hidden-xs display-table-cell valign-top" id="side-menu">
          <h1 class="hidden-xs hidden-sm logo"><img src="images/logo.png"></h1>
          <ul>
            <li class="link">
              <a href="escritorio.php">
                  <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Escritorio</span>
              </a>
            </li>
            <li class="link">
              <a href="verContratista.php">
                  <span class="glyphicon glyphicon-pawn" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Mi empresa</span>
              </a>
            </li>
            <li class="link">
              <a href="listarContratos.php">
                  <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Mis Contratos</span>
              </a>
            </li>

            <li class="link">
              <a href="#personal" data-toggle="collapse" aria-controls="collapse-post">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Personal Acreditado</span>
              </a>
              <ul class="collapse collapseable" id="personal">
                <li><a href="buscador.php">Buscador</a></li>
                <li><a href="ingresarTrabajador2.php">Ingresar Trabajador</a></li>
              </ul>
            </li>
			
			<li class="link">
              <a href="pasesDiarios.php">
                <span class="glyphicon glyphicon glyphicon-tags" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Pases Diarios</span>
              </a>
            </li>
            
            <li class="link">
              <a href="#">
                  <span class="glyphicon glyphicon-object-align-bottom" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Reportes</span>
              </a>
            </li>
            <h1 class="hidden-xs hidden-sm logo"><img src="images/joyglobal.png"></h1>
          </ul>
      </div>
      ';

		/*echo '
		<div class="col-md-2 col-sm-1 hidden-xs display-table-cell valign-top" id="side-menu">
          <h1 class="hidden-xs hidden-sm logo"><img src="images/logo.png"></h1>
          <ul>
            <li class="link">
              <a href="#contratista" data-toggle="collapse" aria-controls="collapse-post">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Vista '. $usuario .'</span>
              </a>
              <ul class="collapse collapseable" id="contratista">
                <li><a href="ingresarContratista.php">Ingresar Contratista</a></li>
                <li><a href="ingresarTrabajador.php">Acreditar Personal</a></li>
                <li><a href="listarContratos.php">Listar Contratos</a></li>
              </ul>
            </li>

            <li class="link">
              <a href="#mandante" data-toggle="collapse" aria-controls="collapse-post">
                <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Vista Mandante</span>
              </a>
              <ul class="collapse collapseable" id="mandante">
                <li><a href="listarContratistas.php">Listar Contratistas</a></li>
              </ul>
            </li>

            <li class="link">
              <a href="#administrador" data-toggle="collapse" aria-controls="collapse-post">
                <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Vista Administrador</span>
              </a>
              <ul class="collapse collapseable" id="administrador">
              <li><a href="listarMandantes.php">Listar Mandantes</a></li>
                <li><a href="ingresarMandante.php">Ingresar Mandante</a></li>                
                <li><a href="listarContratistas.php">Listar Contratistas</a></li>
                <li><a href="#">Listar Usarios</a></li>
                <li><a href="crearUsuario.php">Crear Usuario</a></li>
              </ul>
            </li>

            <h1 class="hidden-xs hidden-sm logo"><img src="images/logo.png"></h1>
          </ul>
        </div>';*/
    }
    if($usuario=="Mandante"){

      echo '
        <div class="col-md-2 col-sm-1 hidden-xs display-table-cell valign-top" id="side-menu">
          <h1 class="hidden-xs hidden-sm logo"><img src="images/logo.png"></h1>
          <ul>
            <li class="link">
              <a href="escritorio.php">
                  <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Escritorio</span>
              </a>
            </li>
            <li class="link">
              <a href="ingresarMandante.php">
                  <span class="glyphicon glyphicon-queen" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Mi empresa</span>
              </a>
            </li>
            <li class="link">
              <a href="listarContratistas.php">
                  <span class="glyphicon glyphicon-pawn" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Contratistas</span>
              </a>
            </li>
            <li class="link">
              <a href="#personal" data-toggle="collapse" aria-controls="collapse-post">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Personal Acreditado</span>
              </a>
              <ul class="collapse collapseable" id="personal">
                <li><a href="buscador.php">Buscador</a></li>
                <li><a href="ingresarTrabajador2.php">Ingresar Trabajador</a></li>
                <li><a href="reportePersonal.php">Reporte Personal</a></li>
              </ul>
            </li>
            <li class="link">
              <a href="#">
                  <span class="glyphicon glyphicon-object-align-bottom" aria-hidden="true"></span>
                  <span class="hidden-sm hidden-xs">Reportes</span>
              </a>
            </li>
            <h1 class="hidden-xs hidden-sm logo"><img src="images/joyglobal.png"></h1>
          </ul>
      </div>';
    }
	}  

  function copyright(){
    echo '<b>Copyright</b> &copy; 2016 <b>CHILECOP HOLDING GROUP</b>';
  }

  function nombrePanel(){
    echo 'Admin Panel 1.0';
  }

  function tituloPanel(){
    echo '<title>Panel de Control - Chilecop</title>';
  }

  function getSelect($tabla,$dato1,$dato2,$seleccion){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $sql="SELECT " . $dato1 . ", " . $dato2 . " FROM " . $tabla;
    echo "<select id='". $dato1 ."' name='$dato1' class='form-control' id='$dato1' required>";
    $resultado = mysql_query($sql,$con);
    $selected = "";
    while($row = mysql_fetch_array($resultado)){
      if($seleccion==$row[$dato1]){
        $selected = "selected";
      }
      echo "<option value='" . $row[$dato1] . "' " . $selected . ">" . $row[$dato2] . "</option>"; 
      $selected = "";
    }
    echo "</select>";
    mysql_close($con);
  }

  function listarMandantes(){
    $usuario = $_SESSION['nombreUsuario'];
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $sql="SELECT * FROM mandante";
    $resultado = mysql_query($sql,$con);
    while($row = mysql_fetch_array($resultado)){
      echo "
          <tr>
              <td>".$row['ID_MANDANTE'] . "</td>
              <td>".$row['N_FANTASIA'] . "</td>
              <td>".$row['RUT'] . "</td>
              <td>".$row['N_CONTACTO'] . "</td>
              <td>".$row['FONO'] . "</td>
              <td>".$row['REPRESENTANTE'] . "</td>
              <td>".$row['MAIL'] . "</td>
              <td>".$row['F_REGISTRO'] . "</td>
              <td><a class='btn btn-xs btn-success' href='crearUsuario.php' role='button'>Crear Usuario</a></td>";
              if($usuario=="Admin"){
                echo "<td><a class='btn btn-xs btn-default' href='#' role='button'>Observaciones</a></td>";
              }
              echo "<td><a class='btn btn-xs btn-warning' href='editarMandante.php?id=".$row['ID_MANDANTE']."&nombre=". $row['N_FANTASIA'] ."' role='button'>editar</a></td>
          </tr>    
          ";
    }
    mysql_close($con);
  }

  function listarContratos($id){
    $usuario = $_SESSION['nombreUsuario'];
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $sql="SELECT * FROM orden_contrato WHERE ID_CONTRATISTA='$id'";
    $resultado = mysql_query($sql,$con);
    while($row = mysql_fetch_array($resultado)){
      echo "
          <tr>
              <td>".$row['ID_OC'] . "</td>
              <td>".$row['N_CONTRATO'] . "</td>
              <td>".$row['DESCRIPCION_CONTRATO'] . "</td>
              <td>".$row['ADMINISTRADOR_CONTRATO'] . "</td>
              <td>".$row['FONO'] . "</td>
              <td>".$row['MAIL'] . "</td>
              <td><a class='btn btn-xs btn-success' href='verContrato.php?id=". $row['ID_OC'] ."' role='button'>Ver</a></td>
              <td><a class='btn btn-xs btn-default' href='documentacionContrato.php?id=".$row['ID_OC']."' role='button'>Ver Documentos</a></td>
              <td><a class='btn btn-xs btn-default' href='listarPersonal.php?id=".$row['ID_OC']."' role='button'>gestionar personal</a></td>";
              if($usuario=="Admin"){
                echo "<td><a class='btn btn-xs btn-default' href='#' role='button'>Observaciones</a></td>";
                echo "<td><a class='btn btn-xs btn-warning' href='editarOrdenContrato.php?id=".$row['ID_OC']."' role='button'>Editar</a></td>";
              }
          echo "</tr>";
    }
    mysql_close($con);
  }
  function listarUsuarios($id){
    $usuario = $_SESSION['nombreUsuario'];
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $sql="SELECT * FROM usuario WHERE ID_CONTRATISTA='$id'";
    $resultado = mysql_query($sql,$con);
    while($row = mysql_fetch_array($resultado)){
      echo "
          <tr>
              <td>".$row['ID_USUARIO_SISTEMA'] . "</td>
              <td>".$row['NOMBRE_USUARIO'] . "</td>
              <td>".$row['RUT'] . "</td>
              <td>".$row['CLAVE'] . "</td>
              <td>".$row['MAIL'] . "</td>";
              if($usuario=="Admin"){
                echo "<td><a class='btn btn-xs btn-default' href='#' role='button'>Observaciones</a></td>";
                echo "<td><a class='btn btn-xs btn-warning' href='editarOrdenContrato.php?id=".$row['ID_OC']."' role='button'>Editar</a></td>";
              }
          echo "</tr>";
    }
    mysql_close($con);
  }

  function listarPersonal($id){
    $con = conectarse();
    $usuario = $_SESSION['nombreUsuario'];
    if($usuario=="Contratista"){
      $idEmpresa = $_SESSION["idContratista"];
      $sql="SELECT * 
      FROM personal_acreditado pa, orden_contrato oc 
      WHERE pa.ID_ORDEN_CONTRATO='$id' AND
      oc.ID_OC ='$id' AND
      oc.ID_CONTRATISTA='$idEmpresa'";
    }else{
      $sql="SELECT * FROM personal_acreditado WHERE ID_ORDEN_CONTRATO='$id'";
    }
    $resultado = mysql_query($sql,$con);
    $estado = 0;

    while($row = mysql_fetch_array($resultado)){      
      if($row['ID_ESTADO']==1) $estado = "ok";
      if($row['ID_ESTADO']==2) $estado = "rechazado";
      if($row['ID_ESTADO']==3) $estado = "pendiente";
      echo "
          <tr>
              <td>".$row['ID_ACREDITADO'] . "</td>
              <td><div class='estado ". $estado ."'></div></td>
              <td>".$row['RUT'] . "</td>
              <td>".$row['APELLIDOS'] . " " . $row['NOMBRES'] . "</td>
              <td>".$row['CARGO'] . "</td>
              <td>".$row['FONO_EMERGENCIA'] . "</td>
              <td>".$row['NACIONALIDAD'] . "</td>";
              echo "<td><a class='btn btn-xs btn-success' href='verPersona.php?id=".$row['ID_ACREDITADO'] . "' role='button'>Ver</a></td>";
              if($usuario=="Admin"){
                echo "<td><a class='btn btn-xs btn-default' href='#' role='button'>Observaciones</a></td>";
              }
              echo" <td><a class='btn btn-xs btn-default' href='documentacionPersonal.php?id=".$row['ID_ACREDITADO']."' role='button'>ver documentos</a></td>
              <td><a class='btn btn-xs btn-warning' href='editarPersonal.php?id=".$row['ID_ACREDITADO']."' role='button'>editar</a></td>
          </tr>    
          ";
    }
    mysql_close($con);
  }

 function listarContratistas(){
    $usuario = $_SESSION['nombreUsuario'];
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $sql="SELECT * FROM empresa_contratista";
    $resultado = mysql_query($sql,$con);
    while($row = mysql_fetch_array($resultado)){
      echo "
          <tr>
              <td>".$row['ID_CONTRATISTA'] . "</td>
              <td>".$row['N_FANTASIA'] . "</td>
              <td>".$row['RUT'] . "</td>
              <td>".$row['N_CONTACTO'] . "</td>
              <td>".$row['FONO'] . "</td>
              <td>".$row['REP'] . "</td>";
              echo "<td><a class='btn btn-xs btn-success' href='verContratista.php?id=".$row['ID_CONTRATISTA'] . "' role='button'>Ver</a></td>";
              echo "<td><a class='btn btn-xs btn-default' href='listarContratos.php?id=".$row['ID_CONTRATISTA'] . "' role='button'>Contratos</a></td>";
			        echo" <td><a class='btn btn-xs btn-default' href='documentacionEmpresa.php?id=".$row['ID_CONTRATISTA']."' role='button'>Documentos Empresa</a></td>";
              if($usuario=="Admin"){			 
			        echo "
			          <td><a class='btn btn-xs btn-warning' href='listarUsuarios.php?id=".$row['ID_CONTRATISTA']."' role='button'>Ver Usuarios</a></td>
			          <td><a class='btn btn-xs btn-warning' href='editarContratista.php?id=".$row['ID_CONTRATISTA']."&nombre=". $row['N_FANTASIA'] ."' role='button'>Editar</a></td>";
              }
          echo "</tr>";
    }
    mysql_close($con);
  }

  function getVerPersona($id){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $query = "SELECT * FROM personal_acreditado WHERE ID_ACREDITADO='$id'";
    $resultado = mysql_query($query, $con);
    $fila = mysql_fetch_array($resultado);
    mysql_close($con);
    return $fila['ID_ESTADO'] . "%$" . $fila['RUT'] . "%$" . $fila['NOMBRES'] . "%$" . $fila['APELLIDOS'] . "%$" . $fila['CARGO'] . "%$" . $fila['F_NACIMIENTO'] . "%$" . $fila['PROCEDENCIA'] . "%$" . $fila['ALERGIAS'] . "%$" . $fila['FONO_EMERGENCIA'] . "%$" . $fila['DIRECCION'];
  }

  function getEditPersona($id){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $query = "SELECT * FROM personal_acreditado WHERE ID_ACREDITADO='$id'";
    $resultado = mysql_query($query, $con);
    $fila = mysql_fetch_array($resultado);
    mysql_close($con);
    return $fila['ID_SEXO'] . "%$" . $fila['ID_TIPO_PASE'] . "%$" . $fila['ID_ORDEN_CONTRATO'] . "%$" . $fila['ID_TIPO_TURNO'] . "%$" . $fila['ID_GRUPO_SANGUINEO'] . "%$" . $fila['RUT'] . "%$" . $fila['NOMBRES'] . "%$" . $fila['APELLIDOS'] . "%$" . $fila['CARGO'] . "%$" . $fila['F_NACIMIENTO'] . "%$" . $fila['NACIONALIDAD'] . "%$" . $fila['VISA'] . "%$" . $fila['F_ACREDITACION'] . "%$" . $fila['PROCEDENCIA'] . "%$" . $fila['ALERGIAS'] . "%$" . $fila['ID_COMUNA'] . "%$" . $fila['FONO_EMERGENCIA'] . "%$" . $fila['DIRECCION'] . "%$" . $fila['F_REGISTRO'];
  }

  function getVerEmpresaContratista($id){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $query = "SELECT * FROM empresa_contratista WHERE ID_CONTRATISTA='$id'";
    $resultado = mysql_query($query, $con);
    $fila = mysql_fetch_array($resultado);
    mysql_close($con);
    return $fila['N_FANTASIA'] . "%$" . $fila['N_CONTACTO'] . "%$" . $fila['RUT'] . "%$" . $fila['MAIL_CONTACTO'] . "%$" . $fila['FONO'] . "%$" . $fila['REP'] . "%$" . $fila['OBSERVACION'] . "%$" . $fila['F_REGISTRO'] . "%$" . $fila['D_CASA_MATRIZ'] . "%$" . $fila['D_SUCURSAL'] . "%$" . $fila['MUTUALIDAD'] . "%$" . $fila['RESPONSABLE'] . "%$" . $fila['MAIL_RESPONSABLE'];
  }

  function getVerMandante($id){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $query = "SELECT * FROM mandante WHERE ID_MANDANTE='$id'";
    $resultado = mysql_query($query, $con);
    $fila = mysql_fetch_array($resultado);
    mysql_close($con);
    return $fila['RUT'] . "%$" . $fila['N_FANTASIA'] . "%$" . $fila['N_CONTACTO'] . "%$" . $fila['OBSERVACION'] . "%$" . $fila['FONO'] . "%$" . $fila['F_REGISTRO'] . "%$" . $fila['REPRESENTANTE'] . "%$" . $fila['MAIL'];
  }

  function getVerContrato($id){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $query = "SELECT * FROM orden_contrato WHERE ID_OC='$id'";
    $resultado = mysql_query($query, $con);
    $fila = mysql_fetch_array($resultado);
    mysql_close($con);
    return $fila['F_INICIO'] . "%$" . $fila['F_TERMINO'] . "%$" . $fila['F_INICIO_JORNADA'] . "%$" . $fila['F_TERMINO_JORNADA'] . "%$" . $fila['F_PRESENTACION_SERNAGEOMIN'] . "%$" . $fila['F_AFILIACION_MUTUAL'] . "%$" . $fila['N_CONTRATO'] . "%$" . $fila['DESCRIPCION_CONTRATO'] . "%$" . $fila['ADMINISTRADOR_CONTRATO'] . "%$" . $fila['FONO'] . "%$" . $fila['MAIL'] . "%$" . $fila['JORNADA_EXCEPCIONAL'] . "%$" . $fila['TIPO_JORNADA'] . "%$" . $fila['N_RESOLUCION'];
  }

    function getVerDocumentacion($id){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $usuario = $_SESSION['nombreUsuario'];
    if($usuario=="Contratista"){
      $idEmpresa = $_SESSION["idContratista"];
      $query = "SELECT doc.* 
      FROM documentacion doc, personal_acreditado pa, orden_contrato oc
      WHERE doc.ID_ACREDITADO='$id' AND
      pa.ID_ACREDITADO='$id' AND
      oc.ID_OC =pa.ID_ORDEN_CONTRATO AND
      oc.ID_CONTRATISTA='$idEmpresa'";
    }else{
      $query = "SELECT * FROM documentacion WHERE ID_ACREDITADO='$id'";
    }    
    $resultado = mysql_query($query, $con);
    $fila = mysql_fetch_array($resultado);
    mysql_close($con);
    return 
    $fila['URL_1'] . "%$" . $fila['VAL_1'] . "%$" . $fila['OBS_1'] . "%$" . $fila['MOD_1'] . "%$" . 
    $fila['URL_2'] . "%$" . $fila['VAL_2'] . "%$" . $fila['OBS_2'] . "%$" . $fila['MOD_2'] . "%$" . 
    $fila['URL_3'] . "%$" . $fila['VAL_3'] . "%$" . $fila['OBS_3'] . "%$" . $fila['MOD_3'] . "%$" . 
    $fila['URL_4'] . "%$" . $fila['VAL_4'] . "%$" . $fila['OBS_4'] . "%$" . $fila['MOD_4'] . "%$" . 
    $fila['URL_5'] . "%$" . $fila['VAL_5'] . "%$" . $fila['OBS_5'] . "%$" . $fila['MOD_5'] . "%$" . 
    $fila['URL_6'] . "%$" . $fila['VAL_6'] . "%$" . $fila['OBS_6'] . "%$" . $fila['MOD_6'] . "%$" . 
    $fila['URL_7'] . "%$" . $fila['VAL_7'] . "%$" . $fila['OBS_7'] . "%$" . $fila['MOD_7'] . "%$" . 
    $fila['URL_8'] . "%$" . $fila['VAL_8'] . "%$" . $fila['OBS_8'] . "%$" . $fila['MOD_8'] . "%$" . 
    $fila['URL_9'] . "%$" . $fila['VAL_9'] . "%$" . $fila['OBS_9'] . "%$" . $fila['MOD_9'] . "%$" . 
    $fila['URL_10'] . "%$" . $fila['VAL_10'] . "%$" . $fila['OBS_10'] . "%$" . $fila['MOD_10'] . "%$" . 
    $fila['URL_11'] . "%$" . $fila['VAL_11'] . "%$" . $fila['OBS_11'] . "%$" . $fila['MOD_11'] . "%$" . 
    $fila['URL_12'] . "%$" . $fila['VAL_12'] . "%$" . $fila['OBS_12'] . "%$" . $fila['MOD_12'] . "%$" . 
    $fila['URL_13'] . "%$" . $fila['VAL_13'] . "%$" . $fila['OBS_13'] . "%$" . $fila['MOD_13'] . "%$" . 
    $fila['URL_14'] . "%$" . $fila['VAL_14'] . "%$" . $fila['OBS_14'] . "%$" . $fila['MOD_14'] . "%$" .
    $fila['URL_15'] . "%$" . $fila['VAL_15'] . "%$" . $fila['OBS_15'] . "%$" . $fila['MOD_15'] . "%$" .
    $fila['URL_16'] . "%$" . $fila['VAL_16'] . "%$" . $fila['OBS_16'] . "%$" . $fila['MOD_16'] . "%$" .
    $fila['URL_17'] . "%$" . $fila['VAL_17'] . "%$" . $fila['OBS_17'] . "%$" . $fila['MOD_17'] . "%$" .
    $fila['URL_18'] . "%$" . $fila['VAL_18'] . "%$" . $fila['OBS_18'] . "%$" . $fila['MOD_18'] . "%$" .
    $fila['URL_19'] . "%$" . $fila['VAL_19'] . "%$" . $fila['OBS_19'] . "%$" . $fila['MOD_19'] . "%$" .
    $fila['URL_20'] . "%$" . $fila['VAL_20'] . "%$" . $fila['OBS_20'] . "%$" . $fila['MOD_20'] . "%$" .
    $fila['URL_21'] . "%$" . $fila['VAL_21'] . "%$" . $fila['OBS_21'] . "%$" . $fila['MOD_21'] . "%$" .
    $fila['URL_22'] . "%$" . $fila['VAL_22'] . "%$" . $fila['OBS_22'] . "%$" . $fila['MOD_22'] . "%$" .
    $fila['URL_23'] . "%$" . $fila['VAL_23'] . "%$" . $fila['OBS_23'] . "%$" . $fila['MOD_23'];
  }
  
  	function getVerDocEECC($id){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $query = "SELECT * FROM documentacion_contratista WHERE ID_CONTRATISTA='$id'";
    $resultado = mysql_query($query, $con);
    $fila = mysql_fetch_array($resultado);
    mysql_close($con);
    return $fila['URL1'] . "%$" . $fila['VAL1'] . "%$" . $fila['MOD1'] . "%$" . $fila['URL2'] . "%$" . $fila['VAL2'] . "%$" . $fila['MOD2'] . "%$" . $fila['URL3'] . "%$" . $fila['VAL3'] .  "%$" . $fila['MOD3'] . "%$" . $fila['URL4'] . "%$" . $fila['VAL4'] . "%$" . $fila['MOD4'] . "%$" . $fila['URL5'] . "%$" . $fila['VAL5'] . "%$" . $fila['MOD5'] . "%$" . $fila['URL6'] . "%$" . $fila['VAL6'] . "%$" . $fila['MOD6'] . "%$" . $fila['URL7'] . "%$" . $fila['VAL7'] . "%$" . $fila['MOD7'] . "%$" . $fila['URL8'] . "%$" . $fila['VAL8'] . "%$" . $fila['MOD8'] . "%$" . $fila['URL9'] . "%$" . $fila['VAL9'] . "%$" . $fila['MOD9'] . "%$" . $fila['URL10'] . "%$" . $fila['VAL10'] . "%$" . $fila['MOD10'];
  }

  function getVehiculos(){
    $con = conectarse2();
    mysql_set_charset("utf8",$con);
    $sql="SELECT veh.*, pers.nombre_personal, tv.tipo AS tiponombre FROM vehiculo veh inner join tipovehiculo tv, personal pers WHERE veh.conductor = pers.rut_personal AND veh.tipo = tv.id";
    $resultado = mysql_query($sql,$con);
    while($row = mysql_fetch_array($resultado)){
      echo "
          <tr>
              <td>".$row['id'] . "</td>
              <td>".$row['patente'] . "</td>
              <td>".$row['conductor'] . " - " . $row['nombre_personal'] . "</td>
              <td>".$row['marca'] . "</td>
              <td>".$row['modelo'] . "</td>
              <td>".$row['color'] . "</td>
              <td>".$row['anio'] . "</td>
              <td>".$row['tiponombre'] . "</td>
              <td><a class='btn btn-xs btn-warning' href='editarVehiculo.php?id=".$row['id']."' role='button'>editar</a></td>
              <td><a class='btn btn-xs btn-danger' href='eliminarVehiculo.php?id=".$row['id']."' role='button'>eliminar</a></td>
          </tr>    
          ";
    }
    mysql_close($con);
  }

  function getTipoVehiculoSelect($tipo){
    $selected = "";
    $con = conectarse2();
    $sql="SELECT * FROM tipovehiculo";
    mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
    echo "<select name='tipo' class='form-control' required>";
    while($row = mysql_fetch_array($resultado)){
      if(isset($tipo) && $tipo == $row['id']){
        $selected = "selected";
      }
      echo "<option value='" . $row['id'] . "' " . $selected . " >" . $row['tipo'] . "</option>";
      $selected = "";
    }
    echo '</select>';
    mysql_close($con);
  }

  function getDatosVehiculo($id){
    $con = conectarse2();
    $sql = "SELECT * FROM vehiculo WHERE id='$id'";
    mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
    if($fila = mysql_fetch_array($resultado)){
      mysql_close($con);
      return $fila['patente'] . "%$" . $fila['conductor'] . "%$" . $fila['marca'] . "%$" . $fila['modelo'] . "%$" . $fila['color'] . "%$" . $fila['anio'] . "%$" . $fila['tipo'];
    }
  }

  function getSelectEmpresas(){
    $con = conectarse();
    $sql = "SELECT * FROM empresa_contratista";
    mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
    echo '<select name="empresa" id="empresa" onchange="llenarContratos()" required>';
    echo '<option value="">Seleccionar...</option>';
    while($fila = mysql_fetch_array($resultado)){
      echo "<option value='" . $fila['ID_CONTRATISTA'] . "'>" . $fila['N_FANTASIA'] . "</option>";
    }
    echo '</select>';
  }

  function getRutTrabajador($id){
    $con = conectarse();
    $sql = "SELECT RUT FROM personal_acreditado WHERE ID_ACREDITADO='$id'";
    mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
    $fila = mysql_fetch_array($resultado);
    return $fila['RUT'];
  }
  
   function getRutEmpresa($id){
    $con = conectarse();
    $sql = "SELECT RUT FROM empresa_contratista WHERE ID_CONTRATISTA='$id'";
    mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
    $fila = mysql_fetch_array($resultado);
    return $fila['RUT'];
  }
  
  function getPasesDiarios(){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $sql="SELECT * FROM personal_acreditado WHERE ID_TIPO_PASE<>'1'";
    $resultado = mysql_query($sql,$con);
    $hoy = date('y/m/d');
    while($row = mysql_fetch_array($resultado)){ 
      //Segunda consulta
      $id = $row['ID_ORDEN_CONTRATO'];
      $sql = "SELECT oc.N_CONTRATO, ec.N_FANTASIA 
              FROM orden_contrato oc, empresa_contratista ec 
              WHERE oc.ID_OC = $id AND
              oc.ID_CONTRATISTA = ec.ID_CONTRATISTA";        
      $resultado = mysql_query($sql,$con);
      $row2 = mysql_fetch_array($resultado);
      $fechaInicio = date('y/m/d',strtotime($row['FECHAINICIO']));
      echo "
          <tr>
              <td>".$row['ID_ACREDITADO'] . "</td>
              <td>".$row['NOMBRES'] . " " . $row['APELLIDOS'] ."</td>
              <td>".$row['RUT'] . "</td>
              <td>".$row2['N_CONTRATO'] . "</td>
              <td>".$row2['N_FANTASIA'] . "</td>
              <td>". $fechaInicio . "</td>";

      if($row['ID_ESTADO']==1){
        echo "<td><span style='cursor:default' class='btn btn-xs btn-success'>activo</span></td>";        
      }
      if($row['ID_ESTADO']==2){
        echo "<td><span style='cursor:default' class='btn btn-xs btn-danger'>inactivo</span></td>";     
      }
      if($row['ID_ESTADO']==3){
        echo "<td><span style='cursor:default' class='btn btn-xs btn-warning'>pendiente</span></td>";     
      }
      echo "</tr>";
    }    
    mysql_close($con);
  }

  function verFotoPersona($id){
      $con = conectarse();
      mysql_set_charset("utf8",$con);
      $sql = "SELECT URL_3 FROM documentacion WHERE ID_ACREDITADO='$id'";
      $resultado = mysql_query($sql,$con);
      $row = mysql_fetch_array($resultado);
      if($row['URL_3']!=""){
        $sql = "SELECT RUT FROM personal_acreditado WHERE ID_ACREDITADO='$id'";
        $resultado = mysql_query($sql,$con);
        $row2 = mysql_fetch_array($resultado);
        echo "archivos/" . $row2['RUT'] . "/" . $row['URL_3'];
      }else{
        echo "images/personal/noimg.jpg";
      }
  }

  function imprimirDocumento($nombre,$date,$mod,$obs,$trabajadorActual,$url,$val,$ndoc){
    $usuario = $_SESSION['nombreUsuario'];
    $disabled = "";
    if($usuario!="Admin"){
      $disabled = "disabled";
    }
    echo '
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="documento col-sm-12 col-md-12">
          <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8">
              <b>'. $nombre .'</b><br>
              <small>Caduca el ' . $date . '</small>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
              <div class="clearfix">
                <div class="pull-right comments-age"><small>Ultima Modificación: <br>'. $mod .'</small></div>
              </div>
            </div>
          </div>
          <div class="well well-sm comments-well">
            <textarea id="obs'. $ndoc . '" style="width:100%;" '. $disabled .'>' . $obs . '</textarea>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
            <form method="post" id="formulario' . $ndoc . '" enctype="multipart/form-data">
              <div class="form-group">
                <label class="">
                  <div id="respuesta'. $ndoc .'">              
                    <a target="_blank" href="http://www.chilecop.cl/acreditacion/archivos/'. $trabajadorActual . '/'. $url .'">' . $url . '</a>
                  </div>
                </label>
                <span class="btn btn-default btn-file">                            
                  Subir Archivo <input type="file" name="file' . $ndoc . '">
                </span>
              </div>
            </form>
          </div>
          '; 
          $usuario = $_SESSION['nombreUsuario'];
          if($usuario=="Admin"){
            echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <label class="">Caduca:</label>
                <input id="val'. $ndoc . '" type="date" value="'. $val . '">
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <label class="">Liberar Documento:</label>
                <a class="apuntador" onClick="liberarDocumento('. $ndoc .')">Eliminar</a>
              </div>                     
            </div>';
          }
        echo '</div>
      </div>';
  }

  function getTipoPase($id){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $sql = "SELECT ID_TIPO_PASE FROM personal_acreditado WHERE ID_ACREDITADO='$id'";
    $resultado = mysql_query($sql,$con);
    $row = mysql_fetch_array($resultado);
    return $row['ID_TIPO_PASE'];
  }

  function getSelectContratos($id){
    $con = conectarse();
    $sql = "SELECT * FROM orden_contrato WHERE ID_CONTRATISTA='$id'";
    mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
    echo '<option value="">Seleccionar contrato...</option>';
    while($fila = mysql_fetch_array($resultado)){
      echo "<option value='" . $fila['ID_OC'] . "'>" . $fila['N_CONTRATO'] . "</option>";
    }
  }
  
?>