// JavaScript Document
function valtext(objeto)
	{
		if (objeto.value=="") return;
		var cadena = objeto.value;
		var vDigitosAceptados = ' abcdefghijklnmñopqrstuvwxyzABCDEFGHIJKLNMÑOPQRSTUVWXYZúéíóáÁÉÍÓÚÀÈÌÒÙàèìòù,:.;-_!·$%&/()=?¿çºª0123456789¡#@';
		var cadExp = ""
		for (var i=1; i<=255; i++) 
			if (i==13 || vDigitosAceptados.indexOf(String.fromCharCode(i))>-1)
				cadExp += String.fromCharCode(i);
 
		var expr = new RegExp("[^\n" + cadExp.replace("\\","\\\\") + "]","g");
		cadena = cadena.replace(expr,"");
	
		if (cadena.length != objeto.value.length) objeto.value = cadena;
		
	}
function valnume(objeto){
		var texto = objeto.value;
		var decimales = objeto.decimales;
		vDigitosAceptados = '0123456789';
		if ((decimales==null) || (decimales==0)) {
			vDigitosAceptados = '0123456789';
		}
		else{
			vDigitosAceptados = '0123456789.,';
		}
		var salida='';
		var pos=0;
		for (var x=0; x < texto.length; x++){
			pos = vDigitosAceptados.indexOf(texto.substr(x,1));
			if (pos != -1) salida += texto.substr(x,1);
			if (pos == 10) vDigitosAceptados = '0123456789';
		}
		if (decimales!=null) {
			punto = salida.indexOf('.');
			if (punto != -1) punto = salida.indexOf(',');
			if (punto != -1){
				salida = salida.substr(0,punto + Number(decimales)+1);
			}
		}
		if (objeto.value != salida) objeto.value = salida;
		objeto.value=(objeto.value).replace(",",".")
	}
 function valrut(objeto)
	{ if (objeto.value=="") return true;
	  objeto.value=objeto.value.replace("k","K");
	  var respuesta=true;
	  if (objeto.value.indexOf("-")==-1)
	  {   v_rut = objeto.value;
		  if (Number(objeto.value.substr(0,objeto.value.length-1)) < 3000000)
		  {
			objeto.value=""
		  }
		  else
		  {
			objeto.value=objeto.value.substr(0,objeto.value.length-1)+'-'+objeto.value.substr(objeto.value.length-1,1)
			valrut_(objeto);
		  }
		  if (objeto.value=="")
		  {	objeto.value = v_rut;
			coloca_verificador(objeto);
			valrut_(objeto);
			}
		  if (objeto.value==""){objeto.value = v_rut;}
		}
	  valrut_(objeto);
	  if (objeto.value==""){v_rut = objeto.value;alert("Rut Invalido");objeto.value="";objeto.focus();return false;}
	  return true;
	 }

	function valrut_(objeto)
	{
	if (objeto.value.indexOf("*")!=-1){respuesta=true;return true;}
	var rut=objeto.value;suma=0;mul=2;i=0;
	  respuesta=true;
	  if (rut=="") return false;
	  for (i=rut.length-3;i>=0;i--){
	    suma=suma+Number(rut.charAt(i)) * mul;
	    mul= mul==7 ? 2 : mul+1;
	  }
	  var dvr = ''+(11 - suma % 11);
	  if (dvr=='10') dvr = 'K'; else if (dvr=='11') dvr = '0';
	if (rut.charAt(rut.length-2)!="-"||rut.charAt(rut.length-1)!=dvr) objeto.value="";
	}

	function limpiarut_(objeto)
	{
	   objeto.value=objeto.value.replace("-.","-K");
	   objeto.value=objeto.value.replace("k","K");
		vDigitosAceptados = '0123456789K*';
		if (objeto.value.substr(0,1) == "0")
		{	objeto.value = objeto.value.substr(1,objeto.value.length);
			}
		var texto = objeto.value;
		var salida='';
		for (var x=0; x < texto.length; x++){
			pos = vDigitosAceptados.indexOf(texto.substr(x,1));
			if (pos != -1) salida += texto.substr(x,1);
		}
	if (objeto.value != salida) objeto.value = salida;
	}

	function coloca_verificador(objeto)
	{ var rut=objeto.value;suma=0;mul=2;i=0;
	//alert(rut.length);
	  if ((rut.length>7)&&(Number(rut.substr(0,2))>22)) return false;
	  if (rut=="") return false;
	  for (i=rut.length-1;i>=0;i--){
	    suma=suma+Number(rut.charAt(i)) * mul;
	    mul= mul==7 ? 2 : mul+1;
	  }
	  var dvr = ''+(11 - suma % 11);
	  if (dvr=='10') dvr = 'K'; else if (dvr=='11') dvr = '0';
	  objeto.value=objeto.value+'-'+dvr;
	}
	
	
	
//Mostrr Ocultar tabla
function cambiarDisplay(id) {
  if (!document.getElementById) return false;
  fila = document.getElementById(id);
  if (fila.style.display != "none") {
    fila.style.display = "none"; //ocultar fila
  } else {
    fila.style.display = ""; //mostrar fila
  }
}


function $(value){
 	return document.getElementById(value)
}
function $v(value){
  	return document.getElementById(value).value
}