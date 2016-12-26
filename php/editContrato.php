<?php
	include('conexion.php');
	$id = $_POST['id'];
	$fechaInicio = $_POST['fechainicio'];		
	$fechaTermino = $_POST['fechatermino'];
	$inicioJornada = $_POST['iniciojornada'];
	$terminoJornada = $_POST['terminojornada'];
	$sernageomin = $_POST['sernageomin'];
	$fechamutual = $_POST['fechamutual'];
	$ncontrato = $_POST['ncontrato'];
	$descripcion = $_POST['descripcion'];   
	$n_contacto = $_POST['n_contacto'];  
	$fono = $_POST['fono'];  
	$email = $_POST['email'];    
	$jexcepcional = $_POST['jexcepcional']; 
	$tjornada = $_POST['tjornada'];     
	$nresolucion = $_POST['nresolucion'];       
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$sql = "UPDATE orden_contrato SET F_INICIO='$fechaInicio', F_TERMINO='$fechaTermino', F_INICIO_JORNADA='$inicioJornada', F_TERMINO_JORNADA='$terminoJornada', F_PRESENTACION_SERNAGEOMIN='$sernageomin', F_AFILIACION_MUTUAL='$fechamutual', N_CONTRATO='$ncontrato', DESCRIPCION_CONTRATO='$descripcion', ADMINISTRADOR_CONTRATO='$n_contacto', FONO='$fono', MAIL='$email', JORNADA_EXCEPCIONAL='$jexcepcional', TIPO_JORNADA='$tjornada', N_RESOLUCION='$nresolucion' WHERE ID_OC='$id'";
	mysql_query($sql,$con);
	header('location: http://www.chilecop.cl/acreditacion/listarContratos.php');
	mysql_close($con);
?>