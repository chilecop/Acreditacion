<?php 
	include("conexion.php");
	function Combobox($curso){
		if($curso){
			$consulta = sprintf("SELECT * FROM cursos WHERE codigoNombre='$curso'");
			$resultado = mysql_query($consulta);
			if (!$resultado) {
			    $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
			    $mensaje .= 'Consulta completa: ' . $consulta;
			    die($mensaje);
			}
			if($fila = mysql_fetch_assoc($resultado)){
				do {
					if($fila['disponible']==1){
						$date = date_create($fila['fecha']);
						$fecha = date_format($date, 'd/m/y');
						echo '<option value="'. $fila['codigo'] .'">' . $fecha . ' - ' . $fila['nombre'] . '</option>';
					}
				} while ($fila = mysql_fetch_assoc($resultado));
			}else{
				echo 'OPS! A&uacute;n no tenemos fechas disponibles para este curso.';
			}
		}else{
			$consulta = sprintf("SELECT * FROM cursos");
			$resultado = mysql_query($consulta);
			if (!$resultado) {
			    $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
			    $mensaje .= 'Consulta completa: ' . $consulta;
			    die($mensaje);
			}
			while ($fila = mysql_fetch_assoc($resultado)) {
				if($fila['disponible']==1){
					$date = date_create($fila['fecha']);
					$fecha = date_format($date, 'd/m/y');
					echo '<option value="'. $fila['codigo'] .'">' . $fecha . ' - ' . $fila['nombre'] . '</option>';
				}
			}
		}

	}

	function getNombreCurso($id){
		$consulta = sprintf("SELECT nombre FROM cursos WHERE codigo='$id'");
		$resultado = mysql_query($consulta);
		if (!$resultado) {
		    $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
		    $mensaje .= 'Consulta completa: ' . $consulta;
		    die($mensaje);
		}
		$fila = mysql_fetch_assoc($resultado);
		return $fila['nombre'];
	}

	function getHorario($id){
		$consulta = sprintf("SELECT horario FROM cursos WHERE codigo='$id'");
		$resultado = mysql_query($consulta);
		if (!$resultado) {
		    $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
		    $mensaje .= 'Consulta completa: ' . $consulta;
		    die($mensaje);
		}
		$fila = mysql_fetch_assoc($resultado);
		return $fila['horario'];
	}

	function getValor($id){
		$consulta = sprintf("SELECT valor FROM cursos WHERE codigo='$id'");
		$resultado = mysql_query($consulta);
		if (!$resultado) {
		    $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
		    $mensaje .= 'Consulta completa: ' . $consulta;
		    die($mensaje);
		}
		$fila = mysql_fetch_assoc($resultado);
		return $fila['valor'];
	}

	function getFecha($id){
		$consulta = sprintf("SELECT fecha FROM cursos WHERE codigo='$id'");
		$resultado = mysql_query($consulta);
		if (!$resultado) {
		    $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
		    $mensaje .= 'Consulta completa: ' . $consulta;
		    die($mensaje);
		}
		$fila = mysql_fetch_assoc($resultado);
		$date = date_create($fila['fecha']);
		$fechadia = date_format($date, 'd');
		$fechames = date_format($date, 'm');
		$fechayear = date_format($date, 'Y');
		switch ($fechames) {
			case '01':
				$mes = "Enero";
				break;
			case '02':
				$mes = "Febrero";
				break;
			case '03':
				$mes = "Marzo";
				break;
			case '04':
				$mes = "Abril";
				break;
			case '05':
				$mes = "Mayo";
				break;
			case '06':
				$mes = "Junio";
				break;
			case '07':
				$mes = "Julio";
				break;
			case '08':
				$mes = "Agosto";
				break;
			case '09':
				$mes = "Septiembre";
				break;
			case '10':
				$mes = "Octubre";
				break;
			case '11':
				$mes = "Noviembre";
				break;
			case '12':
				$mes = "Diciembre";
				break;
			default:
				# code...
				break;
		}
		$fecha = $fechadia . " de " . $mes . " del " . $fechayear;
		return $fecha;
	}

	function modificarCupo($cursoId){
		$consulta = sprintf("SELECT cupos FROM cursos WHERE codigo='$cursoId'");
		$resultado = mysql_query($consulta);
		if (!$resultado) {
		    $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
		    $mensaje .= 'Consulta completa: ' . $consulta;
		    die($mensaje);
		}
		$fila = mysql_fetch_assoc($resultado);
		$cupoFinal= $fila['cupos'] - 1;
		$consulta = sprintf("UPDATE cursos SET cupos='$cupoFinal' WHERE codigo='$cursoId'");
		$resultado = mysql_query($consulta);
		if (!$resultado) {
		    $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
		    $mensaje .= 'Consulta completa: ' . $consulta;
		    die($mensaje);
		}
	}

	function hayCurso($curso){
		$consulta = sprintf("SELECT * FROM cursos WHERE codigoNombre='$curso'");
		$resultado = mysql_query($consulta);
		if (!$resultado) {
		    $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
		    $mensaje .= 'Consulta completa: ' . $consulta;
		    die($mensaje);
		}
		if(!$fila = mysql_fetch_assoc($resultado)){
			return 0;
		}
		do {
			if($fila['disponible']==1){
				return 1;
			}
		} while ($fila = mysql_fetch_assoc($resultado));
		return 0;
	}

	function ComboboxHorario($curso){
		<option value="horario1">09:00 a 13:00 Hrs.</option>
		<option value="horario2">15:00 a 19:00 Hrs.</option>
	}
?>