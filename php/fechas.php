<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML>

<HEAD>

<TITLE> Calendario </TITLE>

<script language="javascript">

function FormateaFecha(strFecha){

	//Formatea fecha como dd/mm/aaaaa

	var str = '';

	arrFecha = strFecha.split("/");

	dd = arrFecha[0];

	mm = arrFecha[1];

	yy = arrFecha[2];

	if (dd.length < 2)

		dd = '0' + dd;

	if (mm.length < 2)

		mm = '0' + mm;

		

	str = dd + "/" + mm + "/" + yy

	

	return str;

}

</script>