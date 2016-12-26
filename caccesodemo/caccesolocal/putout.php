<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 
mysql_select_db("chilecop", $con);
 
$sql="INSERT INTO ingreso (rut,outin)
VALUES
('$_POST[rut]','SALIDA')";
 
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "Se ha agregado el registro";
header('Location: salida.php');
 
mysql_close($con)
?>