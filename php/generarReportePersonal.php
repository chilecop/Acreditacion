<?php
include('conexion.php');
/**
* Conexion con la base de datos
*/
$con = conectarse();
mysql_set_charset("utf8",$con);

/**
* Desplegar datos
*/
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reportePersonal.xls");

/**
* Asignacion de las variables
*/
$estado = $_POST['estado'];
$tipo = $_POST['tipo'];
$empresa = $_POST['empresa'];
$contrato = $_POST['idcontrato'];

/**
* Armar SQL segun opciones ingresadas por el usuario
*/
$sql = "
SELECT 
pa.*, ec.*, oc.*, reg.*, doc.*
FROM 
personal_acreditado pa, 
estado_trabajador et, 
orden_contrato oc, 
empresa_contratista ec,
regiones reg,
documentacion doc";

/**
* OPCION 1: Estado del Personal
* Case 0: Todo el Personal
* Case 1: Acreditado
* Case 2: Pendiente
* Case 3: Rechazado
*/
switch ($estado) {
	case '0':
		$where = " WHERE et.ID_ESTADO = pa.ID_ESTADO";
	break;
	case '1':
		$where = " WHERE pa.ID_ESTADO = '1'";
	break;
	case '2':
		$where = " WHERE pa.ID_ESTADO = '2'";
	break;
	case '3':
		$where = " WHERE pa.ID_ESTADO = '3'";
	break;	
	default:
		# code...
		break;
}

/**
* Continuacion WHERE
*/
$where .= " AND et.ID_ESTADO = pa.ID_ESTADO AND pa.ID_ORDEN_CONTRATO = oc.ID_OC AND oc.ID_CONTRATISTA = ec.ID_CONTRATISTA AND reg.region_id = pa.REGION_ID AND doc.ID_ACREDITADO = pa.ID_ACREDITADO";