<?php
	include('conexion.php');
	$idcontratista = $_POST['idcontratista'];		
	$fechainicio = $_POST['fechainicio'];
	$fechatermino = $_POST['fechatermino'];
	$iniciojornada = $_POST['iniciojornada'];
	$email = $_POST['email'];
	$terminojornada = $_POST['terminojornada'];
	$sernageomin = $_POST['sernageomin'];
	$fechamutual = $_POST['fechamutual'];
	$ncontrato = $_POST['ncontrato'];
	$nombre = $_POST['nombre'];
	$n_contacto = $_POST['n_contacto'];
	$fono = $_POST['fono'];
	$jexcepcional = $_POST['jexcepcional']; 
	$tjornada = $_POST['tjornada']; 
	$nresolucion = $_POST['nresolucion'];               
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$sql = "INSERT INTO orden_contrato (id_contratista, f_inicio, f_termino, f_inicio_jornada, f_termino_jornada, f_presentacion_sernageomin, f_afiliacion_mutual, n_contrato,descripcion_contrato, administrador_contrato, fono, mail, jornada_excepcional, tipo_jornada, n_resolucion, f_registro) VALUES ('$idcontratista', '$fechainicio', '$fechatermino', '$iniciojornada', '$terminojornada', '$sernageomin', '$fechamutual', '$ncontrato','$nombre', '$n_contacto', '$fono','$email','$jexcepcional','$tjornada','$nresolucion', now())";
	mysql_query($sql,$con);
	header('location: http://www.chilecop.cl/acreditacion/listarContratos.php');
	mysql_close($con);
?>