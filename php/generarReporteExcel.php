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

/**
* Generar query segun los datos solicitados
*/

//PERSONAL TOTAL
$query = "SELECT count(*) AS total FROM personal_acreditado";
$resultadoTotal = mysql_query($query, $con);
if($estado==0){
	if($tipo==0){
		$query = "
		SELECT pa.ID_ACREDITADO,
		 pa.RUT, pa.NOMBRES, 
		 pa.APELLIDOS, 
		 ec.N_FANTASIA, 
		 oc.N_CONTRATO, 
		 et.DESCRIPCION,
		 pa.CARGO,
		 pa.NACIONALIDAD,
		 pa.DIRECCION,
		 pa.F_NACIMIENTO,
		 pa.FONO_EMERGENCIA,
		 reg.region_nombre 
		FROM personal_acreditado pa, 
		estado_trabajador et, 
		orden_contrato oc, 
		empresa_contratista ec,
		regiones reg
			WHERE et.ID_ESTADO = pa.ID_ESTADO AND 
			pa.ID_ORDEN_CONTRATO = oc.ID_OC AND 
			oc.ID_CONTRATISTA = ec.ID_CONTRATISTA AND
			reg.region_id = pa.REGION_ID";
		$resultado = mysql_query($query, $con);
	}

	if($tipo==1){
		$query = "
		SELECT 
		pa.ID_ACREDITADO,
		pa.RUT,
		pa.NOMBRES,
		pa.APELLIDOS,
		doc.*
		FROM
		personal_acreditado pa,
		documentacion doc
		WHERE
		pa.ID_ACREDITADO = doc.ID_ACREDITADO
		";
		$resultado = mysql_query($query, $con);
	}
}
$filaTotal = mysql_fetch_array($resultadoTotal);
$total = $filaTotal['total'];

//PERSONAL ACREDITADO
$query = "SELECT count(*) AS total FROM personal_acreditado WHERE ID_ESTADO='1'";
$resultadoAcreditados = mysql_query($query, $con);
if($estado==1){
	$query = "
	SELECT pa.ID_ACREDITADO,
	 pa.RUT, pa.NOMBRES, 
	 pa.APELLIDOS, 
	 ec.N_FANTASIA, 
	 oc.N_CONTRATO, 
	 et.DESCRIPCION,
	 pa.CARGO,
	 pa.NACIONALIDAD,
	 pa.DIRECCION,
	 pa.F_NACIMIENTO,
	 pa.FONO_EMERGENCIA,
	 reg.region_nombre 
	FROM personal_acreditado pa, 
	estado_trabajador et, 
	orden_contrato oc, 
	empresa_contratista ec,
	regiones reg
		WHERE pa.ID_ESTADO = '1' AND
		et.ID_ESTADO = pa.ID_ESTADO AND 
		pa.ID_ORDEN_CONTRATO = oc.ID_OC AND 
		oc.ID_CONTRATISTA = ec.ID_CONTRATISTA AND
		reg.region_id = pa.REGION_ID";
	$resultado = mysql_query($query, $con);
}
$filaAceditados = mysql_fetch_array($resultadoAcreditados);
$aprobados = $filaAceditados['total'];

//PERSONAL RECHAZADO
$query = "SELECT count(*) AS total FROM personal_acreditado WHERE ID_ESTADO='2'";
$resultadoRechazados = mysql_query($query, $con);
if($estado==2){
	$query = "
	SELECT pa.ID_ACREDITADO,
	 pa.RUT, pa.NOMBRES, 
	 pa.APELLIDOS, 
	 ec.N_FANTASIA, 
	 oc.N_CONTRATO, 
	 et.DESCRIPCION,
	 pa.CARGO,
	 pa.NACIONALIDAD,
	 pa.DIRECCION,
	 pa.F_NACIMIENTO,
	 pa.FONO_EMERGENCIA,
	 reg.region_nombre 
	FROM personal_acreditado pa, 
	estado_trabajador et, 
	orden_contrato oc, 
	empresa_contratista ec,
	regiones reg
		WHERE pa.ID_ESTADO = '2' AND
		et.ID_ESTADO = pa.ID_ESTADO AND 
		pa.ID_ORDEN_CONTRATO = oc.ID_OC AND 
		oc.ID_CONTRATISTA = ec.ID_CONTRATISTA AND
		reg.region_id = pa.REGION_ID";
	$resultado = mysql_query($query, $con);
}
$filaRechazados = mysql_fetch_array($resultadoRechazados);
$rechazados = $filaRechazados['total'];

//PERSONAL PENDIENTE
$query = "SELECT count(*) AS total FROM personal_acreditado WHERE ID_ESTADO='3'";
$resultadoPendientes = mysql_query($query, $con);
if($estado==3){
	$query = "
	SELECT pa.ID_ACREDITADO,
	 pa.RUT, pa.NOMBRES, 
	 pa.APELLIDOS, 
	 ec.N_FANTASIA, 
	 oc.N_CONTRATO, 
	 et.DESCRIPCION,
	 pa.CARGO,
	 pa.NACIONALIDAD,
	 pa.DIRECCION,
	 pa.F_NACIMIENTO,
	 pa.FONO_EMERGENCIA,
	 reg.region_nombre 
	FROM personal_acreditado pa, 
	estado_trabajador et, 
	orden_contrato oc, 
	empresa_contratista ec,
	regiones reg
		WHERE pa.ID_ESTADO = '3' AND
		et.ID_ESTADO = pa.ID_ESTADO AND 
		pa.ID_ORDEN_CONTRATO = oc.ID_OC AND
		oc.ID_CONTRATISTA = ec.ID_CONTRATISTA AND
		reg.region_id = pa.REGION_ID";
	$resultado = mysql_query($query, $con);
}
$filaPendientes = mysql_fetch_array($resultadoPendientes);
$pendientes = $filaPendientes['total'];

//CALCULO PORCENTAJES
if($total != 0){
	$porcentajeAprobados = round(($aprobados*100)/$total);
	$porcentajeRechazados = round(($rechazados*100)/$total);
	$porcentajePendientes = round(($pendientes*100)/$total);
}

/**
* Elaboracion del archivo excel
*/
?>
<meta charset="utf-8">
<h2>Reporte Personal Acreditado</h2>
<h3>Resumen</h3>
<table>
	<tbody>
		<tr>
			<td>Personal Total</td>
			<td><?php echo $total; ?></td>
			<td>100%</td>
		</tr>
		<tr>
			<td>Personal Acreditado</td>
			<td><?php echo $aprobados; ?></td>
			<td><?php echo $porcentajeAprobados . "%"; ?></td>
		</tr>
		<tr>
			<td>Personal Rechazado</td>
			<td><?php echo $rechazados; ?></td>
			<td><?php echo $porcentajeRechazados . "%"; ?></td>
		</tr>
		<tr>
			<td>Personal Pendiente</td>
			<td><?php echo $pendientes; ?></td>
			<td><?php echo $porcentajePendientes . "%"; ?></td>
		</tr>
	</tbody>
</table>
<table border="1" id="table2" bordercolor="#808080" style="border-collapse: collapse" width="95%" border="3" cellspacing="4" cellpadding="4">
	<thead>
		<tr>
			<th>#</th>
			<th>Estado</th>
			<th>Empresa</th>
			<th>Contrato</th>
			<th>Rut</th>
			<th>Nombre</th>
			<th>Cargo</th>
			<th>Nacionalidad</th>
			<th>Región</th>
			<th>Dirección</th>
			<th>Fecha de Nacimiento</th>
			<th>Fono</th>
		</tr>
	</thead>
	<tbody>
		<?php while($fila = mysql_fetch_array($resultado)){ ?>
		<tr>
			<td><?php echo $fila['ID_ACREDITADO']; ?></td>
			<td><?php echo $fila['DESCRIPCION']; ?></td>
			<td><?php echo $fila['N_FANTASIA']; ?></td>
			<td><?php echo $fila['N_CONTRATO']; ?></td>
			<td><?php echo $fila['RUT']; ?></td>
			<td><?php echo $fila['NOMBRES'] . " " . $fila['APELLIDOS']; ?></td>
			<td><?php echo $fila['CARGO']; ?></td>	
			<td><?php echo $fila['NACIONALIDAD']; ?></td>
			<td><?php echo $fila['region_nombre']; ?></td>	
			<td><?php echo $fila['DIRECCION']; ?></td>	
			<td><?php echo $fila['F_NACIMIENTO']; ?></td>	
			<td><?php echo $fila['FONO_EMERGENCIA']; ?></td>				
		</tr>
		<?php } ?>
	</tbody>
</table>