<?php
	include('conexion.php');
	$nombre = $_POST['nombre'];		
	$rut = $_POST['rut'];
	$giro = $_POST['giro'];	
	$direccion = $_POST['direccion'];
	$ciudad = $_POST['ciudad'];
	$representante = $_POST['representante'];
	$email = $_POST['email'];
	$jornada = $_POST['jornada1'];
	$jornada2 = $_POST['jornada2'];
	$icontrato = $_POST['icontrato'];
	$tcontrato = $_POST['tcontrato'];
	$contacto = $_POST['contacto'];
	$telefono = $_POST['telefono'];                  
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$sql = "INSERT INTO empresas (nombre_empresa, rut_empresa, giro, direccion, ciudad, representante, email, tipojornada, otrajornada, iniciocontrato, terminocontrato, contactoemergencia, telefonoemergencia) VALUES ('$nombre', '$rut', '$giro', '$direccion', '$ciudad', '$representante', '$email', '$jornada', '$jornada2','$icontrato','$tcontrato','$contacto','$telefono')";
	mysql_query($sql,$con);
	header('location: http://www.chilecop.cl/caccesodemo/ingresarEmpresa.php');
	mysql_close($con);
?>