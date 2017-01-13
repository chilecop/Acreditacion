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
header("Content-Disposition: attachment; filename=reporteLineaTemporal.xls");

/**
* Asignacion de las variables
*/
$idEmpresa = $_POST['empresa'];
$idContrato = $_POST['idcontrato'];
$idPersona = $_POST['trabajador'];

/**
* Armar SQL segun persona solicitada por el usuario
*/
if($idPersona!=0){
	$sql = "
			SELECT 
			emp.F_REGISTRO AS registroEmpresa, emp.N_FANTASIA,
			oc.F_REGISTRO AS registroContrato, oc.N_CONTRATO,
			pa.*, pa.F_REGISTRO AS registroTrabajador
			FROM
			empresa_contratista emp,
			orden_contrato oc,
			personal_acreditado pa
			WHERE 
			pa.ID_ACREDITADO = '$idPersona' AND 
			pa.ID_ORDEN_CONTRATO = oc.ID_OC AND 
			oc.ID_CONTRATISTA = emp.ID_CONTRATISTA";
}else{
	if($idContrato!=0){
		$sql = "
				SELECT DISTINCT
				emp.F_REGISTRO AS registroEmpresa, emp.N_FANTASIA,
				oc.F_REGISTRO AS registroContrato, oc.N_CONTRATO,				
				pa.*, pa.F_REGISTRO AS registroTrabajador
				FROM
				empresa_contratista emp,
				orden_contrato oc,
				personal_acreditado pa
				WHERE
				pa.ID_ORDEN_CONTRATO = '$idContrato' AND
				pa.ID_ORDEN_CONTRATO = oc.ID_OC AND 
				oc.ID_CONTRATISTA = emp.ID_CONTRATISTA";
	}else{
		if($idEmpresa!=0){
			$sql = "
					SELECT 
					emp.F_REGISTRO AS registroEmpresa, emp.N_FANTASIA,
					oc.F_REGISTRO AS registroContrato, oc.N_CONTRATO,
					pa.*, pa.F_REGISTRO AS registroTrabajador
					FROM
					empresa_contratista emp,
					orden_contrato oc,
					personal_acreditado pa
					WHERE
					pa.ID_ORDEN_CONTRATO = oc.ID_OC AND 
					emp.ID_CONTRATISTA = '$idEmpresa' AND
					oc.ID_CONTRATISTA = emp.ID_CONTRATISTA ORDER BY pa.ID_ACREDITADO";
		}else{
			$sql = "
					SELECT 
					emp.F_REGISTRO AS registroEmpresa, emp.N_FANTASIA,
					oc.F_REGISTRO AS registroContrato, oc.N_CONTRATO,
					pa.*, pa.F_REGISTRO AS registroTrabajador
					FROM
					empresa_contratista emp,
					orden_contrato oc,
					personal_acreditado pa
					WHERE
					pa.ID_ORDEN_CONTRATO = oc.ID_OC AND 
					oc.ID_CONTRATISTA = emp.ID_CONTRATISTA ORDER BY pa.ID_ACREDITADO";
		}
	}
}


/**
* Enviar consulta a la BD
*/
$resultado = mysql_query($sql, $con);
mysql_close($con);
?>

<meta charset="utf-8">
<h2>Reporte Personal Acreditado</h2>
<table border="1" id="table2" bordercolor="#808080" style="border-collapse: collapse" width="95%" border="3" cellspacing="4" cellpadding="4">
	<thead>
		<tr>
			<th>#</th>
			<th>Rut</th>
			<th>Nombre</th>
			<th>Empresa</th>
			<th>Contrato</th>
			<th>Creacion de Usuario</th>
			<th>Registro Empresa</th>
			<th>Registro Contrato</th>
			<th>Registro Trabajador</th>
			<th>Registro Aprobación</th>			
		</tr>
	</thead>
	<tbody>
		<?php while($fila = mysql_fetch_array($resultado)){ ?>
		<tr>
			<td><?php echo $fila['ID_ACREDITADO']; ?></td>
			<td><?php echo $fila['RUT']; ?></td>
			<td><?php echo $fila['NOMBRES'] . " " . $fila['APELLIDOS']; ?></td>
			<td><?php echo $fila['N_FANTASIA']; ?></td>
			<td><?php echo $fila['N_CONTRATO']; ?></td>
			<td><?php echo $fila['registroUsuario']; ?></td>	
			<td><?php echo $fila['registroEmpresa']; ?></td>	
			<td><?php echo $fila['registroContrato']; ?></td>	
			<td><?php echo $fila['registroTrabajador']; ?></td>	
			<td>
			<?php 
			if($fila['INICIOPASE']){
				echo $fila['INICIOPASE']; 
			}else{
				echo "SIN ACREDITAR";
			}
			?>				
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>