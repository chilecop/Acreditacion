<?php
/*
* Conexion con la BD
*/
include('conexion.php');
$con = conectarse();

$sql = "INSERT INTO pruebaCron (REGISTRO) VALUES ('HOLA')";
mysql_query($sql,$con);

mysql_close($con);
?>
