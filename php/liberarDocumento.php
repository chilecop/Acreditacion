<?php
include('conexion.php');
session_start();
//ID DEL TRABAJADOR ACTUAL
$id = $_SESSION['idTrabajadorActual'];
$ndoc = $_POST['ndoc'];
$con = conectarse();

$sql = "UPDATE documentacion SET URL_" . $ndoc .  "='' WHERE ID_ACREDITADO='$id'";
$resultado = mysql_query($sql,$con);

echo "ok";
?>