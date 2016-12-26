<?php
include('../php/conexion.php');
$con = conectarse();
if(isset($_POST['pases'])){
	if($_POST['pases']!="no"){
		$sql = "TRUNCATE TABLE pasesDiarios";
		$query = $_POST['pases'];
		$resultado2 = mysql_query($sql,$con);
		$resultado = mysql_query($query,$con);
	}
}else{

}
header("location: http://192.168.0.100/ChileCop/cacceso/commit/index.php");

?>