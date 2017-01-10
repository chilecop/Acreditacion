<?php
  include('conexion.php');
  include("Zebra_Pagination.php");

	function imprimirMenu(){
		echo '
		<div class="col-md-2 col-sm-1 hidden-xs display-table-cell valign-top" id="side-menu">
          <h1 class="hidden-xs hidden-sm logo"><img src="images/logo.png"></h1>
          <ul>
            <li class="link active">
              <a href="escritorio.php">
                <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Escritorio</span>
              </a>
            </li>

            <li class="link">
              <a href="#collapse-post" data-toggle="collapse" aria-controls="collapse-post">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Personal</span>
                <span class="label label-success pull-right hidden-xs hidden-sm">'. getNumeroPersonal() .'</span>
              </a>
              <ul class="collapse collapseable" id="collapse-post">
              <li><a href="ingresarPersonal.php">Ingresar Personal</a></li>
                <li><a href="personalActivo.php">Listado del Personal</a></li>
              </ul>
            </li>

            <li class="link">
              <a href="#empresas" data-toggle="collapse" aria-controls="collapse-post">
                <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Empresas</span>
                <span class="label label-success pull-right hidden-xs hidden-sm">'. getNumeroEmpresas() .'</span>
              </a>
              <ul class="collapse collapseable" id="empresas">
              	<li><a href="ingresarEmpresa.php">Ingresar Empresa</a></li>
                <li><a href="empresas.php">Empresas Activas</a></li>
              </ul>
            </li>

            <li class="link">
              <a href="#vehiculos" data-toggle="collapse" aria-controls="collapse-post">
                <span class="glyphicon glyphicon-road" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Acceso Vehicular</span>
              </a>
              <ul class="collapse collapseable" id="vehiculos">
                <li><a href="ingresarVehiculo.php">Ingresar Vehiculo</a></li>
                <li><a href="vehiculos.php">Listado de Vehiculos</a></li>
              </ul>
            </li>

            <li class="link">
              <a href="pasesDiarios.php">
                <span class="glyphicon glyphicon glyphicon-tags" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Pases Diarios</span>
              </a>
            </li>

            <li class="link">
              <a href="prohibiciones.php">
                <span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Restricción de Personal</span>
              </a>
            </li>

            <li class="link">
              <a href="#reportes" data-toggle="collapse" aria-controls="collapse-post">
                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Reportes</span>
              </a>
              <ul class="collapse collapseable" id="reportes">
              <li><a href="reporteGeneral.php">Reporte General</a></li>
                <li><a href="reportePorEmpresa.php">Reporte por Empresa</a></li>
              </ul>
            </li>

            <li class="link">
              <a href="settings.php">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                <span class="hidden-sm hidden-xs">Configuraci&oacute;n</span>
              </a>
            </li>
            <h1 class="hidden-xs hidden-sm logo"><img src="images/joyglobal.png"></h1>
          </ul>
        </div>
		';
	}

  function getEmpresasSelect(){
    $con = conectarse();
    $sql="SELECT nombre_empresa,id_empresa FROM empresas";
    echo "<select name='id_empresa' class='form-control' id='empresa' required>";
    $resultado = mysql_query($sql,$con);
    while($row = mysql_fetch_array($resultado)){
      echo "<option value='" . $row['id_empresa'] . "'>" . $row['nombre_empresa'] . "</option>"; 
    }
    echo "</select>";
    mysql_close($con);
  }

  function getPersonal($nxp){
    $con = conectarse();
    $paginas = new Zebra_Pagination();
    $total = totalPersonas($tabla);
    $paginas->records($total);
    $paginas->records_per_page($nxp);
    $query = "SELECT * FROM personal ORDER BY id_personal LIMIT ". (($paginas->get_page() - 1) * $nxp) ."," . $nxp;
    mysql_set_charset("utf8",$con);
    $resultado = mysql_query($query, $con);
    while($fila = mysql_fetch_array($resultado)){
      $query2 = "SELECT nombre_empresa FROM empresas WHERE id_empresa=" . $fila['empresa'];
      $resultado2 = mysql_query($query2, $con);
      $fila2 = mysql_fetch_row($resultado2);
      echo '
      <tr>
        <td>'. $fila['id_personal'] .'</td>
        <td>'. $fila['rut_personal'] .'</td>
        <td>'. $fila['nombre_personal'] .'</td>
        <td>'. $fila2['0'] .'</td>
        <td>'. $fila['cargo'] .'</td>
        <td><a class="btn btn-xs btn-default" href="editarPersona.php?id='.$fila['id_personal'].'" role="button">editar</a></td>
        <td><a class="btn btn-xs btn-warning" href="prohibirPersona.php?id='.$fila['id_personal'].'" role="button">prohibir</a></td>
        <td><a class="btn btn-xs btn-danger" href="eliminarPersona.php?id='.$fila['id_personal'].'" role="button">eliminar</a></td>
      </tr>
      ';
    }
    mysql_close($con);
  }

  function totalPersonas($tabla){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $query = "SELECT count(*) FROM " . $tabla;
    $resultado = mysql_query($query, $con);
    $fila = mysql_fetch_row($resultado);
    return $fila['0'];
    mysql_close($con);
  }
    
  function paginacion($nxp,$tabla){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $paginas = new Zebra_Pagination();
    $total = totalPersonas($tabla);
    $paginas->records($total);
    $paginas->records_per_page($nxp);
    echo $paginas->render();
    mysql_close($con);
  }

  function getEmpresas(){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $sql="SELECT * FROM empresas";
    $resultado = mysql_query($sql,$con);
    while($row = mysql_fetch_array($resultado)){
      echo "
          <tr>
              <td>".$row['id_empresa'] . "</td>
              <td>".$row['nombre_empresa'] . "</td>
              <td>".$row['rut_empresa'] . "</td>
              <td>".$row['representante'] . "</td>
              <td>".$row['email'] . "</td>
              <td>".$row['contactoemergencia'] . "</td>
              <td>".$row['telefonoemergencia'] . "</td>
              <td><a class='btn btn-xs btn-success' href='verEmpresa.php?id=".$row['id_empresa']."&nombre=". $row['nombre_empresa'] ."' role='button'>ver</a></td>
              <td><a class='btn btn-xs btn-warning' href='editarEmpresa.php?id=".$row['id_empresa']."&nombre=". $row['nombre_empresa'] ."' role='button'>editar</a></td>
              <td><a class='btn btn-xs btn-danger' href='eliminarEmpresa.php?id=".$row['id_empresa']."&nombre=". $row['nombre_empresa'] ."' role='button'>eliminar</a></td>
          </tr>    
          ";
    }
    mysql_close($con);
  }

  function getProhibiciones($nxp){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $paginas = new Zebra_Pagination();
    $total = totalPersonas();
    $paginas->records($total);
    $paginas->records_per_page($nxp);
    $sql="SELECT * FROM prohibiciones ORDER BY id_prohibicion LIMIT ". (($paginas->get_page() - 1) * $nxp) ."," . $nxp;
    $resultado = mysql_query($sql,$con);
    while($row = mysql_fetch_array($resultado)){

      echo '
          <tr>
            <td>'.$row['id_prohibicion'].'</td>
            <td>'.$row['r_prohibicion'].'</td>
            <td>'.$row['n_prohibicion'].'</td>
            <td>'.$row['razon'].'</td>
            <td><a class="btn btn-xs btn-success" href="permitirPersona.php?id='. $row['id_prohibicion'] .'" role="button">permitir</a></td>
          </tr>
      ';
    }
    mysql_close($con);
  }

  function getMensajes(){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    mysql_set_charset("utf8",$con);
    $query = "SELECT * FROM mensajes ORDER BY fecha DESC LIMIT 5";    
    $resultado = mysql_query($query, $con);
    $contador = 0;
    $color = " style='color:#1ab394;' ";
    while($fila = mysql_fetch_array($resultado)){
      if($contador>0)$color = "";
      echo '
        <div '. $color . ' class="comment-head-dash clearfix">
          <div class="commenter-name-dash pull-left">'. $fila['titulo'] .'</div>
        </div>
        <p '. $color . ' class="comment-dash">
          '. $fila['observacion'] .'
        </p>
        <small '. $color . ' class="comment-date-dash">'. $fila['fecha'] .'</small>
        <hr>
      ';
      $contador++;
    }
    mysql_close($con);
  }

  function getNumeroProhibiciones($garita){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
  }

  function getRegistrosGarita($tipo){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $query = "SELECT COUNT(*) FROM `pruebaingresos` WHERE DATE(`fecha`) = DATE(NOW()) and `outin` = '$tipo'";    
    $resultado = mysql_query($query, $con);
    $fila = mysql_fetch_row($resultado);
    echo $fila['0'];
    mysql_close($con);
  }

  function getNumeroPersonal(){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $query = "SELECT count(*) FROM personal";
    $resultado = mysql_query($query, $con);
    $fila = mysql_fetch_row($resultado);
    mysql_close($con);
    return $fila['0'];    
  }

  function getNumeroEmpresas(){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $query = "SELECT count(*) FROM empresas";
    $resultado = mysql_query($query, $con);
    $fila = mysql_fetch_row($resultado);
    mysql_close($con);
    return $fila['0'];
  }

  function getPersonaEdit($id){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $query = "SELECT * FROM personal WHERE id_personal='$id'";
    $resultado = mysql_query($query, $con);
    $fila = mysql_fetch_array($resultado);
    mysql_close($con);
    $empresa = getEmpresaNombre($fila['empresa']);
    return $fila['nombre_personal'] . "%$" . $fila['rut_personal'] . "%$" . $fila['cargo'] . "%$" . $empresa . "%$" . $fila['empresa'];
  }

  function getEmpresaNombre($id){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $query = "SELECT nombre_empresa FROM empresas WHERE id_empresa='$id'";
    $resultado = mysql_query($query, $con);
    $fila = mysql_fetch_row($resultado);
    mysql_close($con);
    return $fila['0'];
  }

  function getDatosProhibicion($id){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $sql = "SELECT * FROM prohibiciones WHERE id_prohibicion='$id'";
    $resultado = mysql_query($sql, $con);
    if($fila = mysql_fetch_array($resultado)){
      mysql_close($con);
      return $fila['n_prohibicion'] . "%$" . $fila['r_prohibicion'] . "%$" . $fila['razon'];
    }
  }

  function puedoEliminarEmpresa($id){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $sql = "SELECT count(*) FROM personal WHERE empresa='$id'";
    $resultado = mysql_query($sql, $con);
    if($fila = mysql_fetch_row($resultado)){
      mysql_close($con);
      return $fila['0'];
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

  function getPasesDiarios(){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $hoy = date('y/m/d');
    $sql="SELECT * FROM pasesDiarios";
    $resultado = mysql_query($sql,$con);
    while($row = mysql_fetch_array($resultado)){      
      $fechaInicio = date('y/m/d',strtotime($row['fechaInicio']));
      $fechaTermino = date('y/m/d',strtotime($row['fechaTermino']));
      echo "
          <tr>
              <td>".$row['id'] . "</td>
              <td>".$row['nombre'] . "</td>
              <td>".$row['rut'] . "</td>
              <td>".$row['empresa'] . "</td>
              <td>".date('d/m/y',strtotime($row['fechaInicio'])) . "</td>
              <td>".date('d/m/y',strtotime($row['fechaTermino'])). "</td>";
      if($fechaInicio<= $hoy && $hoy<=$fechaTermino){
        echo "<td><span style='cursor:default' class='btn btn-xs btn-success'>activo</span></td>";        
      }else{
        echo "<td><span style='cursor:default' class='btn btn-xs btn-danger'>inactivo</span></td>";     
      }
      echo "<td><a class='btn btn-xs btn-danger' href='eliminarPases.php?id=".$row['id']."' role='button'>eliminar</a></td>";
      echo "</tr>";
    }
    mysql_close($con);
  }

  function getNombrePersona($id){
    $con = conectarse();
    mysql_set_charset("utf8",$con);
    $sql="SELECT nombre_personal FROM personal WHERE id_personal='$id'";
    $resultado = mysql_query($sql,$con);
    if($fila = mysql_fetch_row($resultado)){
      return $fila[0];
    }
  }

  function getEmpresasEdit($id){
    $con = conectarse();
    $sql="SELECT nombre_empresa,id_empresa FROM empresas";
    mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
    $selected = "";
    while($row = mysql_fetch_array($resultado)){
      if($row['id_empresa']==$id){
        $selected = "selected";
      }
      echo "<option value='" . $row['id_empresa'] . "' " . $selected . ">" . $row['nombre_empresa'] . "</option>"; 
      $selected = "";
    }
    mysql_close($con);
  }

  function getJornada($i,$actual){
    $con = conectarse();
    $sql="SELECT * FROM tipojornada";
    mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
    $required = "";
    if($i==1){
      $required = "required";
    }
    $selected = "";
    echo "<select name='jornada" . $i ."' class='form-control' ". $required ." >";
    while($row = mysql_fetch_array($resultado)){
      if($row['id']==$actual){
        $selected = "selected";
      }
      echo "<option value='" . $row['id'] . "' ". $selected ." >" . $row['tipo'] . "</option>";
      $selected = "";
    }
    echo '</select>';
    mysql_close($con);
  }

  function getDatosEmpresa($id){
    $con = conectarse();
    $sql = "SELECT emp.*, tj1.tipo AS tipo1, tj2.tipo AS tipo2 FROM empresas emp INNER JOIN tipojornada tj1, tipojornada tj2 WHERE emp.id_empresa='$id' AND tj1.id = emp.tipojornada AND tj2.id = emp.otrajornada";
    mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
    if($fila = mysql_fetch_array($resultado)){
      mysql_close($con);
      return $fila['nombre_empresa'] . "%$" . $fila['rut_empresa'] . "%$" . $fila['giro'] . "%$" . $fila['direccion'] . "%$" . $fila['ciudad'] . "%$" . $fila['representante'] . "%$" . $fila['email'] . "%$" . $fila['tipojornada'] . "%$" . $fila['otrajornada'] . "%$" . $fila['iniciocontrato'] . "%$" . $fila['terminocontrato'] . "%$" . $fila['contactoemergencia'] . "%$" . $fila['telefonoemergencia'] . "%$" . $fila['tipo1'] . "%$" . $fila['tipo2'];
    }
  }

  function getTipoVehiculoSelect($tipo){
    $selected = "";
    $con = conectarse();
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

  function getVehiculos(){
    $con = conectarse();
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

  function getDatosVehiculo($id){
    $con = conectarse();
    $sql = "SELECT * FROM vehiculo WHERE id='$id'";
    mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
    if($fila = mysql_fetch_array($resultado)){
      mysql_close($con);
      return $fila['patente'] . "%$" . $fila['conductor'] . "%$" . $fila['marca'] . "%$" . $fila['modelo'] . "%$" . $fila['color'] . "%$" . $fila['anio'] . "%$" . $fila['tipo'];
    }
  }
?>