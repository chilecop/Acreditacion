<?php
	include('conexion.php');
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];		
	$rut = $_POST['rut'];
	$n_contacto = $_POST['n_contacto'];
	$representante = $_POST['representante'];
	$email = $_POST['email'];
	$observacion = $_POST['observacion'];
	$fono = $_POST['fono'];                  
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$sql = "UPDATE mandante SET RUT='$rut', N_FANTASIA='$nombre', N_CONTACTO='$n_contacto', OBSERVACION='$observacion', FONO='$fono', F_REGISTRO='NOW()', REPRESENTANTE='$representante', MAIL='$email' WHERE ID_MANDANTE='$id'";
	mysql_query($sql,$con);
	header('location: http://www.chilecop.cl/acreditacion/listarMandantes.php');
	mysql_close($con);
?>