<?php
session_start();
/*
* Conexion con la base de datos
*/
include('conexion.php');
$con = conectarse();

$val2 = $_POST['val2'];
$val5 = $_POST['val5'];
$val6 = $_POST['val6'];
$val14 = $_POST['val14'];
$val20 = $_POST['val20'];
$val21 = $_POST['val21'];
$val22 = $_POST['val22'];
$val23 = $_POST['val23'];
$id = $_SESSION['idTrabajadorActual'];

$sql = "UPDATE documentacion SET VAL_6='$val6'";
if($val2!="no"){
	$sql .= ", VAL_2='" . $val2 . "'";
}
if($val5!="no"){
	$sql .= ", VAL_5='" . $val5 . "'";
}
if($val14!="no"){
	$sql .= ", VAL_14='" . $val14 . "'";
}
if($val20!="no"){
	$sql .= ", VAL_20='" . $val20 . "'";
}
if($val21!="no"){
	$sql .= ", VAL_21='" . $val21 . "'";
}
if($val22!="no"){
	$sql .= ", VAL_22='" . $val22 . "'";
}
if($val23!="no"){
	$sql .= ", VAL_23='" . $val23 . "'";
}

$sql .= " WHERE ID_ACREDITADO='$id'";

/*
* Acreditar a la persona
*/ 
//UPDATE EN DOCUMENTACION
mysql_query($sql,$con);
//REGISTRO EN EL HISTORIAL
$sql = "INSERT INTO estado_trabajador_historial (ID_ACREDITADO, FECHA) VALUES ('$id',now())";
mysql_query($sql,$con);
//REGISTRO EN PERSONAL ACREDITADO
$sql = "UPDATE personal_acreditado SET ID_ESTADO='1' WHERE ID_ACREDITADO='$id'";
mysql_query($sql,$con);
echo "Acreditado";
?>