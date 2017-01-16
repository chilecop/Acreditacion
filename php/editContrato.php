<?php
	session_start();
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
	$sql = "UPDATE orden_contrato SET F_INICIO='$fechaInicio', F_TERMINO='$fechaTermino', F_INICIO_JORNADA='$inicioJornada', F_TERMINO_JORNADA='$terminoJornada', F_PRESENTACION_SERNAGEOMIN='$sernageomin', F_AFILIACION_MUTUAL='$fechamutual', DESCRIPCION_CONTRATO='$descripcion', ADMINISTRADOR_CONTRATO='$n_contacto', FONO='$fono', MAIL='$email', JORNADA_EXCEPCIONAL='$jexcepcional', TIPO_JORNADA='$tjornada', N_RESOLUCION='$nresolucion' WHERE ID_OC='$id'";
	mysql_query($sql,$con);

	//REGISTRAR ACCION
	$contratista = $_SESSION["idContratista"];
	$idUser = $_SESSION["idUser"];
	$sql = "INSERT INTO registro_acciones (ID_CONTRATISTA,ID_USUARIO,TIPO,REFERENCIA,ACCION,FECHAREGISTRO) VALUES ('$contratista','$idUser','Contrato','$id','Edición de Contrato',now())";
	mysql_query($sql,$con);

	//EMPRESA DEL CONTRATO
	$sql = "SELECT ID_CONTRATISTA FROM orden_contrato WHERE ID_OC='$id'";
	$resultado = mysql_query($sql,$con);
	$fila = mysql_fetch_array($resultado);
	$empresa = $fila['ID_CONTRATISTA'];

	//RETORNAMOS A LA PAGINA DE LOS CONTRATOS
	$_SESSION['mensajeAlerta'] = "Se ha editado correctamente el contrato N°" . $ncontrato . ".";
	header('location: http://www.chilecop.cl/acreditacion/listarContratos.php?id=' . $empresa);
	mysql_close($con);
?>