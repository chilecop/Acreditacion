<?php
	session_start();
	include('conexion.php');
	$nombre = $_POST['nombre'];
	$rut = $_POST['rut'];
	$empresa = $_POST['empresa'];
	$cargo = $_POST['cargo'];
	$razon = $_POST['razon'];
	$fechainicio = $_POST['fechainicio'];
	$fechatermino = $_POST['fechatermino'];
	$idcontratista = $_SESSION['idcontratista'];
	$idusuario = $_SESSION['idUser'];

	$con = conectarse();
	mysql_set_charset("utf8",$con);
    $sql="INSERT INTO pasesDiarios (nombre,rut,empresa,cargo,razon,fechaInicio,fechaTermino,estado,id_contratista,id_usuario) VALUES ('$nombre','$rut','$empresa','$cargo','$razon','$fechainicio','$fechatermino','1','$idcontratista','$idusuario')";
    $resultado = mysql_query($sql,$con);

    //PRIMERO CAPTURAMOS EL ID DEL RECIEN INSERTADO
    $sql = "SELECT ID_PASE FROM pasesDiarios GROUP BY ID_PASE DESC LIMIT 1";
    $resultado = mysql_query($sql,$con);
    $fila = mysql_fetch_array($resultado);
    $idPase = $fila['ID_PASE'];

    //REGISTRAR ACCION
	$sql = "INSERT INTO registro_acciones (ID_CONTRATISTA,ID_USUARIO,TIPO,REFERENCIA,ACCION,FECHAREGISTRO) VALUES ('$idcontratista','$idusuario','Pase Diario','$idPase','Ingreso de Pase Diario RUT-". $rut ."',now())";
	mysql_query($sql,$con);

    header("location: http://www.chilecop.cl/acreditacion/pasesDiarios.php");
?>