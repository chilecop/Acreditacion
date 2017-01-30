<?php
/**
* Conexion con la BD
*/
include('conexion.php');
$con = conectarse();

/**
* Variables recibidas
*/
$id = $_POST['id'];
$nuevoEstado = $_POST['nuevoEstado'];

/**
* Query
*/
$sql = "UPDATE alerta_documentacion SET VISIBLE='$nuevoEstado' WHERE ID_REGISTRO='$id'";
mysql_query($sql,$con);
mysql_close($con);
?>