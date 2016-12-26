<?php
	include('conexion.php');
	$id = $_POST['id'];
	$con = conectarse();
	$sql = "DELETE FROM prohibiciones WHERE id_prohibicion='$id'";
	mysql_query($sql,$con);
	mysql_query($con);
	header('location: http://www.chilecop.cl/joyglobal/prohibiciones.php');
?>