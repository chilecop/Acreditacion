<?php
	include('conexion.php');
	$con = conectarse();
	mysql_set_charset("utf8",$con);
	$user = $_POST['usuario'];
	$password = $_POST['password'];
	$sql = "SELECT AES_DECRYPT(password,'Alfredo116998') FROM login WHERE usuario='$user'";
	$respuesta = mysql_query($sql,$con);
	if($fila = mysql_fetch_row($respuesta)){
		if($fila['0']==$password){
			echo 'Si coincide la password!';
		}else{
			echo 'Las password no coinciden.';
		}
	}else{
		echo 'no funciono';
	}
	//INSERT INTO usuarios VALUES('usuario',AES_DECRYPT('contraseña','llave'));
	mysql_close($con);
?>