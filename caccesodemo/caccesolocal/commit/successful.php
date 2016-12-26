<?php
	traspasar();
	function conectarse(){
		$con = mysql_connect("localhost","root","");
		if (!$con){
		  die('Could not connect: ' . mysql_error());
		} 
		mysql_select_db("chilecop", $con);
		return $con;
	}

	function traspasar(){
		$consulta = "INSERT INTO ingresohistorial SELECT * FROM ingreso";
		$con = conectarse();
		echo 'Traspasando datos al historial local...<br>';
		$resultado = mysql_query($consulta,$con);
		mysql_close($con);
		limpiar();
	}

	function limpiar(){
		echo 'Limpiando ingreso...<br>';
		$consulta = "DELETE FROM ingreso";
		$con = conectarse();
		$resultado = mysql_query($consulta,$con);
		mysql_close($con);
		echo 'Commit finalizado con éxito...';
		header('Location: bajarPersonal.php');
	}
?>