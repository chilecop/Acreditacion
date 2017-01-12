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
$tipoPase = $_POST['tipoPase'];
$tipo = $_POST['tipo'];
$empresa = $_POST['empresa'];
$contrato = $_POST['idcontrato'];

/**
* Armar SQL segun opciones ingresadas por el usuario
*/
$sql = "
SELECT 
pa.*, pa.RUT AS RUTPERSONA, et.*, oc.*, ec.*, reg.*, doc.*, tp.DESCRIPCION AS 'tipoPase'
FROM 
personal_acreditado pa, 
estado_trabajador et, 
orden_contrato oc, 
empresa_contratista ec,
regiones reg,
documentacion doc,
tipo_pase tp";

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

/**
* OPCION 2: TIPO DE PASE
*/
if($tipoPase==0){
	$where .= " AND pa.ID_TIPO_PASE = tp.ID_TIPO_PASE";
}else{
	$where .= " AND pa.ID_TIPO_PASE = '" . $tipoPase . "' AND tp.ID_TIPO_PASE = pa.ID_TIPO_PASE";
}

/**
* OPCION 4 Y 5: EMPRESA Y CONTRATO
*/
if($empresa!=0){
	$where .= " AND ec.ID_CONTRATISTA = '" . $empresa . "'";
	if($contrato!=0){
		$where .= " AND oc.N_CONTRATO = '" . $contrato . "'";
	}
}

/**
* Enviar consulta a la BD
*/
$sql = $sql . " " . $where;
$resultado = mysql_query($sql, $con);
mysql_close($con);
?>
<meta charset="utf-8">
<h2>Reporte Personal Acreditado</h2>
<table border="1" id="table2" bordercolor="#808080" style="border-collapse: collapse" width="95%" border="3" cellspacing="4" cellpadding="4">
<thead>
	<?php 
		if($tipo==0){
	?>
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
	<?php
		}
		if($tipo==1){
	?>
		<tr>
			<th>#</th>
			<th>Estado</th>
			<th>Empresa</th>
			<th>Rut</th>
			<th>Nombre</th>
			<th>Contrato de Trabajo</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Inducción JoyGlobal</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Fotografía Tamaño Carnet</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Consentimiento Test Alcohol y Drogas</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Fotocopia Cédula</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Examen Pre-Ocupacional</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>ODI</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Reglamento Interno</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Entrega EPP</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Último Finiquito</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Certificado de Antecedentes</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Certificado de Estudios</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Acreditación Prevencionista</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Certificado de Aprobación</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Anexo 1</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Anexo 2</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Anexo 3</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Otros</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Guía de Despacho o Factura</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Dcoumentación legal del Venículo</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Check List del Vehículo</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Licencia de Conducir</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
			<th>Visa de Trabajo</th>
			<th>Subido el</th>
			<th>Vencimiento</th>
		</tr>
	<?php
		}
	?>
</thead>
<tbody>
	<?php 
		if($tipo==0){
	?>
		<?php while($fila = mysql_fetch_array($resultado)){ ?>
		<tr>
			<td><?php echo $fila['ID_ACREDITADO']; ?></td>
			<td><?php echo $fila['DESCRIPCION']; ?></td>
			<td><?php echo $fila['N_FANTASIA']; ?></td>
			<td><?php echo $fila['N_CONTRATO']; ?></td>
			<td><?php echo $fila['RUTPERSONA']; ?></td>
			<td><?php echo $fila['NOMBRES'] . " " . $fila['APELLIDOS']; ?></td>
			<td><?php echo $fila['CARGO']; ?></td>	
			<td><?php echo $fila['NACIONALIDAD']; ?></td>
			<td><?php echo $fila['region_nombre']; ?></td>	
			<td><?php echo $fila['DIRECCION']; ?></td>	
			<td><?php echo $fila['F_NACIMIENTO']; ?></td>	
			<td><?php echo $fila['FONO_EMERGENCIA']; ?></td>				
		</tr>
		<?php 
			} 
		?>
	<?php
		}
	?>
	<?php 
		if($tipo==1){
	?>
		<?php while($fila = mysql_fetch_array($resultado)){ ?>
		<tr>
			<td><?php echo $fila['ID_ACREDITADO']; ?></td>
			<td><?php echo $fila['DESCRIPCION']; ?></td>
			<td><?php echo $fila['N_FANTASIA']; ?></td>
			<td><?php echo $fila['RUTPERSONA']; ?></td>
			<td><?php echo $fila['NOMBRES'] . " " . $fila['APELLIDOS']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 1 || $fila['ID_TIPO_PASE'] == 4 || $fila['ID_TIPO_PASE'] == 6){
				if($fila['URL_1']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_1'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_1']; ?></td>
			<td><?php echo $fila['VAL_1']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 1){
				if($fila['URL_2']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_2'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_2']; ?></td>
			<td><?php echo $fila['VAL_2']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE']){
				if($fila['URL_3']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_3'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_3']; ?></td>
			<td><?php echo $fila['VAL_3']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE']){
				if($fila['URL_4']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_4'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_4']; ?></td>
			<td><?php echo $fila['VAL_4']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 1 || $fila['ID_TIPO_PASE'] == 4 || $fila['ID_TIPO_PASE'] == 6){
				if($fila['URL_5']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_5'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_5']; ?></td>
			<td><?php echo $fila['VAL_5']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE']){
				if($fila['URL_6']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_6'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_6']; ?></td>
			<td><?php echo $fila['VAL_6']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 1 || $fila['ID_TIPO_PASE'] == 4){
				if($fila['URL_7']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_7'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_7']; ?></td>
			<td><?php echo $fila['VAL_7']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 1){
				if($fila['URL_8']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_8'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_8']; ?></td>
			<td><?php echo $fila['VAL_8']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 1 || $fila['ID_TIPO_PASE'] == 4 || $fila['ID_TIPO_PASE'] == 6){
				if($fila['URL_9']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_9'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_9']; ?></td>
			<td><?php echo $fila['VAL_9']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 1){
				if($fila['URL_10']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_10'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_10']; ?></td>
			<td><?php echo $fila['VAL_10']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 1){
				if($fila['URL_11']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_11'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_11']; ?></td>
			<td><?php echo $fila['VAL_11']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 1){
				if($fila['URL_12']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_12'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_12']; ?></td>
			<td><?php echo $fila['VAL_12']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 1){
				if($fila['URL_13']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_13'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_13']; ?></td>
			<td><?php echo $fila['VAL_13']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 1){
				if($fila['URL_14']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_14'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_14']; ?></td>
			<td><?php echo $fila['VAL_14']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE']){
				if($fila['URL_15']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_15'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_15']; ?></td>
			<td><?php echo $fila['VAL_15']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE']){
				if($fila['URL_16']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_16'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_16']; ?></td>
			<td><?php echo $fila['VAL_16']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE']){
				if($fila['URL_17']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_17'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_17']; ?></td>
			<td><?php echo $fila['VAL_17']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE']){
				if($fila['URL_18']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_18'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_18']; ?></td>
			<td><?php echo $fila['VAL_18']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 3 || $fila['ID_TIPO_PASE'] == 5){
				if($fila['URL_19']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_19'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_19']; ?></td>
			<td><?php echo $fila['VAL_19']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 3 || $fila['ID_TIPO_PASE'] == 5){
				if($fila['URL_20']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_20'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_20']; ?></td>
			<td><?php echo $fila['VAL_20']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 3 || $fila['ID_TIPO_PASE'] == 5){
				if($fila['URL_21']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_21'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_21']; ?></td>
			<td><?php echo $fila['VAL_21']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 3 || $fila['ID_TIPO_PASE'] == 5){
				if($fila['URL_22']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_22'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_22']; ?></td>
			<td><?php echo $fila['VAL_22']; ?></td>
			<td>
			<?php
			if($fila['ID_TIPO_PASE'] == 6){
				if($fila['URL_23']){
					echo "<a href='http://www.chilecop.cl/acreditacion/archivos/". $fila['RUTPERSONA'] . "/". $fila['URL_23'] . "' target='_blank'>VER</a>";
				}else{
					echo 'SIN SUBIR';
				}

			} else {
				echo "NO APLICA";
			}
			?>
			</td>
			<td><?php echo $fila['MOD_23']; ?></td>
			<td><?php echo $fila['VAL_23']; ?></td>
		</tr>
		<?php 
			} 
		?>
	<?php
		}
	?>
	</tbody>
</table>