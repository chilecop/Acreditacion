<?php
	include('conexion.php');
	session_start();
	$con = conectarse();
	$obs1 = $_POST['obs1'];
	$obs2 = $_POST['obs2'];
	$obs3 = $_POST['obs3'];
	$obs4 = $_POST['obs4'];
	$obs5 = $_POST['obs5'];
	$obs6 = $_POST['obs6'];
	$obs7 = $_POST['obs7'];
	$obs8 = $_POST['obs8'];
	$obs9 = $_POST['obs9'];
	$obs10 = $_POST['obs10'];
	$obs11 = $_POST['obs11'];
	$obs12 = $_POST['obs12'];
	$obs13 = $_POST['obs13'];
	$obs14 = $_POST['obs14'];
	$obs15 = $_POST['obs15'];
	$obs16 = $_POST['obs16'];
	$obs17 = $_POST['obs17'];
	$obs18 = $_POST['obs18'];
	$obs19 = $_POST['obs19'];
	$obs20 = $_POST['obs20'];
	$obs21 = $_POST['obs21'];
	$obs22 = $_POST['obs22'];
	$obs23 = $_POST['obs23'];

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
	$mod11 = $_POST['val11'];
	$mod12 = $_POST['val12'];
	$mod13 = $_POST['val13'];
	$mod14 = $_POST['val14'];
	$mod15 = $_POST['val15'];
	$mod16 = $_POST['val16'];
	$mod17 = $_POST['val17'];
	$mod18 = $_POST['val18'];
	$mod19 = $_POST['val19'];
	$mod20 = $_POST['val20'];
	$mod21 = $_POST['val21'];
	$mod22 = $_POST['val22'];
	$mod23 = $_POST['val23'];
	$id = $_SESSION['idTrabajadorActual'];

	$sql = "UPDATE documentacion SET 
		OBS_1='$obs1', 
		OBS_2='$obs2', 
		OBS_3='$obs3', 
		OBS_4='$obs4', 
		OBS_5='$obs5', 
		OBS_6='$obs6', 
		OBS_7='$obs7', 
		OBS_8='$obs8', 
		OBS_9='$obs9', 
		OBS_10='$obs10', 
		OBS_11='$obs11', 
		OBS_12='$obs12', 
		OBS_13='$obs13', 
		OBS_14='$obs14', 
		OBS_15='$obs15', 
		OBS_16='$obs16', 
		OBS_17='$obs17', 
		OBS_18='$obs18', 
		OBS_19='$obs19', 
		OBS_20='$obs20', 
		OBS_21='$obs21', 
		OBS_22='$obs22', 
		OBS_23='$obs23', 
		VAL_1='$mod1', 
		VAL_2='$mod2', 
		VAL_3='$mod3', 
		VAL_4='$mod4', 
		VAL_5='$mod5', 
		VAL_6='$mod6',
		VAL_7='$mod7',
		VAL_8='$mod8',
		VAL_9='$mod9',
		VAL_10='$mod10',
		VAL_11='$mod11',
		VAL_12='$mod12',
		VAL_13='$mod13',
		VAL_14='$mod14',
		VAL_15='$mod15',
		VAL_16='$mod16',
		VAL_17='$mod17',
		VAL_18='$mod18',
		VAL_19='$mod19',
		VAL_20='$mod20',
		VAL_21='$mod21',
		VAL_22='$mod22',
		VAL_23='$mod23'
		WHERE ID_ACREDITADO='$id'";
	mysql_query($sql,$con);


	$sql = "SELECT ec.N_FANTASIA, pa.NOMBRES, pa.APELLIDOS, oc.N_CONTRATO FROM personal_acreditado pa, empresa_contratista ec, orden_contrato oc
	WHERE pa.ID_ACREDITADO='$id' AND 
	pa.ID_ORDEN_CONTRATO = oc.ID_OC AND 
	oc.ID_CONTRATISTA = ec.ID_CONTRATISTA";

	$respuesta = mysql_query($sql,$con);
	if($fila = mysql_fetch_array($respuesta)){
		$nombreEmpresa = $fila['N_FANTASIA'];
		$nombrePersona = $fila['NOMBRES'] . " " . $fila['APELLIDOS'];
		$numeroContrato = $fila['N_CONTRATO'];
	}

	//ENVÍO DE CORREO A PERSONA RESPONSABLE DE REVISION DE PERSONAL
	$header = 'From: ' . "Chilecop Administracion <acreditacion@chilecop.cl> \r\n";
	$header .= "cc: j.lopez@chilecop.cl \r\n";
	$header .= "cc: s.kunz@chilecop.cl \r\n";
	$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
	$header .= "Mime-Version: 1.0 \r\n";
	$header .= "Content-Type:  text/html\r\n";

	$html = "Hemos recibido satisfactoriamente la actualización documentaria de la empresa <b>" . $nombreEmpresa . "</b>: <br><br>
	<b>Empresa:</b> " . $nombreEmpresa . "<br>
	<b>Número Contrato:</b> " . $numeroContrato . "<br>
	<b>Nombre Persona:</b> " . $nombrePersona . "<br><br>

	<b>Documentos actualizados:</b><br><br>";

	if(isset($_SESSION['doc1Refresh']))
			$html .= "Documento 1: " . $_SESSION['doc1Refresh'] . "<br>";
	if(isset($_SESSION['doc2Refresh']))
			$html .= "Documento 2: " . $_SESSION['doc2Refresh'] . "<br>";
	if(isset($_SESSION['doc3Refresh']))
			$html .= "Documento 3: " . $_SESSION['doc3Refresh'] . "<br>";
	if(isset($_SESSION['doc4Refresh']))
			$html .= "Documento 4: " . $_SESSION['doc4Refresh'] . "<br>";
	if(isset($_SESSION['doc5Refresh']))
			$html .= "Documento 5: " . $_SESSION['doc5Refresh'] . "<br>";
	if(isset($_SESSION['doc6Refresh']))
			$html .= "Documento 6: " . $_SESSION['doc6Refresh'] . "<br>";
	if(isset($_SESSION['doc7Refresh']))
			$html .= "Documento 7: " . $_SESSION['doc7Refresh'] . "<br>";
	if(isset($_SESSION['doc8Refresh']))
			$html .= "Documento 8: " . $_SESSION['doc8Refresh'] . "<br>";
	if(isset($_SESSION['doc9Refresh']))
			$html .= "Documento 9: " . $_SESSION['doc9Refresh'] . "<br>";
	if(isset($_SESSION['doc10Refresh']))
			$html .= "Documento 10: " . $_SESSION['doc10Refresh'] . "<br>";
	if(isset($_SESSION['doc11Refresh']))
			$html .= "Documento 11: " . $_SESSION['doc11Refresh'] . "<br>";
	if(isset($_SESSION['doc12Refresh']))
			$html .= "Documento 12: " . $_SESSION['doc12Refresh'] . "<br>";
	if(isset($_SESSION['doc13Refresh']))
			$html .= "Documento 13: " . $_SESSION['doc13Refresh'] . "<br>";
	if(isset($_SESSION['doc14Refresh']))
			$html .= "Documento 14: " . $_SESSION['doc14Refresh'] . "<br><br>";
	if(isset($_SESSION['doc15Refresh']))
			$html .= "Documento 15: " . $_SESSION['doc15Refresh'] . "<br><br>";
	if(isset($_SESSION['doc16Refresh']))
			$html .= "Documento 16: " . $_SESSION['doc16Refresh'] . "<br><br>";
	if(isset($_SESSION['doc17Refresh']))
			$html .= "Documento 17: " . $_SESSION['doc17Refresh'] . "<br><br>";
	if(isset($_SESSION['doc18Refresh']))
			$html .= "Documento 18: " . $_SESSION['doc18Refresh'] . "<br><br>";
	if(isset($_SESSION['doc19Refresh']))
			$html .= "Documento 19: " . $_SESSION['doc19Refresh'] . "<br><br>";
	if(isset($_SESSION['doc20Refresh']))
			$html .= "Documento 20: " . $_SESSION['doc20Refresh'] . "<br><br>";
	if(isset($_SESSION['doc21Refresh']))
			$html .= "Documento 21: " . $_SESSION['doc21Refresh'] . "<br><br>";
	if(isset($_SESSION['doc22Refresh']))
			$html .= "Documento 22: " . $_SESSION['doc22Refresh'] . "<br><br>";
	if(isset($_SESSION['doc23Refresh']))
			$html .= "Documento 23: " . $_SESSION['doc23Refresh'] . "<br><br>";

	$html .= "<a taget= '_blank' href='http://www.chilecop.cl/acreditacion/documentacionPersonal.php?id=" . $id . "'>Documentación " . $nombrePersona . "</a>";

	unset($_SESSION['doc1Refresh']);
	unset($_SESSION['doc2Refresh']);
	unset($_SESSION['doc3Refresh']);
	unset($_SESSION['doc4Refresh']);
	unset($_SESSION['doc5Refresh']);
	unset($_SESSION['doc6Refresh']);
	unset($_SESSION['doc7Refresh']);
	unset($_SESSION['doc8Refresh']);
	unset($_SESSION['doc9Refresh']);
	unset($_SESSION['doc10Refresh']);
	unset($_SESSION['doc11Refresh']);
	unset($_SESSION['doc12Refresh']);
	unset($_SESSION['doc13Refresh']);
	unset($_SESSION['doc14Refresh']);
	unset($_SESSION['doc15Refresh']);
	unset($_SESSION['doc16Refresh']);
	unset($_SESSION['doc17Refresh']);
	unset($_SESSION['doc18Refresh']);
	unset($_SESSION['doc19Refresh']);
	unset($_SESSION['doc20Refresh']);
	unset($_SESSION['doc21Refresh']);
	unset($_SESSION['doc22Refresh']);
	unset($_SESSION['doc23Refresh']);

	$asunto = $nombreEmpresa . " - " . $numeroContrato . " - " . $nombrePersona;
	$para = "acreditacion@chilecop.cl";
	//COMPOSICIÓN DEL CORREO
	mail($para, $asunto, utf8_decode($html), $header);
	
	echo "DOCUMENTACIÓN ALMACENADA CORRECTAMENTE.";
?>