<?php
	include('conexion.php');
	session_start();
	$con = conectarse();
	$mod1 = $_POST['val1'];
	$mod2 = $_POST['val2'];
	$mod3 = $_POST['val3'];
	$mod4 = $_POST['val4'];
	$mod5 = $_POST['val5'];
	$mod6 = $_POST['val6'];
	$mod7 = $_POST['val7'];
	$mod8 = $_POST['val8'];
	$mod9 = $_POST['val9'];
	$mod10 = $_POST['val10'];
	$id = $_SESSION['idEmpresaActual'];

	$sql = "UPDATE documentacion_contratista SET VAL1='$mod1', VAL2='$mod2', VAL3='$mod3', VAL4='$mod4', VAL5='$mod5', VAL6='$mod6' , VAL7='$mod7' , VAL8='$mod8' , VAL9='$mod9' , VAL10='$mod10' WHERE ID_CONTRATISTA='$id'";
	mysql_query($sql,$con);
	echo "Documentación almacenada correctamente.";
?>