<?php
	include('conexion.php');
	$id=$_POST['id'];
	$nombre = $_POST['nombre'];		
	$rut = $_POST['rut'];
	$apellidos = $_POST['apellidos'];
	$fnac = $_POST['fnac'];
	$sexo = $_POST['sexo'];
	$nacionalidad = $_POST['nacionalidad'];
	$visa = $_POST['visa'];
	$procedencia = $_POST['procedencia'];
	$cargo = $_POST['cargo'];
	$direccion = $_POST['direccion'];
	$fono = $_POST['fono'];
	$alergias = $_POST['alergias']; 
	$id_grupo_sanguineo = $_POST['id_grupo_sanguineo']; 
	$id_tipo_pase = $_POST['id_tipo_pase']; 
	$id_tipo_turno = $_POST['id_tipo_turno'];                 
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$sql = "UPDATE personal_acreditado SET RUT='$rut', nombres='$nombre', apellidos='$apellidos', f_nacimiento='$fnac', id_sexo='$sexo', nacionalidad='$nacionalidad', visa='$visa', procedencia='$procedencia', cargo='$cargo', direccion='$direccion', fono_emergencia='$fono', alergias='$alergias', id_grupo_sanguineo='$id_grupo_sanguineo', id_tipo_pase='$id_tipo_pase', id_tipo_turno='$id_tipo_turno', f_registro='now()' WHERE id_acreditado='$id'";
	mysql_query($sql,$con);
	header("location: http://www.chilecop.cl/acreditacion/editarPersonal.php?id=$id");
	mysql_close($con);
?>