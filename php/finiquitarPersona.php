<?php 
/**
* Conexion a la base de datos
*/
session_start();
include('conexion.php');
$con = conectarse();
$idEmpresa = $_SESSION['idContratista'];
$usuario = $_SESSION['nombreUsuario'];
$id = $_POST['id'];
if(isset($_POST['id'])){

	if($usuario=="Contratista"){
		$sql = "SELECT pa.ID_ACREDITADO 
		FROM personal_acreditado pa, orden_contrato oc, empresa_contratista ec 
		WHERE 
		pa.ID_ACREDITADO='$id' AND 
		pa.ID_ORDEN_CONTRATO = oc.ID_OC AND
		oc.ID_CONTRATISTA = '$idEmpresa'";
		$resultado = mysql_query($sql,$con);
		if($fila = mysql_fetch_array($resultado)){
			$causal = $_POST['causal'];
			$observacion = $_POST['observacion'];
			$id = $_POST['id'];
			$documento = $_POST['documento'];
			$sql = "INSERT INTO finiquitados (ID_ACREDITADO, ID_CAUSAL, OBSERVACION, DOCUMENTO) VALUES ('$id', '$causal', '$observacion', '$documento')";
			mysql_query($sql,$con);
			$sql = "UPDATE personal_acreditado SET ID_ESTADO='2' WHERE ID_ACREDITADO='$id'";
			mysql_query($sql,$con);
			mysql_close($con);
			$_SESSION['mensajeAlerta'] = "Trabajador finiquitado correctamente.";
			echo $id;
		}else{
			echo "Error, comuníquese con la administración del sistema.";
		}
	}	
}else{
	echo "Error";
}
?>