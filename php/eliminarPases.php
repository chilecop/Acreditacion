<?php
	session_start();
	include('conexion.php');
	if(isset($_GET['id'])){
		$id = $_GET['id'];	
		$idContratista = $_SESSION["idContratista"];
		$idUser = $_SESSION["idUser"];
		$con = conectarse();
		$sql = "DELETE FROM pasesDiarios WHERE ID_PASE='$id'";
		mysql_query($sql,$con);

		//REGISTRAR ACCION
		$sql = "INSERT INTO registro_acciones (ID_CONTRATISTA,ID_USUARIO,TIPO,REFERENCIA,ACCION,FECHAREGISTRO) VALUES ('$idContratista','$idUser','Pase Diario','$id','Eliminacion de Pase',now())";
		mysql_query($sql,$con);


	}
	header('location: http://www.chilecop.cl/acreditacion/pasesDiarios.php');
?>