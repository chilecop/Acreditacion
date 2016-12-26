<?php
session_start();
session_name('SESSIONNAME');
$rootpath ="../";
$rut="";
?>
<!DOCTYPE html>
<html>

<head>
	<title>Ingreso de personas</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
	<script src="js/jquery.min.js"></script>
	<script src="js/frm.js"></script>
	<link rel="stylesheet" href="css/estilos.css" />
	<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
</head>


<body>
	<a class="link two" href="salida.php">Salida</a>
	<article>
		<header>
			<img src="images/logoPagSec.png" alt="" />
			<h2>INGRESO DE PERSONAL</h2>							
		</header>
		<form action="putins.php" method="post">
			<div >
				<div>
					<h3>Rut:</h3>
					<?php echo inputrut("rut",$rut);?>
					<input type="hidden" name="tipo" value="ENTRADA">
				</div>
			</div>
			<div>
				<div>
					<input  type="submit" name="update" value=" Registrar " 
					style="position: absolute; height: 0px; width: 0px; border: none; padding: 0px;"
					hidefocus="true" tabindex="-1"/>
				</div>
			</div>
		</form>
	</article>
</body>
</html>

<script> 
function limpiarut_(objeto){
	objeto.value=objeto.value.replace("-.","K");
	objeto.value=objeto.value.replace("k","K");
	vDigitosAceptados = '0123456789K*';
	if (objeto.value.substr(0,1) == "0")
		{	objeto.value = objeto.value.substr(1,objeto.value.length);
		}
		var texto = objeto.value;
		var salida='';
		for (var x=0; x < texto.length; x++){
			pos = vDigitosAceptados.indexOf(texto.substr(x,1));
			if (pos != -1) salida += texto.substr(x,1);
		}
		if (objeto.value != salida) objeto.value = salida;
				
	if (objeto.value.slice(0, 1) == "9" || objeto.value.slice(0, 1) == "8" || objeto.value.slice(0, 1) == "7" || objeto.value.slice(0, 1) == "6" || objeto.value.slice(0, 1) == "5" || objeto.value.slice(0, 1) == "4" || objeto.value.slice(0, 1) == "3")
		{
			objeto.value = objeto.value.substr(0, 8);
		}
		
}

	

	</script>
	<?php 
	function inputrut($name,$value='',$size=20,$leng=9,$otro=""){
		global $con;	  	  	  
		$input="<input name='".$name."' id='".$name."'  type=\"text\" value='".$value."' autofocus size=".$size." class=\"idle\"  maxlength=".$leng." onkeydown=\"javascript:limpiarut_(this)\" onkeyup=\"javascript:limpiarut_(this)\" ".$otro." required>";	  			 
		return $input;	
	}

	?>
