<?php
session_start();
include('conexion.php');
$con = conectarse();
if(isset($_POST['search'])){
	$search = $_POST['search'];
	$tipoUsuario = $_SESSION['nombreUsuario'];
	$sql = "
	SELECT * FROM empresa_contratista WHERE N_FANTASIA LIKE '%" . $search ."%' OR
	RUT LIKE '%" . $search ."%' ORDER BY N_FANTASIA";
	$resultado = mysql_query($sql,$con);
	if($row = mysql_fetch_array($resultado)){
		do{
			echo "<tr>
				<td>".$row['ID_CONTRATISTA'] . "</td>
				<td>".$row['N_FANTASIA'] . "</td>
				<td>".$row['RUT'] . "</td>
				<td>".$row['N_CONTACTO'] . "</td>
				<td>".$row['FONO'] . "</td>";
				echo "<td><a class='btn btn-xs btn-success' href='verContratista.php?id=".$row['ID_CONTRATISTA'] . "' role='button'>Ver</a></td>";
				echo "<td><a class='btn btn-xs btn-default' href='listarContratos.php?id=".$row['ID_CONTRATISTA'] . "' role='button'>Contratos</a></td>";
				echo" <td><a class='btn btn-xs btn-default' href='documentacionEmpresa.php?id=".$row['ID_CONTRATISTA']."' role='button'>Documentos Empresa</a></td>";
				if($usuario=="Admin"){			 
					echo "
					<td><a class='btn btn-xs btn-warning' href='listarUsuarios.php?id=".$row['ID_CONTRATISTA']."' role='button'>Ver Usuarios</a></td>
					<td><a class='btn btn-xs btn-warning' href='editarContratista.php?id=".$row['ID_CONTRATISTA']."&nombre=". $row['N_FANTASIA'] ."' role='button'>Editar</a></td>";
				}
				echo "</tr>";
		}while($row = mysql_fetch_array($resultado));
	} else {
		echo '<b>NO SE ENCONTRARON RESULTADOS.</b>';
	}
}
?>