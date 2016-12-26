<!DOCTYPE html>
<html lang="es">
	<head>		
		<!--<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=index.php">-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Commit</title>
		<meta name="description" content=""/>
		<meta name="keywords" content=""/>
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<link rel="stylesheet" href="css/estilos.css"/>
		<link rel="image_src" href="images/logo.png"/>
		<script type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<?php
			include("request.php");
		?>
	</head>
	<body>
		<header>
			<img src="images/logo.png">
		</header>
		<section>
			<div class="caja">
				<h2>Pase Diario</h2>
				<h3>Actualiza pases diarios ingresados por el administrador.</h3>
				<form action="http://www.chilecop.cl/cacceso/commit/pases.php" method="POST">
					<input name="sql" type="hidden" value="<?php echo getIngresos(); ?>">
					<input type="submit" value="Actualizar" disabled="true">
				</form>
			</div>
		</section>
	</body>
</html>