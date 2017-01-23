<?php
include('conexion.php');
$estadoActual = $_POST['estadoActual'];
$id = $_POST['id'];
$con = conectarse();
switch ($estadoActual) {
	case '1':
		$sql = "UPDATE personal_acreditado SET ID_ESTADO='2' WHERE ID_ACREDITADO='$id'";
		mysql_query($sql,$con);
		$sql = "INSERT INTO estado_trabajador_historial (ID_ACREDITADO,ESTADO,FECHA) VALUES ('$id','2',now())";
		mysql_query($sql,$con);
		echo '2';
		break;
	case '2':
		$sql = "UPDATE personal_acreditado SET ID_ESTADO='3' WHERE ID_ACREDITADO='$id'";
		mysql_query($sql,$con);
		$sql = "INSERT INTO estado_trabajador_historial (ID_ACREDITADO,ESTADO,FECHA) VALUES ('$id','3',now())";
		mysql_query($sql,$con);
		echo '3';
		break;
	case '3':
		$sql = "UPDATE personal_acreditado SET ID_ESTADO='1', INICIOPASE=now() WHERE ID_ACREDITADO='$id'";
		mysql_query($sql,$con);
		$sql = "INSERT INTO estado_trabajador_historial (ID_ACREDITADO,ESTADO,FECHA) VALUES ('$id','1',now())";
		mysql_query($sql,$con);
		echo '1';
		break;	
	default:
		$sql = "UPDATE personal_acreditado SET ID_ESTADO='3' WHERE ID_ACREDITADO='$id'";
		echo '3';
		break;
}

?>