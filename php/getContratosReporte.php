<?php
	include('conexion.php');
	$empresa = $_POST['empresa'];
	$con = conectarse();
    $sql = "SELECT * FROM orden_contrato WHERE ID_CONTRATISTA='$empresa'";
    mysql_set_charset("utf8",$con);
    $resultado = mysql_query($sql,$con);
    if($fila = mysql_fetch_array($resultado))
    {
        $jsondata = '[{"id":"0","numero":"Todos los contratos"}';
    	$jsondata .= ',{"id":"'. $fila['ID_OC'] . '","numero":"'.$fila['N_CONTRATO'].'"}';
    	while($fila = mysql_fetch_array($resultado)){
			$jsondata =  $jsondata . ',{"id":"'. $fila['ID_OC'] . '","numero":"'.$fila['N_CONTRATO'].'"}';
		}
		$jsondata = $jsondata . ']';
    }else{
    	$jsondata = 0;
    }
	
	echo $jsondata;
?>