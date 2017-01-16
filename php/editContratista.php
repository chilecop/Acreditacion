<?php
	session_start();
	include('conexion.php');
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];		
	$rut = $_POST['rut'];
	$n_contacto = $_POST['n_contacto'];
	$representante = $_POST['representante'];
	$email = $_POST['email'];
	$responsable = $_POST['responsable'];
	$emailresponsable = $_POST['emailresponsable'];
	$fono = $_POST['fono']; 
	$direccion = $_POST['direccion']; 
	$direccion_sucursal = $_POST['direccion_sucursal'];  
	$ccompensacion = $_POST['ccompensacion'];  
	$mutualidad = $_POST['mutualidad'];            
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$sql = "UPDATE empresa_contratista SET N_FANTASIA='$nombre', N_CONTACTO='$n_contacto', OBSERVACION='$observacion', FONO='$fono', F_REGISTRO='NOW()', REP='$representante', MAIL_CONTACTO='$email', C_COMPENSACION='$ccompensacion', MUTUALIDAD='$mutualidad', D_CASA_MATRIZ='$direccion', D_SUCURSAL='$direccion_sucursal', RESPONSABLE = '$responsable', MAIL_RESPONSABLE = '$emailresponsable' WHERE ID_CONTRATISTA='$id'";
	mysql_query($sql,$con);
	//REGISTRAR ACCION
	$contratista = $_SESSION["idContratista"];
	$idUser = $_SESSION["idUser"];
	$sql = "INSERT INTO registro_acciones (ID_CONTRATISTA,ID_USUARIO,TIPO,REFERENCIA,ACCION,FECHAREGISTRO) VALUES ('$contratista','$idUser','Empresa','$id','Edición de Empresa',now())";
	$resultado = mysql_query($sql,$con);

	header('location: http://www.chilecop.cl/acreditacion/verContratista.php?id='.$id);
	mysql_close($con);
?>