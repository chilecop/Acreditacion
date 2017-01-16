<?php
session_start(); 
if($_SESSION["autentica"]=="SIP"){
	$ahora = date("Y-n-j H:i:s");
	$fechaGuardada = $_SESSION["ultimoAcceso"];  
	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 
	if($tiempo_transcurrido>=600){
		session_destroy();
	    header("Location: http://www.chilecop.cl/accesoAcreditacion.html");
	}else{
		$_SESSION["ultimoAcceso"] = $ahora;
	}
}else{
	header("Location: http://www.chilecop.cl/accesoAcreditacion.html");
}
?>