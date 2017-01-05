<?php
	include('conexion.php');
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	$con = conectarse();

	//ID DEL TRABAJADOR ACTUAL
	$id = $_SESSION['contratoActual'];

	//SE COMPRUEBA CUAL ES EL ARCHIVO QUE SE QUIERE SUBIR
	if(isset($_FILES["file1"]))
	{
		$file = $_FILES["file1"];
		$sql = "SELECT URL_1 AS URL ";
	}

	if(isset($_FILES["file2"]))
	{
		$file = $_FILES["file2"];
		$sql = "SELECT URL_2 AS URL ";
	}

	if(isset($_FILES["file3"]))
	{
		$imagen = 'true';
		$file = $_FILES["file3"];
		$sql = "SELECT URL_3 AS URL ";
	}

	if(isset($_FILES["file4"]))
	{
		$file = $_FILES["file4"];
		$sql = "SELECT URL_4 AS URL ";
	}

	if(isset($file['name'])){
		/**
		* Comprobamos si el archivo ya fue subido alguna vez
		*/
		$sql .=  "FROM documentacion_contrato WHERE ID_OC='$id'";
		$resultado = mysql_query($sql, $con);
    	$fila = mysql_fetch_array($resultado);

    	/**
    	* Solo sube el archivo si es la primera vez que se esta subiendo
    	*/
		if($fila['URL']==""){
			$fecha = new DateTime();
			//SE SUBE EL ARCHIVO
			if(isset($file) && isset($imagen))
			{
				$nombre = $fecha->getTimestamp() . addslashes($file["name"]);
				$tipo = $file["type"];
				$ruta_provisional = $file["tmp_name"];
				$size = $file["size"];
				$carpeta = "../archivoscontrato/" . $_SESSION['numeroContrato'] . "/";

				if($tipo != 'image/jpeg' && $tipo && 'image/png' && $tipo != 'image/jpg'){
					echo json_encode(array('link' =>'Error, debe ser un archivo de imagen.',
							'mensaje'=>'okey'));
				}else {
					if($size> 1024*1024*8){
						echo json_encode(array('link' =>'Error, tamaño máximo permitido 8MB.',
							'mensaje'=>'okey'));
					} else {
						$src = $carpeta . $nombre;
						move_uploaded_file($ruta_provisional, $src);
						$okey = 'true';
					}	
				}	
			} else {
				$nombre = $fecha->getTimestamp() . addslashes($file["name"]);
				$tipo = $file["type"];
				$ruta_provisional = $file["tmp_name"];
				$size = $file["size"];
				$carpeta = "../archivoscontrato/" . $_SESSION['numeroContrato'] . "/";

				/*if($tipo != 'application/pdf'){
					echo "Error, el archivo debe ser pdf";
				}else */
				if($size> 1024*1024*8){
					echo json_encode(array('link' =>'Error, tamaño máximo permitido 8MB.',
							'mensaje'=>'okey'));
				} else {
					$src = $carpeta . $nombre;
					move_uploaded_file($ruta_provisional, $src);
					$okey = 'true';
				}
			}
			
			mysql_set_charset("utf8",$con);
			//AGREGAMOS LA URL AL TRABAJADOR SI NO EXISTEN PROBLEMAS DE ARCHIVO
			if(isset($okey)){
				if(isset($_FILES["file1"]))
				{
					$sql = "UPDATE documentacion_contrato SET URL_1='$nombre', MOD_1=CURRENT_TIMESTAMP() WHERE ID_OC='$id'";
					$_SESSION['docContrato1Refresh']="Contrato Comercial u OST";
				}
				if(isset($_FILES["file2"]))
				{
					$sql = "UPDATE documentacion_contrato SET URL_2='$nombre', MOD_2=CURRENT_TIMESTAMP() WHERE ID_OC='$id'";
					$_SESSION['docContrato2Refresh']="Jornada Excepcional";
				}
				if(isset($_FILES["file3"]))
				{
					$sql = "UPDATE documentacion_contrato SET URL_3='$nombre', MOD_3=CURRENT_TIMESTAMP() WHERE ID_OC='$id'";
					$_SESSION['docContrato3Refresh']="Carpeta de Arranque";
				}
				if(isset($_FILES["file4"]))
				{
					$sql = "UPDATE documentacion_contrato SET URL_4='$nombre', MOD_4=CURRENT_TIMESTAMP() WHERE ID_OC='$id'";
					$_SESSION['docContrato4Refresh']="Documento Adicional";
				}				
			}
			//RETORNAMOS EL LINK DEL NOMBRE DEL ARCHIVO
			mysql_query($sql,$con);

			if(isset($okey)){
				//echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoscontrato/". $_SESSION['contratoActual'] . "/". $nombre ."'>" . $nombre . "</a>";	
				echo json_encode(array('link'=>"<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoscontrato/". $_SESSION['contratoActual'] . "/". $nombre ."'>" . $nombre . "</a>",
				'mensaje'=>'okey'));
			}
		}else{
			//echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoscontrato/". $_SESSION['contratoActual'] . "/". $fila['URL'] ."'>" . $fila['URL'] . "</a>";	
			echo json_encode(array('link'=>"<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoscontrato/". $_SESSION['contratoActual'] . "/". $fila['URL'] ."'>" . $fila['URL'] . "</a>",
				'mensaje'=>'No puede volver a subir un documento. Solicite autorización enviando un correo a acreditacion@chilecop.cl'));
		}
	}
	header('Content-Type: application/json');
?>