<?php
	include("php/conexion.php");
	$con = conectarse();
	$rut = $_POST['rut'];
	$tipo = $_POST['tipo'];
	if(isset($_POST['rut']) && isset($_POST['tipo'])){//VERIFICAMOS QUE VENGA EL RUT Y EL TIPO
		$sql = "SELECT * FROM prohibiciones WHERE r_prohibicion='$rut'";
		$resultado = mysql_query($sql,$con);
		if(!($fila = mysql_fetch_array($resultado))){//REVISIÓN SI EXISTE PROHIBICIÓN DE INGRESO PARA EL RUT.
			$sql = "SELECT * FROM personal WHERE rut_personal='$rut'";
			$resultado = mysql_query($sql,$con);
			if($fila = mysql_fetch_array($resultado)){//REVISIÓN SI SE ENCUENTRA EN LA BASE DE DATOS
				$sql="INSERT INTO ingreso (rut,outin,fecha) VALUES ('$rut','$tipo',now())";
				$resultado = mysql_query($sql,$con);
				if($tipo=='ENTRADA'){
					header('Location: ingresoS.php');
				}elseif($tipo =='SALIDA'){
					header('Location: salida.php');
				}
			}else{//USUARIO NO SE ENCUENTRA EN LA BASE DE DATOS
				if($tipo=='ENTRADA'){//SI ESTA INGRESANDO NO LE PERMITO EL ACCESO
					echo '<br><br><br><br><br><br><br><br><b>LA PERSONA NO SE ENCUENTRA EN LA BASE DE DATOS</b><br>';
					echo '<b>Rut:</b> ' . $rut . '<br>';
					echo '<b>Aviso: </b>No autorizar acceso.<br>';
					echo '<b>Proceder: </b>Contactarse con Wilma Chávez.<br>';
					echo '<button style="font-size:35px" onclick="window.location.href=\'ingresoS.php\'" type="button">OK</button>';
				}elseif($tipo=='SALIDA'){//LA PERSONA SE ENCUENTRA ADENTRO PERO NO ESTÁ DENTRO DEL PERSONAL
					echo '<br><br><br><br><br><br><br><br><b style="color:#FF0000">¡ALERTA!</b><br>';
					echo '<b>LA PERSONA NO SE ENCONTRABA REGISTRADA</b><br>';
					echo '<b>Rut:</b> ' . $rut . '<br>';
					echo '<b>Aviso: </b>Existió un ingreso sin autorización.<br>';
					echo '<b>Proceder: </b>Contactarse con Wilma Chávez.<br>';
					echo '<button style="font-size:35px" onclick="window.location.href=\'salida.php\'" type="button">OK</button>';

				}
			}
		}else{//USUARIO CON PROHIBICIÓN DE INGRESO
			if($tipo=='ENTRADA'){
				echo '<br><br><br><br><br><br><br><br><b style="color:#FF0000">¡ALERTA!</b><br>';
				echo '<b>PROHIBICIÓN DE INGRESO</b><br>';
				echo '<b>Nombre:</b> ' . $fila['n_prohibicion'] . '<br>';
				echo '<b>Rut:</b> ' . $fila['r_prohibicion'] . '<br>';
				echo '<b>Aviso: </b>No autorizar acceso.<br>';
				echo '<b>Proceder: </b>Contactarse con Wilma Chávez.<br>';
				echo '<button style="font-size:35px" onclick="window.location.href=\'ingresoS.php\'" type="button">OK</button>';
			}elseif($tipo=='SALIDA'){
				echo '<br><br><br><br><br><br><br><br><b style="color:#FF0000">¡ALERTA!</b><br>';
				echo '<b style="color:#FF0000">INGRESO ILEGAL</b><br>';
				echo '<b>Nombre:</b> ' . $fila['n_prohibicion'] . '<br>';
				echo '<b>Rut:</b> ' . $fila['r_prohibicion'] . '<br>';
				echo '<b>Aviso: </b>La persona se encontraba con prohibición de ingreso.<br>';
				echo '<b>Proceder: </b>Contactar con Urgencia a Wilma Chávez.<br>';
				echo '<button style="font-size:35px" onclick="window.location.href=\'salida.php\'" type="button">OK</button>';
			}
		}
	}else{
		header('Location: ingresoS.php');
	}	 
	mysql_close($con);
?>