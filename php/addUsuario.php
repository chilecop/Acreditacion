<?php
	include('conexion.php');
	$nombre = $_POST['nombre'];		
	$rut = $_POST['rut'];
	$email = $_POST['email'];
	$contrasena = $_POST['contrasena'];
	$id_contratista = $_POST['id_contratista'];        
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$sql = "INSERT INTO usuario (id_tipo, id_contratista, rut, nombre_usuario, mail, f_registro, clave) VALUES ('3', '$id_contratista', '$rut', '$nombre', '$email', now(), '$contrasena')";
	mysql_query($sql,$con);

	
	header("location: http://www.chilecop.cl/acreditacion/listarUsuarios.php?id=$id_contratista&msg=1");
	mysql_close($con);
?>