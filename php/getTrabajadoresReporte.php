<?php
	include('conexion.php');
	$contrato = $_POST['contrato'];
	$con = conectarse();
    $sql = "SELECT * FROM personal_acreditado WHERE ID_ORDEN_CONTRATO='$contrato' ORDER BY NOMBRES";
    mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
    if($fila = mysql_fetch_array($resultado))
    {
        $jsondata = '[{"id":"0","datos":"Todo el personal"}';
    	$jsondata .= ',{"id":"'. $fila['ID_ACREDITADO'] . '","datos":"'.$fila['RUT']. ' - '.$fila['NOMBRES'].' ' .$fila['APELLIDOS'].'"}';
    	while($fila = mysql_fetch_array($resultado)){
			$jsondata =  $jsondata . ',{"id":"'. $fila['ID_ACREDITADO'] . '","datos":"'.$fila['RUT']. ' - '.$fila['NOMBRES'] .' '. $fila['APELLIDOS'] .'"}';
		}
		$jsondata = $jsondata . ']';
    }else{
    	$jsondata = 0;
    }
	
	echo $jsondata;
?>