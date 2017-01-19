<?php
/*
* Conexion con la BD
*/
include('conexion.php');
$con = conectarse();

/*
* Consulta a la base de datos por la Documentacion del personal
*/
$sql = "SELECT * FROM documentacion";

$resultado = mysql_query($sql,$con);
while($fila = mysql_fetch_array($resultado)){
	for ($i=1; $i < 24; $i++) { 
		//Columna de la BD que se solicitara
		$columna = "VAL_";
		$columna .= $i;
		if($fila[$columna]!='0000-00-00' && $fila[$columna]!=NULL && $fila[$columna]!=""){
			//Crear la fecha de validacion
			$fechaValidacion = date_create($fila[$columna]);
			$dia = date_format($fechaValidacion, 'd');
			$mes = date_format($fechaValidacion, 'm');
			$anio = date_format($fechaValidacion, 'Y');
			$diasRestantes = diasRestantes($dia,$mes,$anio);
			//YA TENIENDO LA DIFERENCIA DE DIAS RESTANTES VERIFICAMOS LOS QUE TIENEN MENOS DE 30
			if($diasRestantes==30){
				echo "Mensaje, faltan 30 días al doc " . $columna . "<br>";
			}
			if($diasRestantes==15){
				echo "Mensaje, faltan 15 días al doc " . $columna . "<br>";
			}
			if($diasRestantes==5){
				echo "Mensaje, faltan 5 días al doc " . $columna . "<br>";
			}
			if($diasRestantes==0){
				echo "Documento Vencido, DESACREDITANDO por el doc " . $columna . "<br>";
			}
		}else{

		}
	}
}

/*
* Consulta a la base de datos por la Documentacion de Empresa
*/
$sql = "SELECT * FROM documentacion_contratista";

$resultado = mysql_query($sql,$con);
while($fila = mysql_fetch_array($resultado)){
	for ($i=1; $i < 11; $i++) { 
		//Columna de la BD que se solicitara
		$columna = "VAL";
		$columna .= $i;
		if($fila[$columna]!='0000-00-00' && $fila[$columna]!=NULL && $fila[$columna]!=""){
			//Crear la fecha de validacion
			$fechaValidacion = date_create($fila[$columna]);
			$dia = date_format($fechaValidacion, 'd');
			$mes = date_format($fechaValidacion, 'm');
			$anio = date_format($fechaValidacion, 'Y');
			$diasRestantes = diasRestantes($dia,$mes,$anio);
			//YA TENIENDO LA DIFERENCIA DE DIAS RESTANTES VERIFICAMOS LOS QUE TIENEN MENOS DE 30
			if($diasRestantes==30){
				echo "Mensaje, faltan 30 días al doc " . $columna . "<br>";
			}
			if($diasRestantes==15){
				echo "Mensaje, faltan 15 días al doc " . $columna . "<br>";
			}
			if($diasRestantes==5){
				echo "Mensaje, faltan 5 días al doc " . $columna . "<br>";
			}
			if($diasRestantes==0){
				echo "Documento Vencido, DESACREDITANDO por el doc " . $columna . "<br>";
			}
		}else{

		}
	}
}

/*
* Consulta a la base de datos por la Documentacion de Contratos
*/
$sql = "SELECT * FROM documentacion_contrato";

$resultado = mysql_query($sql,$con);
while($fila = mysql_fetch_array($resultado)){
	for ($i=1; $i < 5; $i++) { 
		//Columna de la BD que se solicitara
		$columna = "VAL_";
		$columna .= $i;
		if($fila[$columna]!='0000-00-00' && $fila[$columna]!=NULL && $fila[$columna]!=""){
			//Crear la fecha de validacion
			$fechaValidacion = date_create($fila[$columna]);
			$dia = date_format($fechaValidacion, 'd');
			$mes = date_format($fechaValidacion, 'm');
			$anio = date_format($fechaValidacion, 'Y');
			$diasRestantes = diasRestantes($dia,$mes,$anio);
			//YA TENIENDO LA DIFERENCIA DE DIAS RESTANTES VERIFICAMOS LOS QUE TIENEN MENOS DE 30
			if($diasRestantes==30){
				echo "Mensaje, faltan 30 días al doc " . $columna . "<br>";
			}
			if($diasRestantes==15){
				echo "Mensaje, faltan 15 días al doc " . $columna . "<br>";
			}
			if($diasRestantes==5){
				echo "Mensaje, faltan 5 días al doc " . $columna . "<br>";
			}
			if($diasRestantes==-1){
				echo "Documento Vencido, DESACREDITANDO por el doc " . $columna . "<br>";
			}
		}else{

		}
	}
}

function diasRestantes($dia1,$mes1,$ano1){
	$ano2 = date("Y");
	$mes2 = date("m");
	$dia2 = date("d");

	$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
	$timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2);

	//resto a una fecha la otra 
	$segundos_diferencia = $timestamp1 - $timestamp2; 
	//echo $segundos_diferencia; 

	//convierto segundos en días 
	$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

	//quito los decimales a los días de diferencia 
	$dias_diferencia = floor($dias_diferencia);

	return $dias_diferencia;
}

?>
