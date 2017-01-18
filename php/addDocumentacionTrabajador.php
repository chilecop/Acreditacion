<?php
	include('conexion.php');
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	$con = conectarse();

	//ID DEL TRABAJADOR ACTUAL
	$id = $_SESSION['idTrabajadorActual'];
	$idContratista = $_SESSION["idContratista"];
	$idUser = $_SESSION["idUser"];

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

	if(isset($_FILES["file5"]))
	{
		$file = $_FILES["file5"];
		$sql = "SELECT URL_5 AS URL ";
	}

	if(isset($_FILES["file6"]))
	{
		$file = $_FILES["file6"];
		$sql = "SELECT URL_6 AS URL ";
	}

	if(isset($_FILES["file7"]))
	{
		$file = $_FILES["file7"];
		$sql = "SELECT URL_7 AS URL ";
	}

	if(isset($_FILES["file8"]))
	{
		$file = $_FILES["file8"];
		$sql = "SELECT URL_8 AS URL ";
	}

	if(isset($_FILES["file9"]))
	{
		$file = $_FILES["file9"];
		$sql = "SELECT URL_9 AS URL ";
	}

	if(isset($_FILES["file10"]))
	{
		$file = $_FILES["file10"];
		$sql = "SELECT URL_10 AS URL ";
	}

	if(isset($_FILES["file11"]))
	{
		$file = $_FILES["file11"];
		$sql = "SELECT URL_11 AS URL ";
	}

	if(isset($_FILES["file12"]))
	{
		$file = $_FILES["file12"];
		$sql = "SELECT URL_12 AS URL ";
	}

	if(isset($_FILES["file13"]))
	{
		$file = $_FILES["file13"];
		$sql = "SELECT URL_13 AS URL ";
	}

	if(isset($_FILES["file14"]))
	{
		$file = $_FILES["file14"];
		$sql = "SELECT URL_14 AS URL ";
	}

	if(isset($_FILES["file15"]))
	{
		$file = $_FILES["file15"];
		$sql = "SELECT URL_15 AS URL ";
	}

	if(isset($_FILES["file16"]))
	{
		$file = $_FILES["file16"];
		$sql = "SELECT URL_16 AS URL ";
	}

	if(isset($_FILES["file17"]))
	{
		$file = $_FILES["file17"];
		$sql = "SELECT URL_17 AS URL ";
	}

	if(isset($_FILES["file18"]))
	{
		$file = $_FILES["file18"];
		$sql = "SELECT URL_18 AS URL ";
	}

	if(isset($_FILES["file19"]))
	{
		$file = $_FILES["file19"];
		$sql = "SELECT URL_19 AS URL ";
	}

	if(isset($_FILES["file20"]))
	{
		$file = $_FILES["file20"];
		$sql = "SELECT URL_20 AS URL ";
	}

	if(isset($_FILES["file21"]))
	{
		$file = $_FILES["file21"];
		$sql = "SELECT URL_21 AS URL ";
	}

	if(isset($_FILES["file22"]))
	{
		$file = $_FILES["file22"];
		$sql = "SELECT URL_22 AS URL ";
	}

	if(isset($_FILES["file23"]))
	{
		$file = $_FILES["file23"];
		$sql = "SELECT URL_23 AS URL ";
	}

	if(isset($file['name'])){
		/**
		* Comprobamos si el archivo ya fue subido alguna vez
		*/
		$sql .=  "FROM documentacion WHERE ID_ACREDITADO='$id'";
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
				$carpeta = "../archivos/" . $_SESSION['trabajadorActual'] . "/";

				if($tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/jpg'){
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
				$carpeta = "../archivos/" . $_SESSION['trabajadorActual'] . "/";

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
					$sql = "UPDATE documentacion SET URL_1='$nombre', MOD_1=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc1Refresh']="Contrato de Trabajo";
					$docName = $_SESSION['doc1Refresh'];
				}
				if(isset($_FILES["file2"]))
				{
					$sql = "UPDATE documentacion SET URL_2='$nombre', MOD_2=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc2Refresh']="Inducción JoyGlobal";
					$docName = $_SESSION['doc2Refresh'];
				}
				if(isset($_FILES["file3"]))
				{
					$sql = "UPDATE documentacion SET URL_3='$nombre', MOD_3=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc3Refresh']="Fotografía Carnet";
					$docName = $_SESSION['doc3Refresh'];
				}
				if(isset($_FILES["file4"]))
				{
					$sql = "UPDATE documentacion SET URL_4='$nombre', MOD_4=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc4Refresh']="Consentimiento Test Alcohol y Drogas";
					$docName = $_SESSION['doc4Refresh'];
				}
				if(isset($_FILES["file5"]))
				{
					$sql = "UPDATE documentacion SET URL_5='$nombre', MOD_5=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc5Refresh']="Fotocopia Cédula";
					$docName = $_SESSION['doc5Refresh'];
				}
				if(isset($_FILES["file6"]))
				{
					$sql = "UPDATE documentacion SET URL_6='$nombre', MOD_6=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc6Refresh']="Examen Pre-Ocupacional";
					$docName = $_SESSION['doc6Refresh'];
				}
				if(isset($_FILES["file7"]))
				{
					$sql = "UPDATE documentacion SET URL_7='$nombre', MOD_7=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc7Refresh']="ODI";
					$docName = $_SESSION['doc7Refresh'];
				}
				if(isset($_FILES["file8"]))
				{
					$sql = "UPDATE documentacion SET URL_8='$nombre', MOD_8=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc8Refresh']="Reglamento Interno";
					$docName = $_SESSION['doc8Refresh'];
				}
				if(isset($_FILES["file9"]))
				{
					$sql = "UPDATE documentacion SET URL_9='$nombre', MOD_9=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc9Refresh']="Entrega EPP";
					$docName = $_SESSION['doc9Refresh'];
				}
				if(isset($_FILES["file10"]))
				{
					$sql = "UPDATE documentacion SET URL_10='$nombre', MOD_10=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc10Refresh']="Último Finiquito";
					$docName = $_SESSION['doc10Refresh'];
				}
				if(isset($_FILES["file11"]))
				{
					$sql = "UPDATE documentacion SET URL_11='$nombre', MOD_11=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc11Refresh']="Certificado Antecedentes";
					$docName = $_SESSION['doc11Refresh'];
				}
				if(isset($_FILES["file12"]))
				{
					$sql = "UPDATE documentacion SET URL_12='$nombre', MOD_12=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc12Refresh']="Certificado Estudios";
					$docName = $_SESSION['doc12Refresh'];
				}
				if(isset($_FILES["file13"]))
				{
					$sql = "UPDATE documentacion SET URL_13='$nombre', MOD_13=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc13Refresh']="Acreditación Prevencionista";
					$docName = $_SESSION['doc13Refresh'];
				}
				if(isset($_FILES["file14"]))
				{
					$sql = "UPDATE documentacion SET URL_14='$nombre', MOD_14=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc14Refresh']="Certificado de Aprobación";
					$docName = $_SESSION['doc15Refresh'];
				}
				if(isset($_FILES["file15"]))
				{
					$sql = "UPDATE documentacion SET URL_15='$nombre', MOD_15=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc15Refresh']="Anexo 1";
					$docName = $_SESSION['doc15Refresh'];
				}
				if(isset($_FILES["file16"]))
				{
					$sql = "UPDATE documentacion SET URL_16='$nombre', MOD_16=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc16Refresh']="Anexo 2";
					$docName = $_SESSION['doc16Refresh'];
				}
				if(isset($_FILES["file17"]))
				{
					$sql = "UPDATE documentacion SET URL_17='$nombre', MOD_17=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc17Refresh']="Anexo 3";
					$docName = $_SESSION['doc17Refresh'];
				}
				if(isset($_FILES["file18"]))
				{
					$sql = "UPDATE documentacion SET URL_18='$nombre', MOD_18=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc18Refresh']="Otros";
					$docName = $_SESSION['doc18Refresh'];
				}
				if(isset($_FILES["file19"]))
				{
					$sql = "UPDATE documentacion SET URL_19='$nombre', MOD_19=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc19Refresh']="Guía de despacho o factura del material";
					$docName = $_SESSION['doc19Refresh'];
				}
				if(isset($_FILES["file20"]))
				{
					$sql = "UPDATE documentacion SET URL_20='$nombre', MOD_20=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc20Refresh']="Documentación legal del Vehículo";
					$docName = $_SESSION['doc20Refresh'];
				}
				if(isset($_FILES["file21"]))
				{
					$sql = "UPDATE documentacion SET URL_21='$nombre', MOD_21=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc21Refresh']="Check list del vehículo";
					$docName = $_SESSION['doc21Refresh'];
				}
				if(isset($_FILES["file22"]))
				{
					$sql = "UPDATE documentacion SET URL_22='$nombre', MOD_22=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc22Refresh']="Licencia municipal de conducir vigente";
					$docName = $_SESSION['doc22Refresh'];
				}
				if(isset($_FILES["file23"]))
				{
					$sql = "UPDATE documentacion SET URL_23='$nombre', MOD_23=CURRENT_TIMESTAMP() WHERE ID_ACREDITADO='$id'";
					$_SESSION['doc23Refresh']="Visa de trabajo";
					$docName = $_SESSION['doc23Refresh'];
				}
			}
			//RETORNAMOS EL LINK DEL NOMBRE DEL ARCHIVO
			mysql_query($sql,$con);

			//REGISTRAR ACCION
			$sql = "INSERT INTO registro_acciones (ID_CONTRATISTA,ID_USUARIO,TIPO,REFERENCIA,ACCION,FECHAREGISTRO) VALUES ('$idContratista','$idUser','Documento Persona','$id','". $docName ."-". $nombre ."',now())";
			mysql_query($sql,$con);

			if(isset($okey)){
				//echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivos/". $_SESSION['trabajadorActual'] . "/". $nombre ."'>" . $nombre . "</a>";	
				echo json_encode(array('link'=>"<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivos/". $_SESSION['trabajadorActual'] . "/". $nombre ."'>" . $nombre . "</a>",
				'mensaje'=>'okey'));
			}
		}else{
			//echo "<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivos/". $_SESSION['trabajadorActual'] . "/". $fila['URL'] ."'>" . $fila['URL'] . "</a>";	
			echo json_encode(array('link'=>"<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivos/". $_SESSION['trabajadorActual'] . "/". $fila['URL'] ."'>" . $fila['URL'] . "</a>",
				'mensaje'=>'No puede volver a subir un documento. Solicite autorización enviando un correo a acreditacion@chilecop.cl'));
		}
	}
	header('Content-Type: application/json;');
?>