<?php
	include('conexion.php');
	session_start();
	$con = conectarse();
	$mod1 = $_POST['val1'];
	$mod2 = $_POST['val2'];
	$mod3 = $_POST['val3'];
	$mod4 = $_POST['val4'];
	$mod5 = $_POST['val5'];
	$mod6 = $_POST['val6'];
	$mod7 = $_POST['val7'];
	$mod8 = $_POST['val8'];
	$mod9 = $_POST['val9'];
	$mod10 = $_POST['val10'];
	$id = $_SESSION['idEmpresaActual'];

	$sql = "UPDATE documentacion_contratista SET VAL1='$mod1', VAL2='$mod2', VAL3='$mod3', VAL4='$mod4', VAL5='$mod5', VAL6='$mod6' , VAL7='$mod7' , VAL8='$mod8' , VAL9='$mod9' , VAL10='$mod10' WHERE ID_CONTRATISTA='$id'";
	mysql_query($sql,$con);

	$sql = "SELECT N_FANTASIA
	FROM empresa_contratista
	WHERE ID_CONTRATISTA='$id'";

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

	$html = "Hemos recibido satisfactoriamente la actualización documentaria de la empresa <b>" . $nombreEmpresa . "</b>: <br><br>
	<b>Empresa:</b> " . $nombreEmpresa . "<br>

	<b>Documentos actualizados:</b><br><br>";

	if(isset($_SESSION['docEmpresa1Refresh']))
			$html .= "Documento 1: " . $_SESSION['docEmpresa1Refresh'] . "<br>";
	if(isset($_SESSION['docEmpresa2Refresh']))
			$html .= "Documento 2: " . $_SESSION['docEmpresa2Refresh'] . "<br>";
	if(isset($_SESSION['docEmpresa3Refresh']))
			$html .= "Documento 3: " . $_SESSION['docEmpresa3Refresh'] . "<br>";
	if(isset($_SESSION['docEmpresa4Refresh']))


			$html .= "Documento 4: " . $_SESSION['docEmpresa4Refresh'] . "<br>";
	if(isset($_SESSION['docEmpresa5Refresh']))
			$html .= "Documento 5: " . $_SESSION['docEmpresa5Refresh'] . "<br>";
	if(isset($_SESSION['docEmpresa6Refresh']))
			$html .= "Documento 6: " . $_SESSION['docEmpresa6Refresh'] . "<br>";
	if(isset($_SESSION['docEmpresa7Refresh']))
			$html .= "Documento 7: " . $_SESSION['docEmpresa7Refresh'] . "<br>";
	if(isset($_SESSION['docEmpresa8Refresh']))
			$html .= "Documento 8: " . $_SESSION['docEmpresa8Refresh'] . "<br>";
	if(isset($_SESSION['docEmpresa9Refresh']))
			$html .= "Documento 9: " . $_SESSION['docEmpresa9Refresh'] . "<br>";
	if(isset($_SESSION['docEmpresa10Refresh']))
			$html .= "Documento 10: " . $_SESSION['docEmpresa10Refresh'] . "<br>";

	$html .= "<a taget= '_blank' href='http://www.chilecop.cl/acreditacion/documentacionEmpresa.php?id=" . $id . "'>Documentación Empresa " . $nombreEmpresa . "</a>";

	unset($_SESSION['docEmpresa1Refresh']);
	unset($_SESSION['docEmpresa2Refresh']);
	unset($_SESSION['docEmpresa3Refresh']);
	unset($_SESSION['docEmpresa4Refresh']);
	unset($_SESSION['docEmpresa5Refresh']);
	unset($_SESSION['docEmpresa6Refresh']);
	unset($_SESSION['docEmpresa7Refresh']);
	unset($_SESSION['docEmpresa8Refresh']);
	unset($_SESSION['docEmpresa9Refresh']);
	unset($_SESSION['docEmpresa10Refresh']);

	$asunto = $nombreEmpresa . " - " . $numeroContrato . " - " . $nombrePersona;
	$para = "acreditacion@chilecop.cl";
	//COMPOSICIÓN DEL CORREO
	mail($para, $asunto, utf8_decode($html), $header);
	$_SESSION['mensajeAlerta'] = "Documentación almacenada correctamente. Empresa enviada a revisión.";
	echo $fila['ID_OC'];
?>