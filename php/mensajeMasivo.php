<?php
include('conexion.php');

$asunto = $_POST['asunto'];
$observacion = $_POST['observacion'];
$para = "acreditacion@chilecop.cl";


$html = ' <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" bgcolor="#FFF"><table width="800" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="4%" height="77"></td>
        <td align="center" colspan="2"><a href="http://www.chilecop.cl"><img src="http://www.chilecop.cl/acreditacion/images/logo.png" width="183" height="131" /></a></td><br><br>
        <td width="9%"></td>
      </tr>
      <tr>
        <td height="10" valign="top"></td>
        <td style="font-family:Arial,Helvetica,sans-serif;color:#fff;font-size:20px" colspan="2" valign="top" height="10"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
          <tr height="10">
            <td width="10" height="10" valign="top"><img style="display:block" src="http://www.chilecop.cl/acreditacion/images/mailing/pxi.png" width="10" height="10" /></td>
            <td width="100%" height="10" valign="top" bgcolor="#2f4050"></td>
            <td width="10" height="10"><img style="display:block" valign="top" src="http://www.chilecop.cl/acreditacion/images/mailing/pxd.png" width="10" height="10" /></td>
          </tr>
        </table></td>
        <td></td>
      </tr>
      <tr>
        <td height="19"></td>
        <td colspan="2" bgcolor="#2f4050" style="font-family:Arial,Helvetica,sans-serif;color:#fff;font-size:20px">&nbsp;&nbsp;' . $asunto . ' - Chilecop</td>
        <td></td>
      </tr>
      <tr>
        <td height="7"></td>
        <td colspan="2" bgcolor="#2f4050"></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td width="87%"></td>
        <td width="0%"></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2" bgcolor="#FFFFFF"></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" style="font-family:Arial,Helvetica,sans-serif; color:#55555;font-size:12px; text-align:justify" align="left">
          <tr>
            <td width="6%"></td>
            <td width="483"><br />Estimados Contratistas<strong>, </strong><br />
              <br />
              Es un gusto para nosotros saludarles, y poder hacerles llegar el siguiente comunicado,<br>';

              if($observacion != NULL){
                $html.='<br>'. $observacion . '<br>';
              }

              $html .='<br><b>
              Para mayor informaci&oacute;n, puede responder este mismo correo o bien llamarnos a los numeros al pie de este mensaje.<br/><br/>       
              Saludos cordiales!<br/><br/>---<br />
              Equipo Chilecop<br />
              Consultas, 12345678 - 9 876 54 321 - 8 888 88 888<br />---
              <br />http://www.chilecop.cl<br />Protecci&oacute;n a tu servicio<br />
              <br />
              <br />
            </td>
            <td width="6%"></td>
          </tr>
        </table></td>
        <td></td>
      </tr>
      <tr>
        <td></td><td colspan="2" valign="top" height="10"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="1%" height="10" valign="top"><img style="display:block" src="http://www.chilecop.cl/acreditacion/images/mailing/pxdi.png" width="10" height="10" /></td>
            <td width="97%" height="10" valign="top" bgcolor="#2f4050"></td>
            <td width="2%" height="10"><img style="display:block" src="http://www.chilecop.cl/acreditacion/images/mailing/pxdd.png" width="10" height="10" /></td>
          </tr>
        </table></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
    <br />
    <br /></td><br />
  </tr>
</table>';

$con = conectarse();
$sql = "SELECT MAIL_CONTACTO, MAIL_RESPONSABLE FROM empresa_contratista";
$resultado = mysql_query($sql,$con);

/**
* Armado de la cabecera del mensaje
*/
$header = 'From: ' . "Chilecop Administracion <acreditacion@chilecop.cl> \r\n";
$header .= "cc: informatica@chilecop.cl \r\n";
while($fila = mysql_fetch_array($resultado)){
  $header .= "cc: " . $fila['MAIL_CONTACTO'] . " \r\n";
  $header .= "cc: " . $fila['MAIL_RESPONSABLE'] . " \r\n";
}
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type:  text/html\r\n";

//COMPOSICIÓN DEL CORREO
mail($para, $asunto, utf8_decode($html), $header); 
echo 'Mensaje enviado correctamente.';
?>