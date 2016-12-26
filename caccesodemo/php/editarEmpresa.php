<?php
	include('conexion.php');
	$id= $_POST['id'];
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
	$sql = "UPDATE empresas SET nombre_empresa = '$nombre', rut_empresa = '$rut', giro='$giro', direccion='$direccion', ciudad='$ciudad', representante='$representante', email='$email', tipojornada='$jornada', otrajornada='$jornada2', iniciocontrato='$icontrato', terminocontrato='$tcontrato', contactoemergencia='$contacto', telefonoemergencia='$telefono' WHERE id_empresa='$id'";
	mysql_query($sql,$con);
	header('location: http://www.chilecop.cl/caccesodemo/verEmpresa.php?id=' . $id);
	mysql_close($con);
?>