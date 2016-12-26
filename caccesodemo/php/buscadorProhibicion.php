<?php
	include('conexion.php');
	$con = conectarse();
	if(isset($_POST['search'])){
		$search = $_POST['search'];
		
		mysql_set_charset("utf8",$con);
		$sql = "
		SELECT pro.id_prohibicion, pro.r_prohibicion, pro.n_prohibicion, pro.razon
		FROM prohibiciones pro WHERE 
		pro.n_prohibicion LIKE '%" . $search ."%' OR
		pro.r_prohibicion LIKE '%" . $search ."%'";
		$resultado = mysql_query($sql,$con);
		if($fila = mysql_fetch_array($resultado)){
			do{
				?>
			      <tr>
			        <td><?php echo $fila['id_prohibicion'];?></td>
			        <td><?php echo $fila['r_prohibicion'];?></td>
			        <td><?php echo $fila['n_prohibicion'];?></td>
			        <td><?php echo $fila['razon'];?></td>
			        <td><a class="btn btn-xs btn-success" href="permitirPersona.php?id=<?php echo $fila['id_prohibicion']; ?>" role="button">permitir</a></td>	 
			      </tr>
			      <?php
			}while($fila = mysql_fetch_array($resultado));
		}else{
			echo '<b>NO SE ENCONTRARON RESULTADOS.</b>';
		}
	}
?>