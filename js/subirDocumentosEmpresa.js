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
		var ruta = "php/addDocumentacionEmpresa.php";
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
		var ruta = "php/addDocumentacionEmpresa.php";
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
		var ruta = "php/addDocumentacionEmpresa.php";
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
		var ruta = "php/addDocumentacionEmpresa.php";
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

$(function(){
	$("input[name='file5']").on("change", function(){
		cargando = 1;
		$("#respuesta5").html("Cargando...");
		var formData = new FormData($("#formulario5")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
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
				$("#respuesta5").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file6']").on("change", function(){
		cargando = 1;
		$("#respuesta6").html("Cargando...");
		var formData = new FormData($("#formulario6")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
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
				$("#respuesta6").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file7']").on("change", function(){
		cargando = 1;
		$("#respuesta7").html("Cargando...");
		var formData = new FormData($("#formulario7")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
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
				$("#respuesta7").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file8']").on("change", function(){
		cargando = 1;
		$("#respuesta8").html("Cargando...");
		var formData = new FormData($("#formulario8")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
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
				$("#respuesta8").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file9']").on("change", function(){
		cargando = 1;
		$("#respuesta9").html("Cargando...");
		var formData = new FormData($("#formulario9")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
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
				$("#respuesta9").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file10']").on("change", function(){
		cargando = 1;
		$("#respuesta10").html("Cargando...");
		var formData = new FormData($("#formulario10")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
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
				$("#respuesta10").html(datos.link);
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
			if(document.getElementById("val1")!=null)
			var vval1 = document.getElementById("val1").value;
			if(document.getElementById("val2")!=null)
			var vval2 = document.getElementById("val2").value;
			if(document.getElementById("val3")!=null)
			var vval3 = document.getElementById("val3").value;
			if(document.getElementById("val4")!=null)
			var vval4 = document.getElementById("val4").value;
			if(document.getElementById("val5")!=null)
			var vval5 = document.getElementById("val5").value;
			if(document.getElementById("val6")!=null)
			var vval6 = document.getElementById("val6").value;
			if(document.getElementById("val7")!=null)
			var vval7 = document.getElementById("val7").value;
			if(document.getElementById("val8")!=null)
			var vval8 = document.getElementById("val8").value;
			if(document.getElementById("val9")!=null)
			var vval9 = document.getElementById("val9").value;
			if(document.getElementById("val10")!=null)
			var vval10 = document.getElementById("val10").value;


			$.ajax({
				data: {'val1':vval1,'val2':vval2,'val3':vval3,'val4':vval4,'val5':vval5,'val6':vval6,'val7':vval7,'val8':vval8,'val9':vval9,'val10':vval10},
				type: "POST",
				url: "php/addDocumentacionEmpresa2.php",
				success: function(data)
				{
					var link = "http://www.chilecop.cl/acreditacion/verContratista.php?id="+data;
					window.location=link;
				}
			});
		} else {
			alert("Aún no se terminan de subir los archivos. Por favor espere...");
		}

	});
});

$(function(){
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
				'tipo':'Empresa',
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
});