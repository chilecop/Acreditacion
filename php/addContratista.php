<?php
	include('conexion.php');
	$nombre = $_POST['nombre'];		
	$rut = $_POST['rut'];
	$n_contacto = $_POST['n_contacto'];
	$representante = $_POST['representante'];
	$email = $_POST['email'];
	$responsable = $_POST['responsable'];
	$emailresponsable = $_POST['emailresponsable'];
	$direccion = $_POST['direccion'];
	$direccion_sucursal = $_POST['direccion_sucursal'];
	$mutualidad = $_POST['mutualidad'];
	$ccompensacion = $_POST['ccompensacion'];
	$observacion = $_POST['observacion'];
	$fono = $_POST['fono'];   
	$contratista = $_POST['ID_CONTRATISTA'];           
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$sql = "INSERT INTO empresa_contratista (n_fantasia, fono, rut, n_contacto, rep, mail_contacto, d_casa_matriz, d_sucursal, observacion, mutualidad, c_compensacion, f_registro, responsable, mail_responsable) VALUES ('$nombre', '$fono', '$rut', '$n_contacto', '$representante', '$email', '$direccion', '$direccion_sucursal','$observacion', '$mutualidad', '$ccompensacion', now(),'$responsable','$emailresponsable')";
	mysql_query($sql,$con);

	if($contratista!=0){
		//Localizar id Empresa recien ingresada
		$sql = "SELECT ID_CONTRATISTA FROM empresa_contratista ORDER BY ID_CONTRATISTA DESC LIMIT 1";
		$resultado = mysql_query($sql,$con);
		$fila = mysql_fetch_row($resultado);
		$idSubContratista = $fila[0];
		$sql = "INSERT INTO subcontratos (ID_CONTRATISTA, ID_SUBCONTRATISTA) VALUES ('$contratista','$idSubContratista')";
		$resultado = mysql_query($sql,$con);
	}

	
	//CREACIÓN DE LA CARPETA PARA LOS ARCHIVOS CORRESPONDIENTES
	$directorio = "../archivoseecc/" . $rut;
	mkdir($directorio, 0777);
	/**
	 * CREACIÓN DE LA INSTANCIA PARA LA DOCUMENTACIÓN
	 */
	
	//PRIMERO CAPTURAMOS EL ID DEL RECIEN INSERTADO
	$sql = "SELECT ID_CONTRATISTA FROM empresa_contratista GROUP BY ID_CONTRATISTA DESC LIMIT 1";
	$resultado = mysql_query($sql,$con);
	$fila = mysql_fetch_array($resultado);
	$dempresa = $fila['ID_CONTRATISTA'];
	//AHORA CREAMOS LA INSTANCIA
	$sql = "INSERT INTO documentacion_contratista (ID_CONTRATISTA) VALUES ($dempresa)"; 
	mysql_query($sql,$con);
	//RETORNAMOS A LA PAGINA DE LOS CONTRATOS
	header('location: http://www.chilecop.cl/acreditacion/listarContratistas.php');
	mysql_close($con);
?>