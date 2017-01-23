<?php
include('../conexion.php');
$con = conectarse();

$sql = "SELECT ID_ESTADO FROM personal_acreditado";
$resultado = mysql_query($sql,$con);

$acreditados = 0;
$rechazados = 0;
$pendientes = 0;
while($fila = mysql_fetch_array($resultado)){
	if($fila['ID_ESTADO']=='1'){
		$acreditados++;
	}

	if($fila['ID_ESTADO']=='2'){
		$rechazados++;
	}

	if($fila['ID_ESTADO']=='3'){
		$pendientes++;
	}
}

mysql_close($con);

echo json_encode(
	array(
		'a'=>$acreditados,
		'p'=>$pendientes,
		'r'=>$rechazados
		)
);
?>