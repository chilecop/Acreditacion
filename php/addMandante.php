<?php
	include('conexion.php');
	$nombre = $_POST['nombre'];		
	$rut = $_POST['rut'];
	$n_contacto = $_POST['n_contacto'];
	$representante = $_POST['representante'];
	$email = $_POST['email'];
	$observacion = $_POST['observacion'];
	$fono = $_POST['fono'];                  
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$sql = "INSERT INTO mandante (n_fantasia, rut, n_contacto, fono, representante, mail, observacion) VALUES ('$nombre', '$rut', '$n_contacto', '$fono', '$representante', '$email', '$observacion')";
	mysql_query($sql,$con);
	header('location: http://www.chilecop.cl/acreditacion/ingresarMandante.php');
	mysql_close($con);
?>