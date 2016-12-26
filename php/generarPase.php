<?php
	include('conexion.php');
	$nombre = $_POST['nombre'];
	$rut = $_POST['rut'];
	$empresa = $_POST['empresa'];
	$fechainicio = $_POST['fechainicio'];
	$fechatermino = $_POST['fechatermino'];

	$con = conectarse();
	mysql_set_charset("utf8",$con);
    $sql="INSERT INTO pasesDiarios (nombre,rut,empresa,fechaInicio,fechaTermino) VALUES ('$nombre','$rut','$empresa','$fechainicio','$fechatermino')";
    $resultado = mysql_query($sql,$con);
    header("location: http://www.chilecop.cl/acreditacion/pasesDiarios.php");
?>