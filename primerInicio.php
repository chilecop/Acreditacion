<?php
session_start();
if($_SESSION["primerInicio"]==1){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Bienvenido - Sistema acreditación Chilecop</title>
	<link rel="stylesheet" href="css/primerInicio.css">
	<script src="js/jquery-3.1.1.min.js"></script>
	<script>
		function comprobarClave(){ 
   			clave1 = document.form.clave1.value;
   			clave2 = document.form.clave2.value;

   		if (clave1 == clave2) {
   			if(clave1.length>7){

   				$.ajax({
					url: "php/primerInicio.php",
					type: "POST",
					data: {'clave1':clave1},
					success: function(datos)
					{
						window.location.href = "http://www.chilecop.cl/acreditacion/escritorio.php";
					}
				});




   			}else{
   				$("#mensaje").html("La contraseña debe tener al menos 8 carácteres.");
   			}
   		} else {
      		$("#mensaje").html("La contraseña debe ser igual en ambos campos.");
   		}
} 
		
	</script>
</head>
<body>
	<header>
		<img src="../images/logoPagSec.png" alt="Chilecop Holding Group"/>
	</header>
	<div class="cuadro">
		<div class="cabecera">
			<h1>Bienivenido</h1>
			<h2>Sistema de Acreditación Chilecop</h2>
		</div>
		<form name="form" action="" method="post" accept-charset="utf-8">
			<label>Nueva clave:</label>
			<input type="password" name="clave1">
			<label>Repita su nueva clave:</label>
			<input type="password" name="clave2">
			<div id="mensaje" class="mensaje"></div>
			<input type="button" name="" value="Comenzar!" onClick="comprobarClave();">
		</form>
	</div>
</body>
</html>
<?php
}else{
	header("location: http://www.chilecop.cl/accesoAcreditacion.html");
}
?>