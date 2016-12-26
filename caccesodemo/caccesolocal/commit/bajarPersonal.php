<!DOCTYPE html>
<html lang="es">
	<head>		
		<!--<META HTTP-EQUIV="REFRESH" CONTENT="60;URL=index.php">-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Commit</title>
		<meta name="description" content=""/>
		<meta name="keywords" content=""/>
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<link rel="stylesheet" href="css/estilos.css"/>
		<link rel="image_src" href="images/logo.png"/>
		<script type='text/javascript' src="../js/jquery.min.js"></script>
		<?php
			include("request.php");
		?>
		<script type="text/javascript">
			function comenzar(){
				setInterval('enviar()',5000);
			}
		</script>
		<script language="JavaScript">
			function enviar(){
				document.form.submit();
			}
		</script>
	</head>
	<body onload="comenzar()">
		<header>
			<img src="images/logo.png">
		</header>
		<section>
			<div class="caja">
				<h2>¡No Cerrar!</h2>
				<h3>¡Actualizando personal...<br>Por favor espere...</h3>
				<form action="http://www.chilecop.cl/cacceso/commit/descargar.php" method="POST" name="form">
				</form>
			</div>
		</section>
	</body>
</html>