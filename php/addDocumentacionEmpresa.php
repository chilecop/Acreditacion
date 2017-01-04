<?php
	include('conexion.php');
	session_start();
	$con = conectarse();

	//ID DEL TRABAJADOR ACTUAL
	$id = $_SESSION['idEmpresaActual'];

	//SE COMPRUEBA CUAL ES EL ARCHIVO QUE SE QUIERE SUBIR
	if(isset($_FILES["file1"]))
	{
		$file = $_FILES["file1"];
		$sql = "SELECT URL1 AS URL ";
	}

	if(isset($_FILES["file2"]))
	{
		$file = $_FILES["file2"];
		$sql = "SELECT URL2 AS URL ";
	}

	if(isset($_FILES["file3"]))
	{
		$file = $_FILES["file3"];
		$sql = "SELECT URL3 AS URL ";
	}

	if(isset($_FILES["file4"]))
	{
		$file = $_FILES["file4"];
		$sql = "SELECT URL4 AS URL ";
	}

	if(isset($_FILES["file5"]))
	{
		$file = $_FILES["file5"];
		$sql = "SELECT URL5 AS URL ";
	}

	if(isset($_FILES["file6"]))
	{
		$file = $_FILES["file6"];
		$sql = "SELECT URL6 AS URL ";
	}

	if(isset($_FILES["file7"]))
	{
		$file = $_FILES["file7"];
		$sql = "SELECT URL7 AS URL ";
	}

	if(isset($_FILES["file8"]))
	{
		$file = $_FILES["file8"];
		$sql = "SELECT URL8 AS URL ";
	}

	if(isset($_FILES["file9"]))
	{
		$file = $_FILES["file9"];
		$sql = "SELECT URL9 AS URL ";
	}

	if(isset($_FILES["file10"]))
	{
		$file = $_FILES["file10"];
		$sql = "SELECT URL10 AS URL ";
	}

	if(isset($file['name'])){
		/**
		* Comprobamos si el archivo ya fue subido alguna vez
		*/
		$sql .=  "FROM documentacion_contratista WHERE ID_CONTRATISTA='$id'";
		$resultado = mysql_query($sql, $con);
    	$fila = mysql_fetch_array($resultado);

    	/**
    	* Solo sube el archivo si es la primera vez que se esta subiendo
    	*/
		if($fila['URL']==""){
			$fecha = new DateTime();
			//SE SUBE EL ARCHIVO
			if(isset($file) && isset($imagen)){
				$nombre = $fecha->getTimestamp() . addslashes($file["name"]);
				$tipo = $file["type"];
				$ruta_provisional = $file["tmp_name"];
				$size = $file["size"];
				$carpeta = "../archivoseecc/" . $_SESSION['empresaActual'] . "/";

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
				$carpeta = "../archivoseecc/" . $_SESSION['empresaActual'] . "/";

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
					$sql = "UPDATE documentacion_contratista SET URL1='$nombre', MOD1=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
					$_SESSION['docEmpresa1Refresh']="Ficha Básica de Identificación";
				}
				if(isset($_FILES["file2"]))
				{
					$sql = "UPDATE documentacion_contratista SET URL2='$nombre', MOD2=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
					$_SESSION['docEmpresa2Refresh']="Listado de Trabajadores";
				}
				if(isset($_FILES["file3"]))
				{
					$sql = "UPDATE documentacion_contratista SET URL3='$nombre', MOD3=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
					$_SESSION['docEmpresa3Refresh']="Autorización de Jornada Excepcional";
				}
				if(isset($_FILES["file4"]))
				{
					$sql = "UPDATE documentacion_contratista SET URL4='$nombre', MOD4=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
					$_SESSION['docEmpresa4Refresh']="Contrato Comercial";
				}
				if(isset($_FILES["file5"]))
				{
					$sql = "UPDATE documentacion_contratista SET URL5='$nombre', MOD5=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
					$_SESSION['docEmpresa5Refresh']="Antecedentes Comerciales";
				}
				if(isset($_FILES["file6"]))
				{
					$sql = "UPDATE documentacion_contratista SET URL6='$nombre', MOD6=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
					$_SESSION['docEmpresa6Refresh']="Certificado Afiliación Mutualidad";
				}
				if(isset($_FILES["file7"]))
				{
					$sql = "UPDATE documentacion_contratista SET URL7='$nombre', MOD7=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
					$_SESSION['docEmpresa7Refresh']="Antecedentes Laborales";
				}
				if(isset($_FILES["file8"]))
				{
					$sql = "UPDATE documentacion_contratista SET URL8='$nombre', MOD8=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
					$_SESSION['docEmpresa8Refresh']="Carpeta de Arranque";
				}
				if(isset($_FILES["file9"]))
				{
					$sql = "UPDATE documentacion_contratista SET URL9='$nombre', MOD9=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
					$_SESSION['docEmpresa9Refresh']="Carpeta Tributaria";
				}
				if(isset($_FILES["file10"]))
				{
					$sql = "UPDATE documentacion_contratista SET URL10='$nombre', MOD10=CURRENT_TIMESTAMP() WHERE ID_CONTRATISTA='$id'";
					$_SESSION['docEmpresa10Refresh']="Certificado de Confidencialidad";
				}
			}
			//RETORNAMOS EL LINK DEL NOMBRE DEL ARCHIVO
			mysql_query($sql,$con);

			if(isset($okey)){
				echo json_encode(array('link'=>"<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoseecc/". $_SESSION['empresaActual'] . "/". $nombre ."'>" . $nombre . "</a>",
				'mensaje'=>'okey'));
			}
		}else{
			//echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivos/". $_SESSION['trabajadorActual'] . "/". $fila['URL'] ."'>" . $fila['URL'] . "</a>";	
			echo json_encode(array('link'=>"<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivoseecc/". $_SESSION['empresaActual'] . "/". $fila['URL'] ."'>" . $fila['URL'] . "</a>",
				'mensaje'=>'No puede volver a subir un documento. Solicite autorización enviando un correo a acreditacion@chilecop.cl'));
		}
	}
	header('Content-Type: application/json');
?>