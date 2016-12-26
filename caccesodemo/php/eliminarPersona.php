<?php
	include('conexion.php');
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}
	$con = conectarse();
	$sql = "DELETE FROM personal WHERE id_personal='$id'";
	mysql_query($sql,$con);
	header('location: http://www.chilecop.cl/joyglobal/personalActivo.php');
?>