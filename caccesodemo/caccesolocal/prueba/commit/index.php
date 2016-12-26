<!DOCTYPE html>
<html lang="es">
	<head>		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Commit</title>
		<meta name="description" content=""/>
		<meta name="keywords" content=""/>
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<link rel="shortcut icon" href="images/favicon.ico"/>
		<link rel="stylesheet" href="css/estilos.css"/>
		<link rel="image_src" href="images/logo.png"/>
		<script type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<?php
			include("request.php");
		?>
	</head>
	<body>
		<header>
			<h3>Presione el botón para comenzar el traspaso de datos...<br>Esta operación puede tardar varios minutos.</h3>
			<form action="http://www.chilecop.cl/cacceso/commit/insert.php" method="POST">
				<input name="sql" type="hidden" value="<?php echo getIngresos(); ?>">
				<input type="submit" value="Realizar Commit">
			</form>
		</header>

		<footer>

		</footer>
	</body>
</html>