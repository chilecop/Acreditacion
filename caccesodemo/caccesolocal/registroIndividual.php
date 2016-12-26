<!DOCTYPE html>
<html lang="es">
	<head>		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Registro Individual</title>
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<link rel="stylesheet" href="css/estilos.css"/>
		<link rel="stylesheet" href="css/estiloRegistroIndividual.css"/>
		<script src="js/jquery.min.js"></script>
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<?php
		if(isset($_GET['rut'])){
			$rut = $_GET['rut'];
		}
		$nombre = "";
		$cargo="";
		if(isset($_GET['tipo'])){
			if($_GET['tipo']=="ENTRADA"){
				$tipo = "ENTRADA";
			}else{
				$tipo = "SALIDA";
			}
		}
		?>
	</head>
	<body>
		<a class="link two" href="ingresoS.php">Entrada</a>
		<a class="link two" href="salida.php">Salida</a>
		<article>
			<header>
				<img src="images/logoPagSec.png" alt="" />
				<h2>REGISTRO DE PERSONAL</h2>							
			</header>
			<div>
				<form id="formulario" action="<?php if(isset($rut)){echo "registroPersonal.php?rut=" . $rut . "&tipo=" . $tipo; }else{ echo "registroPersonal.php"; }?>" method="post">
					<h3>Nombre:</h3>
					<?php echo inputFORM("nombre",$nombre); ?>
					<h3>Rut:</h3>
					<?php if(isset($rut)){echo inputrut("rut",$rut); }else{echo inputrut("rut",0);} ?>
					<h3>Empresa:</h3>
					<?php empresa(); ?>
					<h3>Cargo:</h3>
					<?php echo inputFORM("cargo",$cargo); ?>
					<div>
						<input id="enviar_btn" type="submit" name="update" value=" Registrar " />
					</div>
				</form>
			</div>
		</article>
		<footer>

		</footer>
	</body>
</html>

<script> 
	function limpiarut_(objeto){
		objeto.value=objeto.value.replace("-.","K");
		objeto.value=objeto.value.replace("k","K");
		vDigitosAceptados = '0123456789K*';
		if (objeto.value.substr(0,1) == "0"){	
			objeto.value = objeto.value.substr(1,objeto.value.length);
		}
		var texto = objeto.value;
		var salida='';
		for (var x=0; x < texto.length; x++){
			pos = vDigitosAceptados.indexOf(texto.substr(x,1));
			if (pos != -1) salida += texto.substr(x,1);
		}
		if (objeto.value != salida) objeto.value = salida;
	}

	$("#formulario").submit(function () {  
		if($("#nombre").val().length < 1) {  
			alert("Debe ingresar un nombre.");  
			return false;  
		}else{
			if($("#rut").val().length < 1) {  
				alert("Debe ingresar un rut.");
				return false;  
			}else{
				if($("#cargo").val().length < 1) {  
					alert("Debe ingresar un cargo.");
					return false;  
				}
			} 
		}
	});  
	
</script>

<?php 
	function empresa(){
		require "configure.php";
		$sql="SELECT nombre_empresa,id_empresa FROM empresas";
		echo "<select name='id_empresa' id='empresa' required>";
		foreach ($dbo->query($sql) as $row){
			echo "<option value='" . $row['id_empresa'] . "'>" . $row['nombre_empresa'] . "</option>"; 
		}
		echo "</select>";

	}

	function inputrut($name,$value,$size=22,$leng=10,$otro=""){
		global $con;	  	
		$disabled = 'disabled';  	  
		if($value==0){
			$disabled = "";
			$value = ""; 
		}
	    $input="<input name='".$name."' id='".$name."'  type=\"text\" value='".$value."' autofocus size=".$size." class=\"idle\"  maxlength=".$leng." onBlur=\"javascript:valrut(this)\"  onkeydown=\"javascript:limpiarut_(this)\" onkeyup=\"javascript:limpiarut_(this)\" ".$otro." required>";	  			 
		return $input;	
	}

	function inputFORM($name="",$value="",$type="text",$class='idle',$readonly='',$leng='20',$size='22',$js=''){
	    $formulario = "<input name=\"$name\" type=\"$type\" id=\"$name\"  value=\"$value\" maxlength=\"$leng\" size=\"$size\" class=\"idle\" onChange=javascript:valtext(this);  onkeydown=javascript:valtext(this) onkeyup=javascript:valtext(this);$js  onkeypress=javascript:valtext(this); $readonly required>";
		return $formulario;	
	}
?>