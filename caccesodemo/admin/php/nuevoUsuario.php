<?php
	include('conexion.php');
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$user = $_POST['usuario'];
	$password = $_POST['password'];
	$sql = "INSERT INTO login VALUES('$user',AES_ENCRYPT('$password','Alfredo116998'))";
	//INSERT INTO usuarios VALUES('usuario',AES_DECRYPT('contraseña','llave'));
	mysql_query($sql,$con);
	mysql_close($con);
	header('location: http://www.chilecop.cl/joyglobal/admin/nuevoUsuario.php');
?>