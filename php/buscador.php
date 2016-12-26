<?php
	session_start();
	include('conexion.php');
	$con = conectarse();
	if(isset($_POST['search'])){
		$search = $_POST['search'];
		$tipoUsuario = $_SESSION['nombreUsuario'];
		mysql_set_charset("utf8",$con);
		if($tipoUsuario=="Admin"){
			$sql = "
			SELECT id_acreditado, rut, nombres, apellidos
			FROM personal_acreditado WHERE 
			nombres LIKE '%" . $search ."%' OR
			rut LIKE '%" . $search ."%' OR
			apellidos LIKE '%" . $search ."%'
			";
		}
		if($tipoUsuario=="Contratista"){
			$idEmpresa = $_SESSION['idContratista'];
			//BUSCAR TODO EL PERSONAL, DE TODOS LOS CONTRATOS PERTENECIENTES A LA 
			//EMPRESA CONTRATISTA $idEmpresa DONDE $search APAREZCA EN NOMBRE APELLIDOS O RUT
			$sql = "SELECT a.id_acreditado, a.rut, a.nombres, a.apellidos, a.id_orden_contrato, 
					b.id_oc, b.id_contratista, c.id_contratista
					FROM personal_acreditado AS a, orden_contrato AS b, empresa_contratista AS c 
					WHERE a.id_orden_contrato = b.id_oc AND
					b.id_contratista = c.id_contratista AND
					c.id_contratista = '$idEmpresa' AND
					(a.nombres LIKE '%" . $search ."%' OR
					a.rut LIKE '%" . $search ."%' OR
					a.apellidos LIKE '%" . $search ."%')";
		}

		if($tipoUsuario=="Mandante"){
			$sql = "
			SELECT id_acreditado, rut, nombres, apellidos
			FROM personal_acreditado WHERE 
			nombres LIKE '%" . $search ."%' OR
			rut LIKE '%" . $search ."%' OR
			apellidos LIKE '%" . $search ."%'
			";
		}
		
		$resultado = mysql_query($sql,$con);
		if($fila = mysql_fetch_array($resultado)){
			do{
				?>
			      <tr>
			        <td><?php echo $fila['id_acreditado'];?></td>
			        <td><?php echo $fila['rut'];?></td>
			        <td><?php echo $fila['apellidos'] . " " . $fila['nombres'];?></td>
			        <td><a class="btn btn-xs btn-success" href="verPersona.php?id=<?php echo $fila['id_acreditado']; ?>" role="button">ver</a></td>
			      </tr>
			      <?php
			}while($fila = mysql_fetch_array($resultado));
		}else{
			echo '<b>NO SE ENCONTRARON RESULTADOS.</b>';
			echo 'Tipo Usuario: ' . $tipoUsuario;
		}
	}
?>