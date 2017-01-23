<?php 
include('conexion.php');
$con = conectarse();

$id = $_POST['id'];
$valor = $_POST['valor'];

$sql = "UPDATE personal_acreditado SET INDUCCION='$valor' WHERE ID_ACREDITADO='$id'";
mysql_query($sql,$con);

mysql_close($con);
?>