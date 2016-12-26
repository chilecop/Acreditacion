<?php
	include('conexion.php');
	$con = conectarse();
	$id = $_POST['id'];
	$patente = $_POST['patente'];
	$marca = $_POST['marca'];
	$modelo = $_POST['modelo'];
	$tipo = $_POST['tipo'];
	$color = $_POST['color'];
	$anio = $_POST['anio'];
	$conductor = $_POST['rut'];
	$sql = "SELECT * FROM personal WHERE rut_personal='$conductor'";
	mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
	if($fila = mysql_fetch_array($resultado)){
		$sql = "SELECT * FROM vehiculo WHERE patente='$patente' AND id<>'$id'";
		$resultado = mysql_query($sql,$con);
		if(!($fila = mysql_fetch_array($resultado))){
			$sql = "UPDATE vehiculo SET patente='$patente', conductor='$conductor', marca='$marca', modelo='$modelo', color='$color', anio='$anio', tipo='$tipo' WHERE id='$id'";
			mysql_query($sql,$con);
			mysql_close($con);
			echo 'ok';
		}else{
			echo 'El vehiculo patente ' . $fila['patente'] . ' ya se encuentra en la base de datos.';
		}
	}else{
		echo 'No se encuentra el rut ' . $conductor . ' dentro del personal.';
	}
?>