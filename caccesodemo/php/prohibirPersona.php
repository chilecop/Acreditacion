<?php
	include('conexion.php');
	$nombre = $_POST['nombre'];
	$rut = $_POST['rut'];
	$motivo = $_POST['motivo'];
	$id = $_POST['id'];
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$sql = "INSERT INTO prohibiciones (n_prohibicion, r_prohibicion, razon) VALUES ('$nombre', '$rut', '$motivo')";
	mysql_query($sql,$con);
	mysql_close($con);
	header('location: http://www.chilecop.cl/joyglobal/prohibiciones.php');
?>