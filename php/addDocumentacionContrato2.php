<?php
	include('conexion.php');
	session_start();
	$con = conectarse();
	mysql_set_charset("utf8",$con);

	$obs1 = $_POST['obs1'];
	$obs2 = $_POST['obs2'];
	$obs3 = $_POST['obs3'];
	$obs4 = $_POST['obs4'];

	$mod1 = $_POST['val1'];
	$mod2 = $_POST['val2'];
	$mod3 = $_POST['val3'];
	$mod4 = $_POST['val4'];
	$id = $_SESSION['contratoActual'];
	$nContrato = $_SESSION['numeroContrato'];

	$sql = "UPDATE documentacion_contrato SET 
		OBS_1='$obs1', 
		OBS_2='$obs2', 
		OBS_3='$obs3', 
		OBS_4='$obs4', 
		VAL_1='$mod1', 
		VAL_2='$mod2', 
		VAL_3='$mod3', 
		VAL_4='$mod4'
		WHERE ID_OC='$id'";
	mysql_query($sql,$con);


	$sql = "SELECT ec.N_FANTASIA FROM empresa_contratista ec, orden_contrato oc
	WHERE oc.ID_OC = '$id' AND 
	oc.ID_CONTRATISTA = ec.ID_CONTRATISTA";



	$respuesta = mysql_query($sql,$con);
	if($fila = mysql_fetch_array($respuesta)){
		$nombreEmpresa = $fila['N_FANTASIA'];
	}

	//ENVÍO DE CORREO A PERSONA RESPONSABLE DE REVISION DE PERSONAL
	$header = 'From: ' . "Chilecop Administracion <acreditacion@chilecop.cl> \r\n";
	$header .= "cc: informatica@chilecop.cl \r\n";
	$header .= "cc: s.kunz@chilecop.cl \r\n";
	$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
	$header .= "Mime-Version: 1.0 \r\n";
	$header .= "Content-Type:  text/html\r\n";

	$html = "Hemos recibido satisfactoriamente la actualización documentaria de contrato de la empresa <b>" . $nombreEmpresa . "</b>: <br><br>
	<b>Empresa:</b> " . $nombreEmpresa . "<br>
	<b>Número Contrato:</b> " . $nContrato . "<br>

	<b>Documentos actualizados:</b><br><br>";

	if(isset($_SESSION['docContrato1Refresh']))
			$html .= "Documento 1: " . $_SESSION['docContrato1Refresh'] . "<br>";
	if(isset($_SESSION['docContrato2Refresh']))
			$html .= "Documento 2: " . $_SESSION['docContrato2Refresh'] . "<br>";
	if(isset($_SESSION['docContrato3Refresh']))
			$html .= "Documento 3: " . $_SESSION['docContrato3Refresh'] . "<br>";
	if(isset($_SESSION['docContrato4Refresh']))
			$html .= "Documento 4: " . $_SESSION['docContrato4Refresh'] . "<br>";

	$html .= "<a taget= '_blank' href='http://www.chilecop.cl/acreditacion/documentacionContrato.php?id=" . $id . "'>Documentación Contrato " . $nContrato . " de Empresa " . $nombreEmpresa . "</a>";

	unset($_SESSION['docContrato1Refresh']);
	unset($_SESSION['docContrato2Refresh']);
	unset($_SESSION['docContrato3Refresh']);
	unset($_SESSION['docContrato4Refresh']);

	$asunto = $nombreEmpresa . " - " . $numeroContrato;
	$para = "acreditacion@chilecop.cl";
	//COMPOSICIÓN DEL CORREO
	mail($para, $asunto, utf8_decode($html), $header);
	$_SESSION['mensajeAlerta'] = "Documentación almacenada correctamente. Contrato enviado a revisión.";
	echo $nContrato;
?>