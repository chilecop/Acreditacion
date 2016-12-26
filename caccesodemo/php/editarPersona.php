<?php
	include('conexion.php');
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$rut = $_POST['rut'];
	$id_empresa = $_POST['id_empresa'];
	$cargo = $_POST['cargo'];
	$con = conectarse();
	$sql = "UPDATE personal SET nombre_personal = '$nombre', rut_personal='$rut', cargo='$cargo', empresa='$id_empresa' WHERE id_personal='$id'";
	mysql_set_charset("utf8",$con);
	mysql_query($sql, $con);
	mysql_close($con);
	header("Location: http://www.chilecop.cl/joyglobal/personalActivo.php");
?>