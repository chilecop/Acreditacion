<?php
include('conexion.php');
session_start();

$con = conectarse();
$clave = $_POST['clave1'];
$id = $_SESSION["idUser"];

$sql = "UPDATE usuario SET CLAVE='$clave' WHERE ID_USUARIO_SISTEMA='$id'";
$resultado = mysql_query($sql,$con);
echo "ok";
?>
