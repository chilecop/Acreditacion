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
	</head>
	<script type="text/javascript">
			function comenzar(){
				setInterval('enviar()',1800000);
			}
	</script>
	<script language="JavaScript">
			function enviar(){
				document.form.submit();
			}
	</script>
	<body onload="comenzar()">
		<header>
			<img src="images/logo.png">
		</header>
		<section>

			<div class="caja">
				<h2>Actualización</h2>
				<h3>No cierre esta página, ya que posee un proceso automatizado de actualización. Si desea hacerlo manualmente presione actualizar.</h3>
				<form action="http://www.chilecop.cl/cacceso/commit/pases.php" method="POST" name="form">
					<input type="submit" value="Actualizar">
				</form>
			</div>
		</section>
	</body>
</html>