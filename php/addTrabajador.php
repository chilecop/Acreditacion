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
	$jornada = $_POST['id_registro'];
	$empresa = $_POST['empresa'];
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$contratista = $_SESSION["idContratista"];
	$idUser = $_SESSION["idUser"];

	/**
	* Antes de ingresar un trabajador, buscamos la caducidad del contrato
	* y así se define el termino de pase con la misma fecha de este
	*/
	$sql = "SELECT oc.F_TERMINO, pa.RUT FROM orden_contrato oc, personal_acreditado pa WHERE ID_OC='$idcontrato' AND pa.RUT='$rut'";
	$resultado = mysql_query($sql,$con);
	$fila = mysql_fetch_array($resultado);

	if(!$fila['RUT']){	

		$sql = "INSERT INTO personal_acreditado (id_estado, id_orden_contrato, rut, nombres, apellidos, f_nacimiento, id_sexo, nacionalidad, id_visa, procedencia, cargo, direccion, fono_emergencia, id_tipo_contrato, id_tipo_pase, id_tipo_turno, region_id, fechainicio, fechatermino, terminopase, id_sector, fVencVisa, f_registro, tipo_jornada) VALUES ('3', '$idcontrato', '$rut', '$nombre', '$apellidos', '$fnac', '$sexo', '$nacionalidad', '$id_visa', '$procedencia','$cargo', '$direccion', '$fono', '$id_tipo_contrato','$id_tipo_pase','$id_tipo_turno','$region_id', '$fechainicio', '$fechatermino','". $fila['F_TERMINO'] . "','$id_sector', '$fVencVisa', now(), '$jornada')";
		$resultado = mysql_query($sql,$con);
		$sql = "INSERT INTO estado_trabajador_historial (ID_ACREDITADO) VALUES ()";

		if($resultado){
			//CREACIÓN DE LA CARPETA PARA LOS ARCHIVOS CORRESPONDIENTES
			$directorio = "../archivos/" . $rut;
			mkdir($directorio, 0777);

			/**
			 * CREACIÓN DE LA INSTANCIA PARA LA DOCUMENTACIÓN Y ESTADO TRABAJADOR
			 */		
			//PRIMERO CAPTURAMOS EL ID DEL RECIEN INSERTADO
			$sql = "SELECT ID_ACREDITADO FROM personal_acreditado GROUP BY ID_ACREDITADO DESC LIMIT 1";
			$resultado = mysql_query($sql,$con);
			$fila = mysql_fetch_array($resultado);
			$acreditado = $fila['ID_ACREDITADO'];
			//AHORA CREAMOS LA INSTANCIA	
			$sql = "INSERT INTO estado_trabajador_historial (ID_ACREDITADO,FECHA) VALUES ($acreditado,now())";
			mysql_query($sql,$con);
			$sql = "INSERT INTO documentacion (ID_ACREDITADO) VALUES ($acreditado)"; 
			mysql_query($sql,$con);
			//REGISTRAR ACCION
			$sql = "INSERT INTO registro_acciones (ID_CONTRATISTA,ID_USUARIO,TIPO,REFERENCIA,ACCION,FECHAREGISTRO) VALUES ('$contratista','$idUser','Persona','$acreditado','Ingreso de Persona',now())";
			$resultado = mysql_query($sql,$con);
			//RETORNAMOS A LA PAGINA DE LOS CONTRATOS
			$_SESSION['mensajeAlerta'] = "Personal ingresado correctamente. Ahora, debe ingresar los documentos de " . $nombre . " " . $apellidos . ". Puede ingresarlos inmediatamente, o bien paulatinamente volviendo a esta ventana, sin embargo, al ingresar un documento, no podrá modificarlo posteriormete.";
			header("location: http://www.chilecop.cl/acreditacion/documentacionPersonal.php?id=$acreditado");
			mysql_close($con);
		}else{
			header("location: http://www.chilecop.cl/acreditacion/listarPersonal.php?id=$idcontrato");
		}
	}else{
		$_SESSION['mensajeAlerta']="Persona con rut " . $rut . " ya existente.";
		if($empresa){
			header("location: http://www.chilecop.cl/acreditacion/ingresarTrabajador2.php?id=$idcontrato");
		}else{
			header("location: http://www.chilecop.cl/acreditacion/ingresarTrabajador.php?id=$idcontrato");
		}		
	}
?>