/**
* - Ingreso de documentos al sistema, generando enlace con este hacia el trabajador.
* - Documento: Contrato de Trabajo
*/

/**
* Variable que guarda la carga de un archivo
*/
var cargando = 0;

$(function(){
	$("input[name='file1']").on("change", function(){
		cargando = 1;
		$("#respuesta1").html("Cargando...");
		var formData = new FormData($("#formulario1")[0]);
		var ruta = "php/addDocumentacionContrato.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta1").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file2']").on("change", function(){
		cargando = 1;
		$("#respuesta2").html("Cargando...");
		var formData = new FormData($("#formulario2")[0]);
		var ruta = "php/addDocumentacionContrato.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta2").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file3']").on("change", function(){
		cargando = 1;
		$("#respuesta3").html("Cargando...");
		var formData = new FormData($("#formulario3")[0]);
		var ruta = "php/addDocumentacionContrato.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta3").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file4']").on("change", function(){
		cargando = 1;
		$("#respuesta4").html("Cargando...");
		var formData = new FormData($("#formulario4")[0]);
		var ruta = "php/addDocumentacionContrato.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta4").html(datos.link);
			}
		});
	});
});

window.onbeforeunload = function exitAlert(){
	if(cargando == 1){
		var alerta = "Aún existen archivos cargando y se perderá el progreso. ¿Desea cerrar? ";
		return alerta;
	}
}

function liberarDocumento(ndoc,tipo){
	$.ajax({
		url: "php/liberarDocumento.php",
		type: "POST",
		data: {'ndoc':ndoc,'tipo':tipo},
		success: function(datos)
		{
			var respuesta = "#respuesta" + ndoc;
			$(respuesta).html("");
			alert("Documento liberado exitosamente.");
		}
	});
	
}

/**
* Funcion que permite guardar toda la informacion de cada uno de los archivos.
*/

$(function(){
	document.getElementById("guardarDocs").addEventListener("click", function(){
		if(cargando==0){
			if(document.getElementById("obs1")!=null)
			var vobs1 = document.getElementById("obs1").value;
			if(document.getElementById("obs2")!=null)
			var vobs2 = document.getElementById("obs2").value;
			if(document.getElementById("obs3")!=null)
			var vobs3 = document.getElementById("obs3").value;
			if(document.getElementById("obs4")!=null)
			var vobs4 = document.getElementById("obs4").value;

			if(document.getElementById("val1")!=null)
			var vval1 = document.getElementById("val1").value;
			if(document.getElementById("val2")!=null)
			var vval2 = document.getElementById("val2").value;
			if(document.getElementById("val3")!=null)
			var vval3 = document.getElementById("val3").value;
			if(document.getElementById("val4")!=null)
			var vval4 = document.getElementById("val4").value;

			$.ajax({
				data: {
					'obs1':vobs1,
					'obs2':vobs2,
					'obs3':vobs3,
					'obs4':vobs4,
					'val1':vval1,
					'val2':vval2,
					'val3':vval3,
					'val4':vval4},
				type: "POST",
				url: "php/addDocumentacionContrato2.php",
				success: function(data)
				{
					var link = "http://www.chilecop.cl/acreditacion/listarContratos.php?id=" + data;
					window.location=link;
				}
			});
		} else {
			alert("Aún no se terminan de subir los archivos. Por favor espere...");
		}
	});

});

$(function(){
	if(document.getElementById("agregarObservacion")!=null){
		document.getElementById("agregarObservacion").addEventListener("click", function(){
			if(document.getElementById("observacion")!=null)
				var observacion = document.getElementById("observacion").value;
			document.getElementById("observacion").value="";
			var seleccionados = "";
			var seleccionadosText = "";
			var i = 0;
			//SE CAPTURAN TODOS LOS CHECKBOX SELECCIONADOS
			$('.docsCheck:checked').each(
			    function() {
			    	if(i==0){
			    		seleccionados = seleccionados + $(this).val();
			    		seleccionadosText = seleccionadosText + $("label[for='"+ $(this).val() +"']").text();
			    		i=1;
			    	}else{
			    		seleccionados = seleccionados + "," + $(this).val();
			    		seleccionadosText = seleccionadosText + "," + $("label[for='"+ $(this).val() +"']").text();
			    	}
			    	$(this).attr('checked',false);
			    }
			);
			$.ajax({
				data: {
					'observacion':observacion,
					'tipo':'Contrato',
					'documentos':seleccionados,
					'documentosText': seleccionadosText},
				type: "POST",
				url: "php/addObservacion.php",
				success: function(data)
				{
					alert("Observación enviada satisfactoriamente.");
						
				}
			});

		});
	}
});