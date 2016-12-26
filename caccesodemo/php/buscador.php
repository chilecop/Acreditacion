<?php
	include('conexion.php');
	$con = conectarse();
	if(isset($_POST['search'])){
		$search = $_POST['search'];
		
		mysql_set_charset("utf8",$con);
		$sql = "
		SELECT per.id_personal, per.rut_personal, per.nombre_personal, emp.nombre_empresa, per.cargo
		FROM personal per INNER JOIN empresas emp ON
		per.empresa = emp.id_empresa WHERE 
		per.nombre_personal LIKE '%" . $search ."%' OR
		per.rut_personal LIKE '%" . $search ."%' OR
		emp.nombre_empresa LIKE '%" . $search ."%' AND
		emp.id_empresa = per.empresa GROUP BY per.rut_personal 
		";
		$resultado = mysql_query($sql,$con);
		if($fila = mysql_fetch_array($resultado)){
			do{
				?>
			      <tr>
			        <td><?php echo $fila['id_personal'];?></td>
			        <td><?php echo $fila['rut_personal'];?></td>
			        <td><?php echo $fila['nombre_personal'];?></td>
			        <td><?php echo $fila['nombre_empresa'];?></td>
			        <td><?php echo $fila['cargo'];?></td>
			        <td><a class="btn btn-xs btn-default" href="editarPersona.php?id=<?php echo $fila['id_personal']; ?>" role="button">editar</a></td>
			        <td><a class="btn btn-xs btn-warning" href="prohibirPersona.php?id=<?php echo $fila['id_personal']; ?>" role="button">prohibir</a></td>
			        <td><a class="btn btn-xs btn-danger" href="eliminarPersona.php?id=<?php echo $fila['id_personal']; ?>" role="button">eliminar</a></td>	 
			      </tr>
			      <?php
			}while($fila = mysql_fetch_array($resultado));
		}else{
			echo '<b>NO SE ENCONTRARON RESULTADOS.</b>';
		}
	}
?>