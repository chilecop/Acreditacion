<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

/*
* Conexion con la BD
*/
include('conexion.php');
$con = conectarse();

/*
* Consulta a la base de datos por la Documentacion del personal
*/
$sql = "SELECT * FROM documentacion";
$resultado = mysql_query($sql,$con);

//Recoremos todos los documentos
while($fila = mysql_fetch_array($resultado)){
	for ($i=1; $i < 24; $i++) { 

		//Columna de la BD que se solicitara
		$columna = "VAL_" . $i;
		$columnaURL = "URL_" . $i;
		$nombreArchivo = $fila[$columnaURL];
		$tipo = "Persona";
		$fechaVencimiento = $fila[$columna];

		//Id Acreditado
		$referencia = $fila['ID_ACREDITADO'];

		//Verificamos que el documento haya sido subido
		if($fila[$columna]!='0000-00-00' && $fila[$columna]!=NULL && $fila[$columna]!=""){

			//Crear la fecha de validacion
			$diasRestantes = diasRestantes($fila[$columna]);

			//Teniendo la diferencia, se ve si quedan 30, 15 o 5, o ya vencio
			if($diasRestantes==30){
				registrarVencimiento($referencia,$nombreArchivo,$tipo,30);
				enviarCorreo($tipo,$referencia,$nombreArchivo,30,$fechaVencimiento);
			}
			if($diasRestantes==15){
				registrarVencimiento($referencia,$nombreArchivo,$tipo,15);
				enviarCorreo($tipo,$referencia,$nombreArchivo,15,$fechaVencimiento);
			}
			if($diasRestantes==5){
				registrarVencimiento($referencia,$nombreArchivo,$tipo,5);
				enviarCorreo($tipo,$referencia,$nombreArchivo,5,$fechaVencimiento);
			}
			if($diasRestantes==0){
				registrarVencimiento($referencia,$nombreArchivo,$tipo,0);
				enviarCorreo($tipo,$referencia,$nombreArchivo,0,$fechaVencimiento);
			}
			if($diasRestantes==-1){
				$sql = "UPDATE personal_acreditado SET ID_ESTADO='3' WHERE ID_ACREDITADO='$referencia'";
				mysql_query($sql,$con);
				$sql = "INSERT INTO estado_trabajador_historial (ID_ACREDITADO, ESTADO, FECHA) VALUES ('$referencia', '3', now())";
				mysql_query($sql,$con);
				registrarVencimiento($referencia,$nombreArchivo,$tipo,-1);
				enviarCorreo($tipo,$referencia,$nombreArchivo,-1,$fechaVencimiento);
			}
		}else{

		}
	}	
}

/*
* Consulta a la base de datos por la Documentacion de Empresa
*/
$sql = "SELECT * FROM documentacion_contratista";
$resultado = mysql_query($sql,$con);

//Recoremos todos los documentos
while($fila = mysql_fetch_array($resultado)){
	for ($i=1; $i < 11; $i++) { 

		//Columna de la BD que se solicitara
		$columna = "VAL" . $i;
		$columnaURL = "URL" . $i;
		$nombreArchivo = $fila[$columnaURL];
		$tipo = "Empresa";
		$fechaVencimiento = $fila[$columna];
	
		//Id Contratista
		$referencia = $fila['ID_CONTRATISTA'];

		//Verificamos que el documento haya sido subido
		if($fila[$columna]!='0000-00-00' && $fila[$columna]!=NULL && $fila[$columna]!=""){

			//Crear la fecha de validacion
			$diasRestantes = diasRestantes($fila[$columna]);

			//Teniendo la diferencia, se ve si quedan 30, 15 o 5, o ya vencio
			if($diasRestantes==30){
				registrarVencimiento($referencia,$nombreArchivo,$tipo,30);
				enviarCorreo($tipo,$referencia,$nombreArchivo,30,$fechaVencimiento);
			}
			if($diasRestantes==15){
				registrarVencimiento($referencia,$nombreArchivo,$tipo,15);
				enviarCorreo($tipo,$referencia,$nombreArchivo,15,$fechaVencimiento);
			}
			if($diasRestantes==5){
				registrarVencimiento($referencia,$nombreArchivo,$tipo,5);
				enviarCorreo($tipo,$referencia,$nombreArchivo,5,$fechaVencimiento);
			}
			if($diasRestantes==0){
				registrarVencimiento($referencia,$nombreArchivo,$tipo,0);
				enviarCorreo($tipo,$referencia,$nombreArchivo,0,$fechaVencimiento);
			}
			if($diasRestantes==-1){
				$sql = "UPDATE empresa_contratista SET ID_ESTADO='3' WHERE ID_CONTRATISTA='$referencia'";
				mysql_query($sql,$con);
				$sql = "INSERT INTO estado_empresa_historial (ID_CONTRATISTA, ESTADO, FECHA) VALUES ('$referencia', '3', now())";
				mysql_query($sql,$con);
				registrarVencimiento($referencia,$nombreArchivo,$tipo,-1);
				enviarCorreo($tipo,$referencia,$nombreArchivo,-1,$fechaVencimiento);
			}
		}else{

		}
	}
}

/*
* Consulta a la base de datos por la Documentacion de Contratos
*/
$sql = "SELECT * FROM documentacion_contrato";

$resultado = mysql_query($sql,$con);
while($fila = mysql_fetch_array($resultado)){
	for ($i=1; $i < 5; $i++) { 

		//Columna de la BD que se solicitara
		$columna = "VAL_" . $i;
		$columnaURL = "URL_" . $i;
		$nombreArchivo = $fila[$columnaURL];
		$tipo = "Contrato";
		$fechaVencimiento = $fila[$columna];
	
		//Id OC
		$referencia = $fila['ID_OC'];

		//Verificamos que el documento haya sido subido
		if($fila[$columna]!='0000-00-00' && $fila[$columna]!=NULL && $fila[$columna]!=""){

			//Crear la fecha de validacion
			$diasRestantes = diasRestantes($fila[$columna]);

			//Teniendo la diferencia, se ve si quedan 30, 15 o 5, o ya vencio
			if($diasRestantes==30){
				registrarVencimiento($referencia,$nombreArchivo,$tipo,30);
				enviarCorreo($tipo,$referencia,$nombreArchivo,30,$fechaVencimiento);
			}
			if($diasRestantes==15){
				registrarVencimiento($referencia,$nombreArchivo,$tipo,15);
				enviarCorreo($tipo,$referencia,$nombreArchivo,15,$fechaVencimiento);
			}
			if($diasRestantes==5){
				registrarVencimiento($referencia,$nombreArchivo,$tipo,5);
				enviarCorreo($tipo,$referencia,$nombreArchivo,5,$fechaVencimiento);
			}
			if($diasRestantes==0){
				registrarVencimiento($referencia,$nombreArchivo,$tipo,0);
				enviarCorreo($tipo,$referencia,$nombreArchivo,0,$fechaVencimiento);
			}
			if($diasRestantes==-1){
				$sql = "UPDATE orden_contrato SET ID_ESTADO='3' WHERE ID_OC='$referencia'";
				mysql_query($sql,$con);
				$sql = "INSERT INTO estado_contrato_historial (ID_OC, ESTADO, FECHA) VALUES ('$referencia', '3', now())";
				mysql_query($sql,$con);
				registrarVencimiento($referencia,$nombreArchivo,$tipo,-1);
				enviarCorreo($tipo,$referencia,$nombreArchivo,-1,$fechaVencimiento);
			}
		}else{

		}
	}
}

/**
* Cuenta los dias restantes para que un documento caduque
* @param int $dia1 dia de la fecha a comparar
* @param int $mes1 mes de la fecha a comparar
* @param int $ano1 anio de la fecha a comparar
*
* @return int dias restantes para el vencimiento
*/
function diasRestantes($fecha){

	$fechaValidacion = date_create($fecha);	
	$dia1 = date_format($fechaValidacion, 'd');
	$mes1 = date_format($fechaValidacion, 'm');
	$ano1 = date_format($fechaValidacion, 'Y');

	$ano2 = date("Y");
	$mes2 = date("m");
	$dia2 = date("d");

	$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
	$timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2);

	//resto a una fecha la otra 
	$segundos_diferencia = $timestamp1 - $timestamp2; 
	//echo $segundos_diferencia; 

	//convierto segundos en días 
	$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

	//quito los decimales a los días de diferencia 
	$dias_diferencia = floor($dias_diferencia);

	return $dias_diferencia;
}

/**
* Funcion que registra el vencimiento en alerta_documentacion.
* @param string $referencia es la id de la persona, contrato o empresa segun corresponda
* @param string $nombreArchivo es el nombre de la columna de la URL del documento actual
* @param string $tipo es el tipo de documento, si es de personal, contrato o empresa
* @param string $dias son los dias restantes para el vencimiento del documento
*/
function registrarVencimiento($referencia,$nombreArchivo,$tipo,$dias){
	$con = conectarse();

	//Buscar la empresa, correspondiente al acreditado actual y el rut del acreditado
	switch ($tipo) {
		case 'Persona':
			$sql = "SELECT oc.ID_CONTRATISTA, pa.RUT AS 'CARPETA' FROM orden_contrato oc, personal_acreditado pa
			WHERE pa.ID_ACREDITADO = '$referencia' AND
			pa.ID_ORDEN_CONTRATO = oc.ID_OC";
			$carpeta = "archivos";

			//Observacion
			if($dias==-1){
				$observacion = "Documento vencido, trabajador desacreditado.";
			} else {
				$observacion = "Documento próximo a vencer en " . $dias . " días";
			}
			break;
		case 'Contrato':
			$sql = "SELECT oc.ID_CONTRATISTA, oc.N_CONTRATO AS 'CARPETA' FROM orden_contrato oc
			WHERE oc.ID_OC = '$referencia'";
			$carpeta = "archivoscontrato";

			//Observacion
			if($dias==-1){
				$observacion = "Documento vencido, contrato desacreditado.";
			} else {
				$observacion = "Documento próximo a vencer en " . $dias . " días";
			}
			break;
		case 'Empresa':
			$sql = "SELECT emp.ID_CONTRATISTA, emp.RUT AS 'CARPETA' FROM empresa_contratista emp
			WHERE emp.ID_CONTRATISTA = '$referencia'";
			$carpeta = "archivoseecc";

			//Observacion
			if($dias==-1){
				$observacion = "Documento vencido, empresa desacreditada.";
			} else {
				$observacion = "Documento próximo a vencer en " . $dias . " días";
			}
			break;
		default:
			# code...
			break;
	}

	//Busqueda en la Base de Datos
	$resultado = mysql_query($sql,$con);
	$fila2 = mysql_fetch_array($resultado);
	$idContratista = $fila2['ID_CONTRATISTA'];

	//Armar link para el documento
	$documento = "<a href='http://www.chilecop.cl/acreditacion/". $carpeta . "/" . $fila2['CARPETA'] . "/" . $nombreArchivo . "' target='_blank'>VER DOCUMENTO</a>";
	$documento = addslashes($documento);

	//Ejecucion query
	$sql = "INSERT INTO alerta_documentacion (ID_CONTRATISTA, ID_TIPO, REFERENCIA, DOCUMENTOS, OBSERVACION, VISIBLE) VALUES ('$idContratista', '$tipo', '$referencia','$documento','$observacion','1')";
	mysql_query($sql,$con);
	echo $sql;
}

/**
 * Envia el correo correspondiente a la empresa responsable de la documentacion.
 * @param String $tipo es el tipo documentacion que puede ser empresa, contrato o persona.
 * @param int $referencia de acuerdo al tipo es la id de empresa, contrato o persona.
 * @param String $nombreArchivo nombre del archivo para armar la URL directa.
 * @param int $dias restantes para que caduque el documento.
 * @param datetime $fechaVencimiento del documento en cuestion.
 * @return echo
 */
function enviarCorreo($tipo,$referencia,$nombreArchivo,$dias,$fechaVencimiento){
	$con = conectarse();

	//Seleccion de acuerdo al tipo de documento
	switch ($tipo) {
		case 'Persona':
			$sql = "SELECT emp.N_FANTASIA, pa.NOMBRES, pa.APELLIDOS, pa.RUT
			FROM empresa_contratista emp, personal_acreditado pa, orden_contrato oc
			WHERE 
			pa.ID_ACREDITADO = '$referencia' AND
			pa.ID_ORDEN_CONTRATO = oc.ID_OC AND
			oc.ID_CONTRATISTA = emp.ID_CONTRATISTA";

			//Consulta a la Base de DATOS
			$resultado = mysql_query($sql,$con);
			$fila = mysql_fetch_array($resultado);

			//Armado de la variable que contiene el link al documento en cuestion
			$documento = "<a href='http://www.chilecop.cl/acreditacion/archivos/" . $fila['RUT'] . "/" . $nombreArchivo . "' target='_blank'>VER DOCUMENTO</a>";

			//Armado de la observacion, cuerpo del mensaje
			$observacion = "
			Nombre: " . $fila['NOMBRES'] . " " . $fila['APELLIDOS'] . "<br>
			Rut: " . $fila['RUT'] . "<br>
			Documento: " . $documento . "<br>
			Fecha Vencimiento: " . $fechaVencimiento . "<br>
			";

			//Nombre de la empresa para la cabecera
			$nombreEmpresa = $fila['N_FANTASIA'];

			//Documento vencido
			if($dias==-1){
				$asunto = "Documento de persona vencido";
			} else {
				$asunto = "Alerta vencimiento de documento persona";
			}

			//Footer del mensaje que muestra la advertencia de la caducidad del documento
			if($dias==-1){
				$advertencia = "<b>La fecha del documento ha caducado y el trabajador se ha desacreditado automáticamente. Para regularizar dicha situación, debe subir el documento actualizado y enviar a revisión.</b>";
			} else {
				$advertencia = "<b>Recuerde que si el documento no se regulariza dentro de " . $dias . " días, el trabajador quedará desacreditado, bloqueando el acceso a las instalaciones.</b>";
			}
			break;

		case 'Contrato':

			//Consulta por el N Contrato y Nombre de la empresa
			$sql = "SELECT oc.N_CONTRATO, emp.N_FANTASIA FROM orden_contrato oc, empresa_contratista emp WHERE ID_OC='$referencia' AND emp.ID_CONTRATISTA = oc.ID_CONTRATISTA";

			//Consulta a la Base de DATOS
			$resultado = mysql_query($sql,$con);
			$fila = mysql_fetch_array($resultado);

			//Armado de la variable que contiene el link al documento en cuestion
			$documento = "<a href='http://www.chilecop.cl/acreditacion/archivoscontrato/" . $fila['N_CONTRATO'] . "/" . $nombreArchivo . "' target='_blank'>VER DOCUMENTO</a>";

			//Armado de la observacion, cuerpo del mensaje
			$observacion = "
			N° de contrato: " . $fila['N_CONTRATO'] . "<br>
			Documento: " . $documento . "<br>
			Fecha Vencimiento: " . $fechaVencimiento . "<br>
			";

			//Nombre de la empresa para la cabecera
			$nombreEmpresa = $fila['N_FANTASIA'];

			//Documento vencido
			if($dias==-1){
				$asunto = "Documento de contrato VENCIDO";
			} else {
				$asunto = "Alerta vencimiento de documento persona";
			}

			//Footer del mensaje que muestra la advertencia de la caducidad del documento
			if($dias==-1){
				$advertencia = "<b>La fecha del documento ha caducado y el contrato se ha desacreditado automáticamente. Para regularizar dicha situación, debe subir el documento actualizado y enviar a revisión. Debido a esta situación, todo el personal adherido al presente contrato queda con prohibición de acceso a las instalaciones.</b>";
			} else {
				$advertencia = "<b>Recuerde que si el documento no se regulariza dentro de " . $dias . " días, el contrato quedará desacreditado, bloqueando el acceso a las instalaciones a todo el personal perteneciente a dicho contrato.</b>";
			}

			//Footer del mensaje que muestra la advertencia de la caducidad del documento
			
			break;

		case 'Empresa':

			//Consulta por el N Contrato y Nombre de la empresa
			$sql = "SELECT N_FANTASIA, RUT FROM empresa_contratista WHERE ID_CONTRATISTA='$referencia'";

			//Consulta a la Base de DATOS
			$resultado = mysql_query($sql,$con);
			$fila = mysql_fetch_array($resultado);

			//Armado de la variable que contiene el link al documento en cuestion
			$documento = "<a href='http://www.chilecop.cl/acreditacion/archivoseecc/" . $fila['RUT'] . "/" . $nombreArchivo . "' target='_blank'>VER DOCUMENTO</a>";

			//Armado de la observacion, cuerpo del mensaje
			$observacion = "
			Nombre empresa: " . $fila['N_FANTASIA'] . "<br>
			Documento: " . $documento . "<br>
			Fecha Vencimiento: " . $fechaVencimiento . "<br>
			";

			//Nombre de la empresa para la cabecera
			$nombreEmpresa = $fila['N_FANTASIA'];

			//Documento vencido
			if($dias==-1){
				$asunto = "Documento de empresa VENCIDO";
			} else {
				$asunto = "Alerta vencimiento de documento persona";
			}

			//Footer del mensaje que muestra la advertencia de la caducidad del documento
			if($dias==-1){
				$advertencia = "<b>La fecha del documento ha caducado y la empresa se ha desacreditado automáticamente. Para regularizar dicha situación, debe subir el documento actualizado y enviar a revisión. Debido a esta situación, todo el personal queda con prohibición de acceso a las instalaciones.</b>";
			} else {
				$advertencia = "<b>Recuerde que si el documento no se regulariza dentro de " . $dias . " días, su empresa quedará desacreditada, bloqueando el acceso a las instalaciones a todo el personal.</b>";
			}
			break;
		default:
			# code...
			break;
	}

	$para = "informatica@chilecop.cl";


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
	            <td width="483"><br />Estimados ' . $nombreEmpresa .'<strong>, </strong><br />
	              <br />
	              Es un gusto para nosotros saludarles. En esta ocasión, queremos hacerles llegar la siguiente alerta de vencimiento de documento,<br>';

	              if($observacion != NULL){
	                $html.='<br>'. $observacion . '<br>';
	              }

	              $html .='<br>' . $advertencia . '<br><br>

	              <b>Para mayor informaci&oacute;n, puede responder este mismo correo o bien llamarnos a los numeros al pie de este mensaje.<br/><br/>       
	              Saludos cordiales!<br/><br/>---<br />
	              Equipo Chilecop<br />
	              Consultas, +56 9 44337239 - +56 9 73885258<br />---
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

	//$con = conectarse();
	//$sql = "SELECT MAIL_CONTACTO, MAIL_RESPONSABLE FROM empresa_contratista";
	//$resultado = mysql_query($sql,$con);

	/**
	* Armado de la cabecera del mensaje
	*/
	$header = 'From: ' . "Chilecop Administracion <acreditacion@chilecop.cl> \r\n";
	//$header .= "cc: informatica@chilecop.cl \r\n";
	//$header .= "cc: " . $fila['MAIL_CONTACTO'] ." \r\n";
	//$header .= "cc: " . $fila['MAIL_RESPONSABLE'] . " \r\n";
	$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
	$header .= "Mime-Version: 1.0 \r\n";
	$header .= "Content-Type:  text/html\r\n";

	//COMPOSICIÓN DEL CORREO
	mail($para, $asunto, utf8_decode($html), $header); 
	echo 'Mensaje enviado correctamente.';
}

// CONSULTAS
//¿ESTA BIEN ENVIAR UN CORREO A 30, 15 Y 5 DIAS?
//¿ENVÍO TAMBIÉN CUANDO VENZA?
//
?>
