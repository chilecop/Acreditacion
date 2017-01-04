<?php
include('conexion.php');
session_start();
$con = conectarse();
//Variable recibidas
$tipo = $_POST['tipo'];
$ndoc = $_POST['ndoc'];

if($tipo=="Persona"){
	$id = $_SESSION['idTrabajadorActual'];
	$sql = "UPDATE documentacion SET URL_" . $ndoc . " = '' WHERE ID_ACREDITADO='$id'";
}
if($tipo=="Empresa"){
	$id = $_SESSION['idEmpresaActual'];
	$sql = "UPDATE documentacion_contratista SET URL" . $ndoc . " = '' WHERE ID_CONTRATISTA='$id'";
}

$resultado = mysql_query($sql,$con);

echo "ok";
?>