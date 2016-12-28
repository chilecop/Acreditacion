<?php
	include('conexion.php');
	session_start();
	//SE COMPRUEBA CUAL ES EL ARCHIVO QUE SE QUIERE SUBIR
	if(isset($_FILES["file"]))
	{
		$file = $_FILES["file"];
	}

	if(isset($_FILES["file2"]))
	{
		$file = $_FILES["file2"];
	}

	if(isset($_FILES["file3"]))
	{
		$file = $_FILES["file3"];
	}

	if(isset($_FILES["file4"]))
	{
		$file = $_FILES["file4"];
	}

	if(isset($_FILES["file5"]))
	{
		$file = $_FILES["file5"];
	}

	if(isset($_FILES["file6"]))
	{
		$file = $_FILES["file6"];
	}
	
	if(isset($_FILES["file7"]))
	{
		$file = $_FILES["file7"];
	}
	
	if(isset($_FILES["file8"]))
	{
		$file = $_FILES["file8"];
	}
	
	if(isset($_FILES["file9"]))
	{
		$file = $_FILES["file9"];
	}
	
	if(isset($_FILES["file10"]))
	{
		$file = $_FILES["file10"];
	}


	//SE SUBE EL ARCHIVO
	if(isset($file))
	{
		$nombre = addslashes($file["name"]);
		$tipo = $file["type"];
		$ruta_provisional = $file["tmp_name"];
		$size = $file["size"];
		$carpeta = "../archivoseecc/" . $_SESSION['empresaActual'] . "/";

		if($size> 1024*1024*8){
			echo "Error, el tamaño m&aacute;ximo permitido es 1MB";
		}else{
			$src = $carpeta . $nombre;
			move_uploaded_file($ruta_provisional, $src);
		}
	}

	$id = $_SESSION['idEmpresaActual'];
	$con = conectarse();
	//AGREGAMOS LA URL AL TRABAJADOR
	if(isset($_FILES["file"]))
	{
		$sql = "UPDATE documentacion_contratista SET URL1='$nombre', MOD1=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
	}
	if(isset($_FILES["file2"]))
	{
		$sql = "UPDATE documentacion_contratista SET URL2='$nombre', MOD2=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
	}
	if(isset($_FILES["file3"]))
	{
		$sql = "UPDATE documentacion_contratista SET URL3='$nombre', MOD3=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
	}
	if(isset($_FILES["file4"]))
	{
		$sql = "UPDATE documentacion_contratista SET URL4='$nombre', MOD4=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
	}
	if(isset($_FILES["file5"]))
	{
		$sql = "UPDATE documentacion_contratista SET URL5='$nombre', MOD5=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
	}
	if(isset($_FILES["file6"]))
	{
		$sql = "UPDATE documentacion_contratista SET URL6='$nombre', MOD6=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
	}
	if(isset($_FILES["file7"]))
	{
		$sql = "UPDATE documentacion_contratista SET URL7='$nombre', MOD7=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
	}
	if(isset($_FILES["file8"]))
	{
		$sql = "UPDATE documentacion_contratista SET URL8='$nombre', MOD8=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
	}
	if(isset($_FILES["file9"]))
	{
		$sql = "UPDATE documentacion_contratista SET URL9='$nombre', MOD9=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
	}
	if(isset($_FILES["file10"]))
	{
		$sql = "UPDATE documentacion_contratista SET URL10='$nombre', MOD10=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
	}


	//RETORNAMOS EL LINK DEL NOMBRE DEL ARCHIVO
	mysql_query($sql,$con);
	echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoseecc/". $_SESSION['empresaActual'] . "/". $nombre ."'>" . $nombre . "</a>";	
?>