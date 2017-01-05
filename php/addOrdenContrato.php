<?php
	session_start();
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

	/**
	* Verificar duplicidad en el numero de contrato
	*/
	$sql = "SELECT N_CONTRATO FROM orden_contrato WHERE N_CONTRATO='$ncontrato'";
	$resultado = mysql_query($sql,$con);
	$fila = mysql_fetch_array($resultado);
	if($fila['N_CONTRATO']!=$ncontrato){
		$sql = "INSERT INTO orden_contrato (id_contratista, f_inicio, f_termino, f_inicio_jornada, f_termino_jornada, f_presentacion_sernageomin, f_afiliacion_mutual, n_contrato,descripcion_contrato, administrador_contrato, fono, mail, jornada_excepcional, tipo_jornada, n_resolucion, f_registro) VALUES ('$idcontratista', '$fechainicio', '$fechatermino', '$iniciojornada', '$terminojornada', '$sernageomin', '$fechamutual', '$ncontrato','$nombre', '$n_contacto', '$fono','$email','$jexcepcional','$tjornada','$nresolucion', now())";
		$resultado = mysql_query($sql,$con);

		if($resultado){
			//CREACIÓN DE LA CARPETA PARA LOS ARCHIVOS CORRESPONDIENTES
			$directorio = "../archivoscontrato/" . $ncontrato;
			mkdir($directorio, 0777);


			/**
			 * CREACIÓN DE LA INSTANCIA PARA LA DOCUMENTACIÓN
			 */		
			//PRIMERO CAPTURAMOS EL ID DEL RECIEN INSERTADO
			$sql = "SELECT ID_OC FROM orden_contrato GROUP BY ID_OC DESC LIMIT 1";
			$resultado = mysql_query($sql,$con);
			$fila = mysql_fetch_array($resultado);
			$oc = $fila['ID_OC'];
			//AHORA CREAMOS LA INSTANCIA	
			$sql = "INSERT INTO documentacion_contrato (ID_OC) VALUES ($oc)"; 
			mysql_query($sql,$con);
			//RETORNAMOS A LA PAGINA DE LOS CONTRATOS
			$_SESSION['mensajeAlerta'] = "Contrato ingresado correctamente. Ahora, debe ingresar los documentos del contrato " . $ncontrato . ". Puede ingresarlos inmediatamente, o bien paulatinamente volviendo a esta ventana, sin embargo, al ingresar un documento, no podrá modificarlo posteriormete.";
			header("location: http://www.chilecop.cl/acreditacion/documentacionContrato.php?id=$oc");
			mysql_close($con);
		}else{
			header("location: http://www.chilecop.cl/acreditacion/listarContratos.php");
		}
	}else{
		$_SESSION['mensajeAlerta'] = "El número de contrato ya existe.";
		echo '
			<script type="text/javascript">
				history.back();
			</script>';
		mysql_close($con);
	}
	mysql_close($con);
?>