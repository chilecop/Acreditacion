<?php
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
	$terminopase = $_POST['terminopase'];                 
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$sql = "INSERT INTO personal_acreditado (id_estado, id_orden_contrato, rut, nombres, apellidos, f_nacimiento, id_sexo, nacionalidad, id_visa, procedencia, cargo, direccion, fono_emergencia, id_tipo_contrato, id_tipo_pase, id_tipo_turno, region_id, fechainicio, fechatermino, iniciopase, terminopase, id_sector, fVencVisa, f_registro) VALUES ('3', '$idcontrato', '$rut', '$nombre', '$apellidos', '$fnac', '$sexo', '$nacionalidad', '$id_visa', '$procedencia','$cargo', '$direccion', '$fono', '$id_tipo_contrato','$id_tipo_pase','$id_tipo_turno','$region_id','$fechainicio','$fechatermino','$iniciopase','$terminopase','$id_sector', '$fVencVisa', now())";
	mysql_query($sql,$con);

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
	header("location: http://www.chilecop.cl/acreditacion/listarPersonal.php?id=$idcontrato&msg=1");
	mysql_close($con);
?>