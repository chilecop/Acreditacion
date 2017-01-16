<?php
	session_start();
	include('conexion.php');
	$id=$_POST['id'];
	$nombre = $_POST['nombre'];
	$rut = $_POST['rut'];
	$apellidos = $_POST['apellidos'];
	$fnac = $_POST['fnac'];
	$sexo = $_POST['sexo'];
	$nacionalidad = $_POST['nacionalidad'];
	$visa = $_POST['id_visa'];
	$procedencia = $_POST['procedencia'];
	$cargo = $_POST['cargo'];
	$direccion = $_POST['direccion'];
	$fono = $_POST['fono'];
	$alergias = $_POST['alergias'];
	$id_grupo_sanguineo = $_POST['id_grupo_sanguineo'];
	$id_tipo_pase = $_POST['id_tipo_pase'];
	$id_tipo_turno = $_POST['id_tipo_turno'];
	$tipocontrato = $_POST['id_tipo_contrato'];
	$fvencvisa = $_POST['fvencvisa'];
	$regionid = $_POST['region_id'];
	$fechainicio = $_POST['fechainicio'];
	$fechatermino = $_POST['fechatermino'];
	$iniciopase = $_POST['iniciopase'];
	$terminopase = $_POST['terminopase'];
	$sector = $_POST['id_sector'];

	$con = conectarse();
	mysql_set_charset("utf8",$con);

	$sql = "
	UPDATE personal_acreditado 
	SET 
	nombres='$nombre', 
	apellidos='$apellidos', 
	f_nacimiento='$fnac', 
	id_sexo='$sexo', 
	nacionalidad='$nacionalidad', 
	id_visa='$visa', 
	procedencia='$procedencia', 
	cargo='$cargo', 
	direccion='$direccion', 
	fono_emergencia='$fono', 
	alergias='$alergias', 
	id_grupo_sanguineo='$id_grupo_sanguineo', 
	id_tipo_pase='$id_tipo_pase', 
	id_tipo_turno='$id_tipo_turno', 
	f_registro='now()', 
	fvencvisa='$fvencvisa', 
	region_id='$regionid', 
	id_tipo_contrato='$tipocontrato',
	fechainicio = '$fechainicio',
	fechatermino = '$fechatermino',
	id_sector = '$sector'
	WHERE 
	id_acreditado='$id'";
	mysql_query($sql,$con);

	//REGISTRAR ACCION
	$contratista = $_SESSION["idContratista"];
	$idUser = $_SESSION["idUser"];
	$sql = "INSERT INTO registro_acciones (ID_CONTRATISTA,ID_USUARIO,TIPO,REFERENCIA,ACCION,FECHAREGISTRO) VALUES ('$contratista','$idUser','Persona','$id','Edición de Persona',now())";
	$resultado = mysql_query($sql,$con);

	header("location: http://www.chilecop.cl/acreditacion/editarPersonal.php?id=$id");
	mysql_close($con);
?>