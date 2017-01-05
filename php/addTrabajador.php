<?php
	session_start();
	include('conexion.php');
	$idcontrato = $_POST['idcontrato'];
	$nombre = $_POST['nombre'];		
	$rut = $_POST['rut'];
	$apellidos = $_POST['apellidos'];
	$fnac = $_POST['fnac'];
	$fVencVisa = $_POST['fVencVisa'];
	$sexo = $_POST['sexo'];
	$nacionalidad = $_POST['nacionalidad'];
	$procedencia = $_POST['procedencia'];
	$cargo = $_POST['cargo'];
	$direccion = $_POST['direccion'];
	$region_id = $_POST['region_id'];
	$fono = $_POST['fono']; 
	$id_tipo_contrato = $_POST['id_tipo_contrato']; 
	$id_tipo_pase = $_POST['id_tipo_pase']; 
	$id_tipo_turno = $_POST['id_tipo_turno'];
	$id_visa = $_POST['id_visa'];
	$id_sector = $_POST['id_sector'];
	$fechainicio = $_POST['fechainicio'];
	$fechatermino = $_POST['fechatermino'];
	$iniciopase = $_POST['iniciopase'];
	$jornada = $_POST['jornada'];
	$con = conectarse();
	mysql_set_charset("utf8",$con);

	/**
	* Antes de ingresar un trabajador, buscamos la caducidad del contrato
	* y así se define el termino de pase con la misma fecha de este
	*/
	$sql = "SELECT F_TERMINO FROM orden_contrato WHERE ID_OC='$idcontrato'";
	$resultado = mysql_query($sql,$con);
	$fila = mysql_fetch_array($resultado);

	$sql = "INSERT INTO personal_acreditado (id_estado, id_orden_contrato, rut, nombres, apellidos, f_nacimiento, id_sexo, nacionalidad, id_visa, procedencia, cargo, direccion, fono_emergencia, id_tipo_contrato, id_tipo_pase, id_tipo_turno, region_id, fechainicio, fechatermino, terminopase, id_sector, fVencVisa, f_registro, tipo_jornada) VALUES ('3', '$idcontrato', '$rut', '$nombre', '$apellidos', '$fnac', '$sexo', '$nacionalidad', '$id_visa', '$procedencia','$cargo', '$direccion', '$fono', '$id_tipo_contrato','$id_tipo_pase','$id_tipo_turno','$region_id', '$fechainicio', '$fechatermino','". $fila['F_TERMINO'] . "','$id_sector', '$fVencVisa', now(), '$jornada')";
	$resultado = mysql_query($sql,$con);

	if($resultado){
		//CREACIÓN DE LA CARPETA PARA LOS ARCHIVOS CORRESPONDIENTES
		$directorio = "../archivos/" . $rut;
		mkdir($directorio, 0777);


		/**
		 * CREACIÓN DE LA INSTANCIA PARA LA DOCUMENTACIÓN
		 */		
		//PRIMERO CAPTURAMOS EL ID DEL RECIEN INSERTADO
		$sql = "SELECT ID_ACREDITADO FROM personal_acreditado GROUP BY ID_ACREDITADO DESC LIMIT 1";
		$resultado = mysql_query($sql,$con);
		$fila = mysql_fetch_array($resultado);
		$acreditado = $fila['ID_ACREDITADO'];
		//AHORA CREAMOS LA INSTANCIA	
		$sql = "INSERT INTO documentacion (ID_ACREDITADO) VALUES ($acreditado)"; 
		mysql_query($sql,$con);
		//RETORNAMOS A LA PAGINA DE LOS CONTRATOS
		$_SESSION['mensajeAlerta'] = "Personal ingresado correctamente. Ahora, debe ingresar los documentos de " . $nombre . " " . $apellidos . ". Puede ingresarlos inmediatamente, o bien paulatinamente volviendo a esta ventana, sin embargo, al ingresar un documento, no podrá modificarlo posteriormete.";
		header("location: http://www.chilecop.cl/acreditacion/documentacionPersonal.php?id=$acreditado");
		mysql_close($con);
	}else{
		header("location: http://www.chilecop.cl/acreditacion/listarPersonal.php?id=$idcontrato");
	}	
?>