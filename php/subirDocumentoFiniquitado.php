<?php
$file = $_FILES["file1"];
$fecha = new DateTime();
if(isset($file))
{
	$nombre = $fecha->getTimestamp() . addslashes($file["name"]);
	$tipo = $file["type"];
	$ruta_provisional = $file["tmp_name"];
	$size = $file["size"];
	$carpeta = "../finiquitos/";

	if($size> 1024*1024*8){
		echo "Error, tamaño máximo permitido 8MB";
	} else {
		$src = $carpeta . $nombre;
		move_uploaded_file($ruta_provisional, $src);
		echo $nombre;
	}	
}
?>