<?php
include('../php/conexion.php');
$con = conectarse();
if(isset($_POST['personal'])){
	if($_POST['personal']!="no"){
		$sql = "TRUNCATE TABLE personal";
		$query = $_POST['personal'];
		$resultado2 = mysql_query($sql,$con);
		$resultado = mysql_query($query,$con);
	}
}else{

}
if(isset($_POST['prohibicion'])){
	if($_POST['prohibicion']!="no"){
		$sql = "TRUNCATE TABLE prohibiciones";
		$query = $_POST['prohibicion'];
		$resultado2 = mysql_query($sql,$con);
		$resultado = mysql_query($query,$con);
	}
}else{
	echo "no hay prohibicion";
}
header("location: http://192.168.0.100/ChileCop/cacceso/commit/bajarPases.php");

?>