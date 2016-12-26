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
		$sql = 'INSERT INTO pruebaingresos (rut, outin,fecha) VALUES ';
		if($fila = mysql_fetch_array($resultado)){
			$sql = $sql . "('" . $fila['rut'] . "','" . $fila['outin'] . "','" . $fila['fecha'] . "')";
			while($fila = mysql_fetch_array($resultado)){
				$sql = $sql . ",('" . $fila['rut'] . "','" . $fila['outin'] . "','" . $fila['fecha'] . "')";
			}
			$sql = $sql . ";";
		}else{
			return "no";
		}
		mysql_close($con);
		return $sql;
	}

	function getIdPersonal(){
		$consulta = "SELECT * FROM personal ORDER BY id_personal DESC LIMIT 1";
		$con = conectarse();
		$resultado = mysql_query($consulta,$con);
		if($fila = mysql_fetch_array($resultado)){
			return $fila['id_personal'];
		}else{
			return "no";
		}
	}

	function getIdProhibiciones(){
		$consulta = "SELECT * FROM prohibiciones ORDER BY id_prohibicion DESC LIMIT 1";
		$con = conectarse();
		$resultado = mysql_query($consulta,$con);
		if($fila = mysql_fetch_array($resultado)){
			return $fila['id_prohibicion'];
		}else{
			return "no";
		}
	}
?>
