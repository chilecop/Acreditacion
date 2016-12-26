<?php
	include('conexion.php');
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	if($_POST['nombre'] && $_POST['rut'] && $_POST['id_empresa'] && $_POST['cargo']){
		$sql="INSERT INTO personal (nombre_personal,rut_personal,cargo,empresa) VALUES ('$_POST[nombre]','$_POST[rut]','$_POST[cargo]','$_POST[id_empresa]')";
		if (!mysql_query($sql,$con))
		{		
			header('Location: http://www.chilecop.cl/joyglobal/ingresarPersonal.php?error=si');
		}else{
			header('Location: http://www.chilecop.cl/joyglobal/ingresarPersonal.php?error=no');
		}
	}
	mysql_close($con);
?>