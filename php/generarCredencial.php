<!DOCTYPE html>
<html>
<head>
	<?php 
	include("consultasAcreditacion.php");
	if(isset($_GET['id'])){
      $id = $_GET['id'];
    }
    $contenido = getVerPersona($id);
    list($rut,$nombres,$apellidos,$cargo,$f_nacimiento,$procedencia,$alergias,$fono_emergencia,$direccion) = explode("%$", $contenido);

	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Credencial</title>
	<link rel="stylesheet" href="../css/credencial.css">
</head>
<body>
	<div class="credencial adelante">
		<div class="bloque1">
			<div class="foto">
				<img src="../images/personal/1.jpg" alt="">
			</div>
			<div class="datos">
				<h3>Rut</h3>
				<h2><?php echo $rut; ?></h2>
				<h3>Nombre</h3>
				<h2><?php echo $nombres . " " . $apellidos; ?></h2>
			</div>
		</div>
		<div class="bloque2">
			<div class="logo">
				<img src="../images/logo.png">
			</div>
			<div class="cargo">
				<h3>Cargo</h3>
				<h4><?php echo $cargo; ?></h4>
			</div>
		</div>
	</div>
	<div class="credencial atras">
		<div class="barcode">
			<img src="../images/barcode.gif" alt="">
		</div>
		<div class="rut">
			<h2><?php echo $rut; ?></h2>
			<h3>Válida hasta 01 de Enero del 2017</h3>
		</div>
	</div>
</body>
</html>