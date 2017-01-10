<?php
include('conexion.php');
session_start();

/**
* Recepcion de Variables
*/
$con = conectarse();
$observacion = $_POST['observacion'];
$tipo = $_POST['tipo'];
$documentos = $_POST['documentos'];
$documentosText = $_POST['documentosText'];

/**
* Si es persona, busqueda de la empresa a la cual pertence
*/
switch ($tipo) {
	case 'Persona':
		$id = $_SESSION['idTrabajadorActual'];
		$sql = "SELECT NOMBRES, APELLIDOS, RUT FROM personal_acreditado WHERE ID_ACREDITADO='$id'";
		$resultado = mysql_query($sql,$con);
		$fila = mysql_fetch_array($resultado);			
	    $sql= "
	    SELECT 
	    oc.ID_CONTRATISTA As idEmpresa
	    FROM 
	    personal_acreditado pa, orden_contrato oc
	    WHERE 
	    pa.ID_ACREDITADO='$id' AND
	    pa.ID_ORDEN_CONTRATO = oc.ID_OC";

	    //Estructura de la observacion
	    $mensaje = "
	    <b>Tipo de Observación:</b> Documentación Personal<br>
	    <b>Nombre:</b> " . $fila['NOMBRES'] . " " . $fila['APELLIDOS'] . "<br>
	    <b>Rut:</b> " . $fila['RUT'] . "<br>
	    <b>Documentos Asociados:</b> " . $documentosText . "<br>
	    <b>Observación:</b> " . $observacion . "<br><br>
	    Para ver y corregir dichos documentos, haga clic <a href='http://www.chilecop.cl/acreditacion/documentacionPersonal.php?id=". $id ."' target='_blank'>Aquí</a>.<br>
	    ";
		break;
	case 'Empresa':
		$id = $_SESSION["idEmpresaActual"];
		$idEmpresa = $_SESSION["idEmpresaActual"];
    //Estructura de la observacion
      $mensaje = "
      <b>Tipo de Observación:</b> Documentación Empresa<br>
      <b>Documentos Asociados:</b> " . $documentosText . "<br>
      <b>Observación:</b> " . $observacion . "<br><br>
      Para ver y corregir dichos documentos, haga clic <a href='http://www.chilecop.cl/acreditacion/documentacionEmpresa.php?id=". $id ."' target='_blank'>Aquí</a>.<br>
      ";
	    break;
	case 'Contrato':
		$id = $_SESSION['contratoActual'];
		$sql = "
		SELECT
		ID_CONTRATISTA As idEmpresa
		FROM
		orden_contrato
		WHERE
		ID_OC='$id'";
    //Estructura de la observacion
      $mensaje = "
      <b>Tipo de Observación:</b> Documentación Contrato<br>
      <b>Documentos Asociados:</b> " . $documentosText . "<br>
      <b>Observación:</b> " . $observacion . "<br><br>
      Para ver y corregir dichos documentos, haga clic <a href='http://www.chilecop.cl/acreditacion/documentacionContrato.php?id=". $id ."' target='_blank'>Aquí</a>.<br>
      ";
	    break;
	default:
		# code...
		break;
}

if($tipo!="Empresa"){
	/**
	* Consulta a la BD
	*/
	$resultado = mysql_query($sql,$con);
	$fila = mysql_fetch_array($resultado);
	$idEmpresa = $fila['idEmpresa'];
}

/**
* Insertar la observacion a la BD
*/
$sql = "
INSERT INTO alerta_documentacion (ID_CONTRATISTA,ID_TIPO,REFERENCIA,DOCUMENTOS,OBSERVACION) 
VALUES ('$idEmpresa','$tipo','$id','$documentos','$observacion')";
$resultado = mysql_query($sql,$con);

/**
* Enviar mensaje de aviso de observacion
*/
//BUSCAR CORREOS DE LOS RESPONSABLES
$sql = "SELECT MAIL_CONTACTO, MAIL_RESPONSABLE, N_FANTASIA FROM empresa_contratista WHERE ID_CONTRATISTA='$idEmpresa'";
$resultado = mysql_query($sql,$con);
$fila = mysql_fetch_array($resultado);

$asunto = "Observacion Documentaria";
$para = $fila['MAIL_CONTACTO'];
$html = ' <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" bgcolor="#FFF"><table width="800" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="4%" height="77"></td>
        <td align="center" colspan="2"><a href="http://www.chilecop.cl"><img src="http://www.chilecop.cl/acreditacion/images/logo.png" width="183" height="131" /></a></td><br><br>
        <td width="9%"></td>
      </tr>
      <tr>
        <td height="10" valign="top"></td>
        <td style="font-family:Arial,Helvetica,sans-serif;color:#fff;font-size:20px" colspan="2" valign="top" height="10"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
          <tr height="10">
            <td width="10" height="10" valign="top"><img style="display:block" src="http://www.chilecop.cl/acreditacion/images/mailing/pxi.png" width="10" height="10" /></td>
            <td width="100%" height="10" valign="top" bgcolor="#2f4050"></td>
            <td width="10" height="10"><img style="display:block" valign="top" src="http://www.chilecop.cl/acreditacion/images/mailing/pxd.png" width="10" height="10" /></td>
          </tr>
        </table></td>
        <td></td>
      </tr>
      <tr>
        <td height="19"></td>
        <td colspan="2" bgcolor="#2f4050" style="font-family:Arial,Helvetica,sans-serif;color:#fff;font-size:20px">&nbsp;&nbsp;' . $asunto . ' - Chilecop</td>
        <td></td>
      </tr>
      <tr>
        <td height="7"></td>
        <td colspan="2" bgcolor="#2f4050"></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td width="87%"></td>
        <td width="0%"></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2" bgcolor="#FFFFFF"></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" style="font-family:Arial,Helvetica,sans-serif; color:#55555;font-size:12px; text-align:justify" align="left">
          <tr>
            <td width="6%"></td>
            <td width="483"><br />Estimados '. $fila['N_FANTASIA'] . '<strong>, </strong><br />
              <br />
              Es un gusto para nosotros saludarle, y poder informarle que se encontraron las siguientes observaciones en la documentaria,<br>';

              if($mensaje != NULL){
                $html.='<br>'. $mensaje . '<br>';
              }

              $html .='<br><b>
              Para mayor informaci&oacute;n, puede responder este mismo correo o bien llamarnos a los numeros al pie de este mensaje.<br/><br/>       
              Saludos cordiales!<br/><br/>---<br />
              Equipo Chilecop<br />
              Consultas, +56 9 44337239 - +56 9 73885258 - +56 9 63424158<br />---
              <br />http://www.chilecop.cl<br />Protecci&oacute;n a tu servicio<br />
              <br />
              <br />
            </td>
            <td width="6%"></td>
          </tr>
        </table></td>
        <td></td>
      </tr>
      <tr>
        <td></td><td colspan="2" valign="top" height="10"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="1%" height="10" valign="top"><img style="display:block" src="http://www.chilecop.cl/acreditacion/images/mailing/pxdi.png" width="10" height="10" /></td>
            <td width="97%" height="10" valign="top" bgcolor="#2f4050"></td>
            <td width="2%" height="10"><img style="display:block" src="http://www.chilecop.cl/acreditacion/images/mailing/pxdd.png" width="10" height="10" /></td>
          </tr>
        </table></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
    <br />
    <br /></td><br />
  </tr>
</table>';



/**
* Armado de la cabecera del mensaje
*/
$header = 'From: ' . "Chilecop Administracion <acreditacion@chilecop.cl> \r\n";
$header .= "cc: informatica@chilecop.cl \r\n";
$header .= "cc: " . $fila['MAIL_RESPONSABLE'] . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type:  text/html\r\n";

//COMPOSICIÓN DEL CORREO
mail($para, $asunto, utf8_decode($html), $header); 

mysql_close($con);
?>