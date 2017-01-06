<?php
include('conexion.php');
session_start();

/**
* Recepcion de Variables
*/
$con = conectarse();
$observacion = $_POST['observacion'];
$tipo = $_POST['tipo'];
$documentos = $_POST['documentos'];

/**
* Si es persona, busqueda de la empresa a la cual pertence
*/
switch ($tipo) {
	case 'Persona':
		$id = $_SESSION['idTrabajadorActual'];
	    $sql= "
	    SELECT 
	    oc.ID_CONTRATISTA As idEmpresa
	    FROM 
	    personal_acreditado pa, orden_contrato oc
	    WHERE 
	    pa.ID_ACREDITADO='$id' AND
	    pa.ID_ORDEN_CONTRATO = oc.ID_OC";
		break;
	case 'Empresa':
		$id = $_SESSION["idEmpresaActual"];
		$idEmpresa = $_SESSION["idEmpresaActual"];
	    break;
	case 'Contrato':
		$id = $_SESSION['contratoActual'];
		$sql = "
		SELECT
		ID_CONTRATISTA As idEmpresa
		FROM
		orden_contrato
		WHERE
		ID_OC='$id'";
	    break;
	default:
		# code...
		break;
}

if($tipo!="Empresa"){
	/**
	* Consulta a la BD
	*/
	$resultado = mysql_query($sql,$con);
	$fila = mysql_fetch_array($resultado);
	$idEmpresa = $fila['idEmpresa'];
}

/**
* Insertar la 
*/
$sql = "
INSERT INTO alerta_documentacion (ID_CONTRATISTA,ID_TIPO,REFERENCIA,DOCUMENTOS,OBSERVACION) 
VALUES ('$idEmpresa','$tipo','$id','$documentos','$observacion')";
$resultado = mysql_query($sql,$con);
mysql_close($con);

?>