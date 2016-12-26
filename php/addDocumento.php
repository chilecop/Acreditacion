<?php
	session_start();
	if(isset($_FILES["file"]))
	{
		$file = $_FILES["file"];
		$narchivo = "file";
	}

	if(isset($_FILES["file2"]))
	{
		$file = $_FILES["file2"];
		$narchivo = "file2";
	}

	if(isset($_FILES["file3"]))
	{
		$file = $_FILES["file3"];
		$narchivo = "file3";
	}

	if(isset($file))
	{
		$nombre = addslashes($file["name"]);
		$tipo = $file["type"];
		$ruta_provisional = $file["tmp_name"];
		$size = $file["size"];
		$carpeta = "dctos/";

		if($tipo != 'application/pdf'){
			echo "Error, el archivo no es un archivo pdf";
		}else if($size> 1024*1024*8){
			echo "Error, el tamaño m&aacute;ximo permitido es 1MB";
		}else{
			$src = $carpeta . $nombre;
			move_uploaded_file($ruta_provisional, $src);
			echo "<a href='http://www.chilecop.cl/acreditacion/php/dctos/". $nombre ."'>" . $nombre . "</a>";
		}
	}
	/*CUANDO SE AGREGUE EL ARCHIVO, DESPUÉS DE AGREGARLO, HAY QUE MATAR LA VARIABLE GLOBAL. YA QUE SI SE DEJA
	DESPUÉS INTERFERIRÁ CON LAS SIGUIENTES SUBIDAS DE ARCHIVOS*/

	if(isset($_FILES["file"]))
	{
		$_SESSION['file']=$nombre;
	}

	if(isset($_FILES["file2"]))
	{
		$_SESSION['file2']=$nombre;
	}

	if(isset($_FILES["file3"]))
	{
		$_SESSION['file3']=$nombre;
	}
?>