<?php
	include("php/conexion.php");
	$con = conectarse();
	$rut = $_POST['rut'];
	$tipo = $_POST['tipo'];
	if(isset($_POST['rut']) && isset($_POST['tipo'])){//VERIFICAMOS QUE VENGA EL RUT Y EL TIPO
		$sql = "SELECT * FROM prohibiciones WHERE r_prohibicion='$rut'";
		$resultado = mysql_query($sql,$con);
		if(!($fila = mysql_fetch_array($resultado))){//REVISIÓN SI EXISTE PROHIBICIÓN DE INGRESO PARA EL RUT.
			$sql = "SELECT * FROM pasesDiarios WHERE rut='$rut' AND (fechaInicio <= curdate() AND curdate() <= fechaTermino)";
			$resultado = mysql_query($sql,$con);
			if(!($fila = mysql_fetch_array($resultado))){//REVISIÓN SI CUENTA CON PASE DIARIO
				$sql = "SELECT * FROM personal WHERE rut_personal='$rut'";
				$resultado = mysql_query($sql,$con);
				if($fila = mysql_fetch_array($resultado)){//REVISIÓN SI SE ENCUENTRA EN LA BASE DE DATOS
					$sql="INSERT INTO pruebaingresos (rut,outin,fecha) VALUES ('$rut','$tipo',now())";
					$resultado = mysql_query($sql,$con);
					if($tipo=='ENTRADA'){
						header('Location: ingresoS.php');
					}elseif($tipo =='SALIDA'){
						header('Location: salida.php');
					}
				}else{//USUARIO NO SE ENCUENTRA EN LA BASE DE DATOS
					if($tipo=='ENTRADA'){//SI ESTA INGRESANDO NO LE PERMITO EL ACCESO
						$sql = "INSERT INTO accesodenegado (fecha, rut, tipo) VALUES (now(),'$rut','$tipo')";
						$resultado = mysql_query($sql,$con);
						echo '<br><br><br><br><br><br><br><br><b>LA PERSONA NO SE ENCUENTRA EN LA BASE DE DATOS</b><br>';
						echo '<b>Rut:</b> ' . $rut . '<br>';
						echo '<b>Aviso: </b>No autorizar acceso.<br>';
						echo '<b>Proceder: </b>Contactarse con Wilma Chávez.<br>';
						echo '<button style="font-size:55px" onclick="window.location.href=\'ingresoS.php\'" type="button">OK</button>';
					}elseif($tipo=='SALIDA'){//LA PERSONA SE ENCUENTRA ADENTRO PERO NO ESTÁ DENTRO DEL PERSONAL
						$sql = "INSERT INTO accesodenegado (fecha, rut, tipo) VALUES (now(),'$rut','$tipo')";
						$resultado = mysql_query($sql,$con);
						echo '<br><br><br><br><br><br><br><br><b style="color:#FF0000">¡ALERTA!</b><br>';
						echo '<b>LA PERSONA NO SE ENCONTRABA REGISTRADA</b><br>';
						echo '<b>Rut:</b> ' . $rut . '<br>';
						echo '<b>Aviso: </b>Existió un ingreso sin autorización.<br>';
						echo '<b>Proceder: </b>Contactarse con Wilma Chávez.<br>';
						echo '<button style="font-size:55px" onclick="window.location.href=\'salida.php\'" type="button">OK</button>';

					}
				}
			}else{
				$sql="INSERT INTO pruebaingresos (rut,outin,fecha) VALUES ('$rut','$tipo',now())";
				$resultado = mysql_query($sql,$con);
				if($tipo=='ENTRADA'){
						header('Location: ingresoS.php');
					}elseif($tipo =='SALIDA'){
						header('Location: salida.php');
				}
			}
		}else{//USUARIO CON PROHIBICIÓN DE INGRESO
			if($tipo=='ENTRADA'){
				echo '<br><br><br><br><br><br><br><br><b style="color:#FF0000">¡ALERTA!</b><br>';
				echo '<b>VALIDAR ACCESO DE PERSONA</b><br>';
				echo '<b>Nombre:</b> ' . $fila['n_prohibicion'] . '<br>';
				echo '<b>Rut:</b> ' . $fila['r_prohibicion'] . '<br>';
				echo '<b>Aviso: </b>Acceso restringido.<br>';
				echo '<b>Proceder: </b>Contactarse con Wilma Chávez.<br>';
				echo '<button style="font-size:55px" onclick="window.location.href=\'ingresoS.php\'" type="button">OK</button>';
			}elseif($tipo=='SALIDA'){
				echo '<br><br><br><br><br><br><br><br><b style="color:#FF0000">¡ALERTA!</b><br>';
				echo '<b>Nombre:</b> ' . $fila['n_prohibicion'] . '<br>';
				echo '<b>Rut:</b> ' . $fila['r_prohibicion'] . '<br>';
				echo '<b>Aviso: </b>Se necesitaba validar el acceso de esta persona.<br>';
				echo '<b>Proceder: </b>Contactar con Urgencia a Wilma Chávez.<br>';
				echo '<button style="font-size:55px" onclick="window.location.href=\'salida.php\'" type="button">OK</button>';
			}
		}
	}else{
		header('Location: ingresoS.php');
	}	 
?>