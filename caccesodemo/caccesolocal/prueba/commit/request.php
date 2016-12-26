<?php
	function conectarse(){
		$con = mysql_connect("localhost","root","");
		if (!$con){
		  die('Could not connect: ' . mysql_error());
		} 
		mysql_select_db("chilecop", $con);
		return $con;
	}


	function getIngresos(){
		$consulta = "SELECT * FROM ingreso";
		$con = conectarse();
		$resultado = mysql_query($consulta,$con);
		$sql = 'INSERT INTO pruebaingresos2 (rut, outin) VALUES ';
		if($fila = mysql_fetch_array($resultado)){
			$sql = $sql . "('" . $fila['rut'] . "','" . $fila['outin'] . "')";
			while($fila = mysql_fetch_array($resultado)){
				$sql = $sql . ",('" . $fila['rut'] . "','" . $fila['outin'] . "')";
			}
			$sql = $sql . ";";
		}
		mysql_close($con);
		return $sql;
	}
?>