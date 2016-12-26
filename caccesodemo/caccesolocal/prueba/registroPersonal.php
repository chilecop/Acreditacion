<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 
mysql_select_db("chilecop", $con);
 
$sql="INSERT INTO personal (nombre_personal,rut_personal,cargo,empresa)
VALUES
('$_POST[nombre]','$_POST[rut]','$_POST[cargo]','$_POST[id_empresa]')";
 
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

if(isset($_GET['rut'])){
	if(isset($_GET['tipo'])){
		$sql="INSERT INTO ingreso (rut,outin) VALUES ('$_GET[rut]','$_GET[tipo]')";
		$resultado = mysql_query($sql,$con);
		if($_GET['tipo']=="ENTRADA"){
			header('Location: ingresoS.php');
		}else{
			header('Location: salida.php');
		}

	}
}
mysql_close($con);
echo "Se ha agregado el registro";
if(!isset($_GET['tipo'])){
	header('Location: registroIndividual.php');
}
?>