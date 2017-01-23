<?php
include('../conexion.php');

//ARMAR EL DATO JSON Y MANDARLO DE VUELTA
//EL EJEMPLO DE ENVIO DE JSON ESTA EN EL ADDDOCUMENTACIONTRABAJADOR2 O 1. LLEGANDO A SUBIRDOCUMENTOS.JS
$con = conectarse();

$anio = date("Y");
$primerDiaDelAnio = $anio . "-" . "01-01";
$ultimoDiaDelAnio = $anio . "-" . "12-01";
$sql = "
SELECT *
FROM estado_trabajador_historial
WHERE FECHA
BETWEEN '$primerDiaDelAnio' AND '$ultimoDiaDelAnio'";

$resultado = mysql_query($sql,$con);

//Variables para contadores
$eneroA = 0;
$febreroA = 0;
$marzoA = 0;
$abrilA = 0;
$mayoA = 0;
$junioA = 0;
$julioA = 0;
$agostoA = 0;
$septiembreA = 0;
$octubreA = 0;
$noviembreA = 0;
$diciembreA = 0;
$eneroR = 0;
$febreroR = 0;
$marzoR = 0;
$abrilR = 0;
$mayoR = 0;
$junioR = 0;
$julioR = 0;
$agostoR = 0;
$septiembreR = 0;
$octubreR = 0;
$noviembreR = 0;
$diciembreR = 0;
$eneroP = 0;
$febreroP = 0;
$marzoP = 0;
$abrilP = 0;
$mayoP = 0;
$junioP = 0;
$julioP = 0;
$agostoP = 0;
$septiembreP = 0;
$octubreP = 0;
$noviembreP = 0;
$diciembreP = 0;


while($fila = mysql_fetch_array($resultado)){
	$fecha = date_create($fila['FECHA']);
	$mes = date_format($fecha, 'm');
	switch ($mes) {
		case '01':
			if($fila['ESTADO']==1){
				$eneroA++;
			}
			if($fila['ESTADO']==2){
				$eneroR++;
			}	
			if($fila['ESTADO']==3){
				$eneroP++;
			}				
		break;
		case '02':
			if($fila['ESTADO']==1){
				$febreroA++;
			}
			if($fila['ESTADO']==2){
				$febreroR++;
			}
			if($fila['ESTADO']==3){
				$febreroP++;
			}	
		break;
		case '03':
			if($fila['ESTADO']==1){
				$marzoA++;
			}
			if($fila['ESTADO']==2){
				$marzoR++;
			}
			if($fila['ESTADO']==3){
				$marzoP++;
			}	
		break;
		case '04':
			if($fila['ESTADO']==1){
				$abrilA++;
			}
			if($fila['ESTADO']==2){
				$abrilR++;
			}
			if($fila['ESTADO']==3){
				$abrilP++;
			}	
		break;
		case '05':
			if($fila['ESTADO']==1){
				$mayoA++;
			}
			if($fila['ESTADO']==2){
				$mayoR++;
			}
			if($fila['ESTADO']==3){
				$mayoP++;
			}	
		break;
		case '06':
			if($fila['ESTADO']==1){
				$junioA++;
			}
			if($fila['ESTADO']==2){
				$junioR++;
			}
			if($fila['ESTADO']==3){
				$junioP++;
			}	
		break;
		case '07':
			if($fila['ESTADO']==1){
				$julioA++;
			}
			if($fila['ESTADO']==2){
				$julioR++;
			}
			if($fila['ESTADO']==3){
				$julioP++;
			}	
		break;
		case '08':
			if($fila['ESTADO']==1){
				$agostoA++;
			}
			if($fila['ESTADO']==2){
				$agostoR++;
			}
			if($fila['ESTADO']==3){
				$agostoP++;
			}	
		break;
		case '09':
			if($fila['ESTADO']==1){
				$septiembreA++;
			}
			if($fila['ESTADO']==2){
				$septiembreR++;
			}
			if($fila['ESTADO']==3){
				$septiembreP++;
			}	
		break;
		case '10':
			if($fila['ESTADO']==1){
				$octubreA++;
			}
			if($fila['ESTADO']==2){
				$octubreR++;
			}
			if($fila['ESTADO']==3){
				$octubreP++;
			}	
		break;
		case '11':
			if($fila['ESTADO']==1){
				$noviembreA++;
			}
			if($fila['ESTADO']==2){
				$noviembreR++;
			}
			if($fila['ESTADO']==3){
				$noviembreP++;
			}	
		break;
		case '12':
			if($fila['ESTADO']==1){
				$diciembreA++;
			}
			if($fila['ESTADO']==2){
				$diciembreR++;
			}
			if($fila['ESTADO']==3){
				$diciembreP++;
			}	
		break;		
		default:
			# code...
			break;
	}
}
echo json_encode(
		array(
			'Enero'=>array('a'=>$eneroA,'r'=>$eneroR,'p'=>$eneroP),
			'Febrero'=>array('a'=>$febreroA,'r'=>$febreroR,'p'=>$febreroP),
			'Marzo'=>array('a'=>$marzoA,'r'=>$marzoR,'p'=>$marzoP),
			'Abril'=>array('a'=>$abrilA,'r'=>$abrilR,'p'=>$abrilP),
			'Mayo'=>array('a'=>$mayoA,'r'=>$mayoR,'p'=>$mayoP),
			'Junio'=>array('a'=>$junioA,'r'=>$junioR,'p'=>$junioP),
			'Julio'=>array('a'=>$julioA,'r'=>$julioR,'p'=>$julioP),
			'Agosto'=>array('a'=>$agostoA,'r'=>$agostoR,'p'=>$agostoP),
			'Septiembre'=>array('a'=>$septiembreA,'r'=>$septiembreR,'p'=>$septiembreP),
			'Octubre'=>array('a'=>$octubreA,'r'=>$octubreR,'p'=>$octubreP),
			'Noviembre'=>array('a'=>$noviembreA,'r'=>$noviembreR,'p'=>$noviembreP),
			'Diciembre'=>array('a'=>$diciembreA,'r'=>$diciembreR,'p'=>$diciembreP)
			)
	);


/*
echo json_encode(
	array(
		'link'=>"<a target='_blank' href='http://www.chilecop.cl/acreditacion/archivos/". $_SESSION['trabajadorActual'] . "/". $fila['URL'] ."'>" . $fila['URL'] . "</a>",
				
		'mensaje'=>'No puede volver a subir un documento. Solicite autorización enviando un correo a acreditacion@chilecop.cl'));
*/

/*
var datosAcreditados ={
          labels : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
          datasets : [{
            label : "Acreditados",
            backgroundColor : "rgba(220,220,220,0.8)",
            data : [47,48,46,45,47,46,48,30,23,45,67,32]
          },
          {
            label : "Rechazados",
            backgroundColor : "rgba(240,187,205,0.9)",
            data : [30,34,32,32,32,34,32,45,75,32,12,45]
          }]
        };

 */
?>