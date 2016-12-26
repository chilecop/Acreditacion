<?php
	include('conexion.php');
	$con = conectarse2();
	$patente = $_POST['patente'];
	$marca = $_POST['marca'];
	$modelo = $_POST['modelo'];
	$tipo = $_POST['tipo'];
	$color = $_POST['color'];
	$anio = $_POST['anio'];
	$rut = $_POST['rut'];
	$sql = "SELECT * FROM personal WHERE rut_personal='$rut'";
	mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
	if($fila = mysql_fetch_array($resultado)){
		$sql = "SELECT * FROM vehiculo WHERE patente='$patente'";
		$resultado = mysql_query($sql,$con);
		if(!($fila = mysql_fetch_array($resultado))){
			$sql = "INSERT INTO vehiculo (patente, conductor, marca, modelo, color, anio, tipo) VALUES ('$patente','$rut','$marca','$modelo','$color','$anio','$tipo')";
			mysql_query($sql,$con);
			mysql_close($con);
			echo 'ok';
		}else{
			echo 'El vehiculo patente ' . $patente . ' ya se encuentra en la base de datos.';
		}
	}else{
		echo 'No se encuentra el rut ' . $rut . ' dentro del personal.';
	}
?>